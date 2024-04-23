<?php 
    include "database.php";
?>

<?php 
    class slide {
        private $db;

        public function __construct()
        {
            $this ->  db = new Database();

        } 
        public function insert_slide($slide_name) {
            $query = "INSERT INTO tbl_slide (slide_name) VALUES ('$slide_name')";
            $result = $this ->db->insert($query);
            // header('location:slidelist.php');

            // return $result;
        }

        // public function show_slide() {
        //     $query = "SELECT * FROM tbl_slide ORDER BY slide_id DESC";
        //     $result = $this->db->select($query);
        //     return $result;
        // }

        // public function get_slide($slide_id) {
        //     $query = "SELECT * FROM tbl_slide WHERE slide_id = '$slide_id'";
        //     $result = $this->db->select($query);
        //     return $result;
        // }

        public function update_slide($slide_name, $slide_id) {
            $query = "UPDATE  tbl_slide SET slide_name = '$slide_name' WHERE slide_id = '$slide_id'";
            $result = $this->db->update($query);
            // header('location:slidelist.php');
            return $result;
        }
        public function delte_slide($slide_id) {
            $query = "DELETE FROM tbl_slide WHERE slide_id = '$slide_id'";
            $result = $this->db->delete($query);
            // header('location:slidelist.php');
            return $result;
        }
    }
?>