<?php
include("../dbconnect.php");

$commentid = $_GET['id'];

try {
    $query = "DELETE FROM comment WHERE comment_id = $commentid";
    $stmt = $connection->prepare($query);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        echo json_encode(['res' => 'success']);
    } else {
        echo json_encode(['res' => 'error',
                          'message' => 'Invalid request']);
    }

} catch (PDOException $th) {
    echo json_encode(['error' => $th->getMessage()]);
}

?>