<?php
include("../dbconnect.php");

$username = $_POST['username'];
$password = $_POST['password'];

$stmt = $connection->prepare("SELECT * FROM users WHERE username = :username AND password = :password");
$stmt->bindParam(':username', $username);
$stmt->bindParam(':password', $password);
$stmt->execute();

if ($stmt->rowCount() > 0) {
    // Login successful
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $user_id = $row['user_id'];
    
    // Prepare JSON response
    $response = array(
        "success" => true,
        "user_id" => $user_id
    );
    
    // Send JSON response
    header('Content-Type: application/json');
    echo json_encode($response);
} else {
    echo "Incorrect username or password";
}
?>
