<?php 
include "database.php";

class Slide {
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    } 

    public function insertSlide($imagePath) {
        $query = "INSERT INTO tbl_slide (slide_name) VALUES ('$imagePath')";
        $result = $this->db->insert($query);
        return $result;
    }
}

// Xử lý việc tải ảnh lên
if (isset($_POST['submit'])) {
    $file = $_FILES['image'];

    // Lấy thông tin về ảnh
    $fileName = $file['name'];
    $fileTmpName = $file['tmp_name'];
    $fileSize = $file['size'];
    $fileError = $file['error'];

    // Đường dẫn lưu trữ ảnh
    $uploadDirectory = 'upload_slide/';

    // Kiểm tra nếu có lỗi
    if ($fileError === 0) {
        // Di chuyển tệp tin ảnh vào thư mục lưu trữ
        $fileDestination = $uploadDirectory . $fileName;
        move_uploaded_file($fileTmpName, $fileDestination);

        // Insert đường dẫn vào cơ sở dữ liệu
        $slide = new Slide();
        $slide->insertSlide($fileDestination);
        header("Location:upload_slide.php");
        echo "<p style='color: green;'>Upload successful</p>";

    } else {
        echo "<p style='color: red;'>There was an error uploading your file</p>";
    }
}
?>