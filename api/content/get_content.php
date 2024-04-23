<?php
header('Content-type: application/json');

include("../dbconnect.php");

if(isset($_GET['cuid'])) {
    $cuid = $_GET['cuid'];
    $fuid = $_GET['fuid'] ?? null;

    try {
        $query = "SELECT post.*,
                users.user_id, users.fullname, users.username, 
                image.filename, image.image_uid
                FROM post 
                INNER JOIN users ON post.user_id = users.user_id 
                LEFT JOIN followers ON post.user_id = followers.following_id
                LEFT JOIN image ON image.image_uid = post.image_uid 
                WHERE followers.follower_id = :fuid OR users.user_id = :cuid
                ORDER BY post.post_id DESC";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':fuid', $fuid);
        $stmt->bindParam(':cuid', $cuid);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $groupedResult = [];
        foreach ($result as $row) {
            $postId = $row['post_id'];
            $filename = $row['filename'];
            if (!isset($groupedResult[$postId])) {
                $groupedResult[$postId] = $row;
                $groupedResult[$postId]['filenames'] = [];
            }
            $groupedResult[$postId]['filenames'][] = $filename;
            unset($groupedResult[$postId]['filename']);
            unset($groupedResult[$postId]['image_id']);
        }
        $finalResult = array_values($groupedResult);

        echo json_encode($finalResult);
    } catch (PDOException $th) {
        echo json_encode(['error' => $th->getMessage()]);
    }
} else {
    echo json_encode(['error' => 'No content found']);
}

?>