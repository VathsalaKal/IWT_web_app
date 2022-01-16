<?php
require_once("conn.php");

$id = $_POST['delete_id'];
$query = "delete from items where i_id = $id";
if ($conn->query($query) === TRUE) {
    echo "Record deleted successfully";
} else {
    echo "Error deleting record: " . $conn->error;
}

$conn->close();