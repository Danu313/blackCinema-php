<?php
include "../../../../../config/conn.php";

if ($_SERVER["REQUEST_METHOD"] === "DELETE" && isset($_GET['id'])) {
    $movieId = $_GET['id'];
    $query = mysqli_query($conn, "DELETE FROM movie WHERE id = $movieId");

    if ($query) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false]);
    }
} else {
    echo json_encode(['success' => false]);
}
?>
