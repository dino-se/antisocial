<?php
include("../dbconnect.php");

$cmntid = $_GET['id'];
$cmnttxt = $_GET['comment'];

try {
    $query = "UPDATE comment SET comment_text = :cmnttxt WHERE comment_id = :cmntid";
    $stmt = $connection->prepare($query);
    $stmt->bindParam(':cmntid', $cmntid);
    $stmt->bindParam(':cmnttxt', $cmnttxt);
    $stmt->execute();

    echo json_encode(["res" => "success"]);
} catch(PDOException $th) {
    echo json_encode(['error' => $th->getMessage()]);
}
?>