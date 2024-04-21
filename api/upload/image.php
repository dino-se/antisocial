<?php
include("../dbconnect.php");

$user_id = 13;
$img_uid = mt_rand(10000000000, 99999999999);
$files = $_FILES['img'];

try {
    $uploaded_files = [];

    foreach ($files['tmp_name'] as $key => $tmp_name) {
        $filename = time() . '_' . basename($files["name"][$key]);
        $target_file = '../public/img/' . $filename;
        move_uploaded_file($files["tmp_name"][$key], $target_file);

        $target_file = str_replace("../", "", $target_file);
        $uploaded_files[] = $target_file;
    }

    $query = "INSERT INTO image (user_id, filename, image_uid) VALUES (:user_id, :file, :image_uid)";
    $statement = $connection->prepare($query);

    foreach ($uploaded_files as $file) {
        $statement->bindParam(':user_id', $user_id);
        $statement->bindParam(':file', $file);
        $statement->bindParam(':image_uid', $getid);
        $res = $statement->execute();
    }

    if ($res) {
        echo json_encode(['res' => 'success', 'img_uid' => $getid]);
    } else {
        echo json_encode(['res' => 'error']);
    }
} catch(PDOException $th) {
    echo json_encode(['error' => $th->getMessage()]);
}
?>
