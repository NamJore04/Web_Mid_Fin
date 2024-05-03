<?php 
include 'database.php';

class Employee {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function insert_employee($employee_name, $employee_email, $token, $activated) {
        $query = "INSERT INTO tbl_employees (employee_name, employee_email, token, activated) VALUES ('$employee_name', '$employee_email', '$token', 0)";
        $result = $this->db->insert($query);
        return $result;
    }

    public function update_employee($employee_name, $employee_id) {
        $query = "UPDATE tbl_employee SET employee_name = '$employee_name' WHERE employee_id = '$employee_id'";
        $result = $this->db->update($query);
        return $result;
    }

    public function delete_employee($employee_id) {
        $query = "DELETE FROM tbl_employee WHERE employee_id = '$employee_id'";
        $result = $this->db->delete($query);
        return $result;
    }
}
?>
