<?php
include("../dbconnect.php");

$email = $_POST['email'];
$fullname = $_POST['fullname'];
$username = $_POST['username'];
$password = $_POST['password'];

$query = "INSERT INTO users(email, fullname, username, password)
          VALUE (:email, :fullname, :username, :password)";
$statement = $connection->prepare($query);
$statement->bindParam(':email',$email);
$statement->bindParam(':fullname',$fullname);
$statement->bindParam(':username',$username);
$statement->bindParam(':password',$password);
$res = $statement->execute();

if ($res) {
    echo json_encode(['res' => 'success']);
} else {
    echo json_encode(['res' => 'error']);
}
?>