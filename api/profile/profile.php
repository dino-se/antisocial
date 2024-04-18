<?php
header('Content-type: application/json');

include("../dbconnect.php");

if(isset($_GET['uid'])) {
    $uid = $_GET['uid'];

    try {
        $query = "SELECT * FROM users
        LEFT JOIN followers ON users.user_id = followers.follower_id
        WHERE user_id = :uid";
        $stmt = $connection->prepare($query);
        $stmt->bindParam(':uid', $uid);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($result);
    } catch (PDOException $th) {
        echo json_encode(['error' => $th->getMessage()]);
    }
} else {
    echo json_encode(['error' => 'postid parameter is missing']);
}
?>