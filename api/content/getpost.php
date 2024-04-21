<?php
header('Content-type: application/json');

include("../dbconnect.php");

$muid = $_GET['muid'];
$fuid = $_GET['fuid'] ?? null;

try {
    $query = "SELECT * FROM post 
              INNER JOIN users ON post.user_id = users.user_id 
              LEFT JOIN followers ON post.user_id = followers.following_id
              LEFT JOIN image ON image.image_uid = post.image_uid 
              WHERE followers.follower_id = :fuid OR users.user_id = :muid
              GROUP BY post.post_id
              ORDER BY post.post_id DESC";
    $stmt = $connection->prepare($query);
    $stmt->bindParam(':fuid', $fuid);
    $stmt->bindParam(':muid', $muid);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($result);
} catch (PDOException $th) {
    echo json_encode(['error' => $th->getMessage()]);
}
?>