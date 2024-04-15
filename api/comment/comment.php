<?php
include("../dbconnect.php");

$postid = $_POST['postid'];
$userid = $_POST['userid'];
$commenttext = $_POST['commenttext'];

$query = "INSERT INTO comment(user_id, post_id, comment_text)
          VALUE (:user_id, :post_id, :comment_text)";
$stmt = $connection->prepare($query);
$stmt->bindParam(':user_id',$userid);
$stmt->bindParam(':post_id',$postid);
$stmt->bindParam(':comment_text',$commenttext);
$res = $stmt->execute();

if ($res) {
    echo json_encode(['res' => 'success']);
} else {
    echo json_encode(['res' => 'error']);
}
?>