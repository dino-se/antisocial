<?php
include("../dbconnect.php");

$userid = $_POST['userid'];
$content = $_POST['content'];
$imguid = $_POST['imguid'] ?? null;

$query = "INSERT INTO post(user_id, content, image_uid)
          VALUE (:userid, :content, :imguid)";
$stmt = $connection->prepare($query);
$stmt->bindParam(':userid',$userid);
$stmt->bindParam(':content',$content);
$stmt->bindParam(':imguid',$imguid);
$res = $stmt->execute();

if ($res) {
    echo json_encode(['res' => 'success']);
} else {
    echo json_encode(['res' => 'error']);
}
?>