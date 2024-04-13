<?php
include("../dbconnect.php");

$username = $_POST['username'];
$password = $_POST['password'];

$stmt = $connection->prepare("SELECT * FROM users WHERE username = :username AND password = :password");
$stmt->bindParam(':username', $username);
$stmt->bindParam(':password', $password);
$stmt->execute();

if ($stmt->rowCount() > 0) {
    session_start();
    $_SESSION['username'] = $username;
    //header("Location: index.php");
    echo "hello";
    exit();
} else {
    $error_message = "Incorrect username or password";
}
?>
