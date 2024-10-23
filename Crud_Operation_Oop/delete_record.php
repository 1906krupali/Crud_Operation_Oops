<?php
include_once("config.php");
include('details.php');

error_reporting(E_ALL);

class DeleteRecord {
    private $mysqli;

    public function __construct($mysqli) {
        $this->mysqli = $mysqli;
    }

    public function deleteRecord($id) {
        $query = "DELETE FROM user WHERE id=?";
        $statement = $this->mysqli->prepare($query);
        $statement->bind_param('i', $id);

        $result = $statement->execute();

        return $result;
    }
}
if (isset($_GET["id"])) {
    $id = $_GET['id'];

    $database = new Database();
    $conn = $database->getConnection();

    if ($conn === false) {
        echo "Database connection failed!";
        exit;
    }

    $deleteRecord = new DeleteRecord($conn);
    $data = $deleteRecord->deleteRecord($id);

    if ($data) {
        echo "Record Deleted From Database<script>alert('Record Deleted From Database')</script>";
        header("Location: http://localhost/Crud_Operation_Oop/display_record.php");
        exit; 
    } else {
        echo "<font color='red'>Failed to delete record from database";
    }
}
?>
