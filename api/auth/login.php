<?php
$validUsername = 'user';
$validPassword = 'password';

$username = $_POST['username'];
$password = $_POST['password'];

if($username === $validUsername && $password === $validPassword) {
    $response = array('success' => true);
} else {
    $response = array('success' => false);
}
header('Content-Type: application/json');
echo json_encode($response);
?>
