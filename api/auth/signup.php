<?php
include("../dbconnect.php");

$email = $_POST['email'];
$fullname = $_POST['fullname'];
$username = $_POST['username'];
$password = $_POST['password'];

$query = "INSERT INTO users(email, fullname, username, password)
          VALUE (:email, :fullname, :username, :password)";
$stmt = $connection->prepare($query);
$stmt->bindParam(':email',$email);
$stmt->bindParam(':fullname',$fullname);
$stmt->bindParam(':username',$username);
$stmt->bindParam(':password',$password);
$res = $stmt->execute();

if ($res) {
    echo json_encode(['res' => 'success']);
} else {
    echo json_encode(['res' => 'error']);
}
?>