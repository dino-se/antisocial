<?php
include("../dbconnect.php");

$user_id = 13;
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

    $query = "INSERT INTO image (user_id, filename) VALUES (:user_id, :file)";
    $statement = $connection->prepare($query);

    foreach ($uploaded_files as $file) {
        $statement->bindParam(':user_id', $user_id);
        $statement->bindParam(':file', $file);
        $res = $statement->execute();
    }

    if ($res) {
        echo json_encode(['res' => 'success']);
    } else {
        echo json_encode(['res' => 'error']);
    }
} catch(PDOException $th) {
    echo json_encode(['error' => $th->getMessage()]);
}
?>
