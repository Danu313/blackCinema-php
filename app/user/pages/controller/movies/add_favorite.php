<?php
include("../../conn.php");
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $movieId = isset($_POST['id']) ? intval($_POST['id']) : 0;
    $favorite = isset($_POST['favorite']) ? $_POST['favorite'] : false;

    if ($movieId > 0) {
        $query = "SELECT * FROM movie WHERE id = $movieId";
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) > 0) {
            $userId = $_SESSION['user_id'];

            $checkQuery = "SELECT * FROM favorites WHERE user_id = $userId AND movie_id = $movieId";
            $checkResult = mysqli_query($conn, $checkQuery);

            if (mysqli_num_rows($checkResult) > 0) {
                $deleteQuery = "DELETE FROM favorites WHERE user_id = $userId AND movie_id = $movieId";
                mysqli_query($conn, $deleteQuery);
                echo "removed";
            } else {
                $insertQuery = "INSERT INTO favorites (user_id, movie_id) VALUES ($userId, $movieId)";
                mysqli_query($conn, $insertQuery);
                echo "added";
            }
        } else {
            echo "error";
        }
    } else {
        echo "error";
    }
} else {
    echo "error";
}
?>
