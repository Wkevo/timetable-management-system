<?php
include 'connection.php';
$id = $_GET['name'];
$q = mysqli_query(mysqli_connect("localhost", "root", "", "ttms"),
    "DELETE FROM classrooms WHERE name = '$id' ");
  $drop = "DROP TABLE " . $id;
  $q = mysqli_query(mysqli_connect("localhost", "root", "", "ttms"), $drop);
if ($drop) {
    
    header("Location:addclassrooms.php");

} else {
    echo 'Error';
}
?>