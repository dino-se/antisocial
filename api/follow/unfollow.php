<?php
include("../dbconnect.php");


$follower_id = $_GET['uid'];
$following_id = $_GET['suid'];

$query = "DELETE FROM followers
          WHERE follower_id = $follower_id AND following_id = $following_id";
$stmt = $connection->prepare($query);
$stmt->execute();

if ($stmt->rowCount() > 0) {
        echo json_encode(['res' => 'success']);
} else {
        echo json_encode(['res' => 'error', 'message' => 'Category not found']);
}
?>