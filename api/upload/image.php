<?php
include("../dbconnect.php");

$user_id = $_POST['uid'];
$files = $_FILES['img'];

try {
    $uploaded_files = [];

    foreach ($files['tmp_name'] as $key => $tmp_name) {
        $img_uid = mt_rand();
        $filename = time() . '_' . basename($files["name"][$key]);
        $target_file = '../public/img/' . $filename;
        move_uploaded_file($files["tmp_name"][$key], $target_file);

        $target_file = str_replace("../", "/api/", $target_file);
        $uploaded_files[] = $target_file;
    }

    $query = "INSERT INTO image (user_id, filename, image_uid) VALUES (:user_id, :file, :image_uid)";
    $statement = $connection->prepare($query);

    foreach ($uploaded_files as $file) {
        $statement->bindParam(':user_id', $user_id);
        $statement->bindParam(':file', $file);
        $statement->bindParam(':image_uid', $img_uid);
        $res = $statement->execute();
    }

    if ($res) {
        echo json_encode(['res' => 'success', 'img_uid' => $img_uid]);
    } else {
        echo json_encode(['res' => 'error']);
    }
} catch(PDOException $th) {
    echo json_encode(['error' => $th->getMessage()]);
}

?>
