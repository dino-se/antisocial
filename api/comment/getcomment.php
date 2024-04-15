<?php
include("../dbconnect.php");

$postid = $_GET['postid'];

try{
    $query = "SELECT * FROM comment WHERE post_id = $postid ORDER BY comment_id DESC";
    $statement = $connection->prepare($query);
    $statement->execute();
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($result);
}catch (PDOException $th ) {
    echo json_encode(['error' => $th->getMessage()]);
}
?>