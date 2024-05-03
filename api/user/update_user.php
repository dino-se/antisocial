<?php
include("../dbconnect.php");

if(isset($_POST['userid']) && isset($_POST['username'])) {
    $uid = $_POST['userid'];
    $fname = $_POST['fullname'];
    $uname = strtolower($_POST['username']);

    try {
        $query = "UPDATE users SET fullname = :fname, username = :uname
                  WHERE user_id = :uid";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':uid', $uid);
        $stmt->bindParam(':fname', $fname);
        $stmt->bindParam(':uname', $uname);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            echo json_encode(['res' => 'success']);
        } else {
            echo json_encode(['res' => 'error',
                              'message' => 'Invalid request']);
        }
    } catch(PDOException $th) {
        echo json_encode(['error' => $th->getMessage()]);
    }
} else {
    echo json_encode(['error' => 'Missing reference']);
}

?>