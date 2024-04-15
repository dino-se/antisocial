<?php
include("../dbconnect.php");

$userid = $_POST['userid'];
$content = $_POST['content'];

$query = "INSERT INTO post(user_id, content)
          VALUE (:userid, :content)";
$stmt = $connection->prepare($query);
$stmt->bindParam(':userid',$userid);
$stmt->bindParam(':content',$content);
$res = $stmt->execute();

if ($res) {
    echo json_encode(['res' => 'success']);
} else {
    echo json_encode(['res' => 'error']);
}
?>