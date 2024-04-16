<?php
include("../dbconnect.php");

$id = $_GET['id'];
$name = $_GET['comment'];

try {
    $query = "UPDATE comment SET comment_text = :name WHERE comment_id = :id";
    $statement = $connection->prepare($query);
    $statement->bindParam(':id', $id);
    $statement->bindParam(':name', $name);
    $statement->execute();

    echo json_encode(["res" => "success"]);
} catch(PDOException $th) {
    echo json_encode(['error' => $th->getMessage()]);
}
?>