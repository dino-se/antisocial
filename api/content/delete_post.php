<?php
include("../dbconnect.php");


    $id = $_GET['id'];

    $query = "DELETE FROM post WHERE post_id = $id";
    $statement = $connection->prepare($query);
    $statement->execute();

    if ($statement->rowCount() > 0) {
        echo json_encode(['res' => 'success']);
    } else {
        echo json_encode(['res' => 'error', 'message' => 'Category not found']);
    }
?>