<?php
include("../dbconnect.php");

$follower_id = $_GET['uid'];
$following_id = $_GET['suid'];

$query = "INSERT INTO followers (follower_id, following_id)
          VALUES (:follower_id, :following_id)";
$stmt = $connection->prepare($query);
$stmt->bindParam(':follower_id', $follower_id);
$stmt->bindParam(':following_id', $following_id);
$res = $stmt->execute();

if ($res) {
    echo json_encode(['res' => 'success']);
} else {
    echo json_encode(['res' => 'error']);
}
?>
