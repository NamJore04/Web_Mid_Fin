<?php
include "database.php";
?>

<?php
class product
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }



    public function show_product()
    {
        $query = "SELECT * FROM tbl_product ORDER BY product_id DESC";
        $result = $this->db->select($query);
        return $result;
    }

    public function show_brand_ajax($cartegory_id)
    {
        $query = "SELECT * FROM tbl_brand WHERE cartegory_id = '$cartegory_id'";
        $result = $this->db->select($query);
        return $result;
    }


    public function insert_product()
    {
        $product_name = $_POST['product_name'];
        $cartegory_id  = $_POST['cartegory_id'];
        $product_price    = $_POST['product_price'];
        $product_price_new    = $_POST['product_price_new'];
        $product_desc    = $_POST['product_desc'];
        $product_img    = $_FILES["product_img"]['name'];
        $filetarget = basename($_FILES['product_img']['name']);
        $fileStype = strtolower(pathinfo($product_img,  PATHINFO_EXTENSION));
        // if (file_exists("uploads/$filetarget")) {
        //     $alert = 'File has exited.';
        //     return $alert;
        // } else {
        if ($fileStype != "jpg" && $fileStype != "jpeg" && $fileStype != "png") {
            $alert = 'Only .jpg .png .jpeg';
            return $alert;
        } else {
            move_uploaded_file($_FILES['product_img']['tmp_name'], "uploads/" . $_FILES['product_img']['name']);
            $query = "INSERT INTO tbl_product (
                        product_name,
                        cartegory_id,
                        product_price,
                        product_price_new,
                        product_desc,
                        product_img)
                    VALUES (
                        '$product_name',
                        '$cartegory_id',
                        '$product_price',
                        '$product_price_new',
                        '$product_desc',
                        '$product_img')";
            $result = $this->db->insert($query);
            // header('location:brandlist.php');

            if ($result) {
                $query = 'SELECT * FROM tbl_product ORDER BY product_id DESC LIMIT 1';
                $result = $this->db->select($query)->fetch_assoc();
                $product_id = $result['product_id'];
                $filename = $_FILES["product_img_desc"]['name'];
                $filetmp = $_FILES["product_img_desc"]['tmp_name'];
                foreach ($filename as $key => $value) {
                    move_uploaded_file($filetmp[$key], "uploads/" . $value);

                    $query = "INSERT INTO tbl_product_img_desc (product_id, product_img_desc) VALUE ('$product_id','$value')";
                    $result = $this->db->insert($query);
                }
            }
        }
        // }

        return $result;
    }

    // public function get_product_img($product_id) {
    //     $product_img    = $_FILES["product_img"]['name'];
    //     $query = "SELECT * FROM tbl_product WHERE product_id = '$product_id'";
    //     $result = $this->db->select($query);
    //     return $result;
    // }

    public function get_product($product_id)
    {
        $query = "SELECT * FROM tbl_product WHERE product_id = '$product_id'";
        $result = $this->db->select($query);
        return $result;
    }

    public function update_product(
        $product_name,
        $product_id,
        $product_price,
        $product_price_new,
        $product_desc,
        $product_img,
        $filetarget,
        $fileStype
    ) {
        // Kiểm tra xem ảnh có được tải lên hay không
        if ($product_img != '') {
            $query = "UPDATE tbl_product 
                      SET 
                          product_name = '$product_name',
                          product_price = '$product_price',
                          product_price_new = '$product_price_new',
                          product_desc = '$product_desc',
                          product_img = '$product_img'
                      WHERE product_id = '$product_id'";
        } else {
            $query = "UPDATE tbl_product 
                      SET 
                          product_name = '$product_name',
                          product_price = '$product_price',
                          product_price_new = '$product_price_new',
                          product_desc = '$product_desc'
                      WHERE product_id = '$product_id'";
        }

        $result = $this->db->update($query);
        return $result;
    }

    public function delete_product($product_id)
    {

        // Kiểm tra xem sản phẩm có tồn tại trong bảng transaction hay không
        $query_check_transaction = "SELECT COUNT(*) as count FROM transaction WHERE product_id = '$product_id' AND is_order = 0";
        $result_check_transaction = $this->db->select($query_check_transaction);
        $row = $result_check_transaction->fetch_assoc();

        if ($row['count'] > 0) {
            // Nếu sản phẩm tồn tại trong bảng transaction, không cho phép xóa
            return false;
        }
        // Xóa dữ liệu từ bảng tbl_product
        $query_product = "DELETE FROM tbl_product WHERE product_id = '$product_id'";
        $result_product = $this->db->delete($query_product);

        // Xóa dữ liệu từ bảng tbl_product_img_desc
        $query_img_desc = "DELETE FROM tbl_product_img_desc WHERE product_id = '$product_id'";
        $result_img_desc = $this->db->delete($query_img_desc);

        // Kiểm tra kết quả của cả hai truy vấn
        if ($result_product && $result_img_desc) {
            // header('location:productlist.php');
            return true;
        } else {
            // Xử lý lỗi nếu có
            return false;
        }
    }




















    public function insert_brand($cartegory_id, $brand_name)
    {
        $query = "INSERT INTO tbl_brand (cartegory_id,brand_name) VALUES ('$cartegory_id', '$brand_name')";
        $result = $this->db->insert($query);
        header('location:brandlist.php');

        return $result;
    }

    public function show_brand()
    {
        $query = "SELECT tbl_brand.*,tbl_cartegory.cartegory_name 
            FROM tbl_brand INNER JOIN tbl_cartegory 
            ON tbl_brand.cartegory_id = tbl_cartegory.cartegory_id  
            ORDER BY tbl_brand.brand_id DESC";
        $result = $this->db->select($query);
        return $result;
    }

    public function get_brand($brand_id)
    {
        $query = "SELECT * FROM tbl_brand WHERE brand_id = '$brand_id'";
        $result = $this->db->select($query);
        return $result;
    }


    public function update_brand($cartegory_id, $brand_name, $brand_id)
    {
        $query = "UPDATE  tbl_brand SET brand_name = '$brand_name', cartegory_id = '$cartegory_id' WHERE brand_id = '$brand_id'";
        $result = $this->db->update($query);
        header('location:brandlist.php');
        return $result;
    }

    public function delte_brand($brand_id)
    {
        $query = "DELETE FROM tbl_brand WHERE brand_id = '$brand_id'";
        $result = $this->db->delete($query);
        header('location:brandlist.php');
        return $result;
    }






    public function show_cartegory()
    {
        $query = "SELECT * FROM tbl_cartegory ORDER BY cartegory_id DESC";
        $result = $this->db->select($query);
        return $result;
    }


    public function get_cartegory($cartegory_id)
    {
        $query = "SELECT * FROM tbl_cartegory WHERE cartegory_id = '$cartegory_id'";
        $result = $this->db->select($query);
        return $result;
    }

    public function update_cartegory($cartegory_name, $cartegory_id)
    {
        $query = "UPDATE  tbl_cartegory SET cartegory_name = '$cartegory_name' WHERE cartegory_id = '$cartegory_id'";
        $result = $this->db->update($query);
        header('location:cartegorylist.php');
        return $result;
    }
    public function delte_cartegory($cartegory_id)
    {
        $query = "DELETE FROM tbl_cartegory WHERE cartegory_id = '$cartegory_id'";
        $result = $this->db->delete($query);
        header('location:cartegorylist.php');
        return $result;
    }
}
?>