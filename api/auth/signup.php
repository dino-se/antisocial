<?php
include("../dbconnect.php");

$email = $_POST['email'];
$fullname = $_POST['fullname'];
$username = $_POST['username'];
$password = $_POST['password'];

$query = "INSERT INTO category(category_name) VALUE ('$name')";
$statement = $connection->prepare($query);
$res = $statement->execute();

if ($res) {
    echo json_encode(['res' => 'success']);
} else {
    echo json_encode(['res' => 'error']);
}
