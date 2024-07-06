<?php
include "../../../../../../config/conn.php";

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_GET['id'])) {
    $paymentId = $_GET['id'];
    $query = mysqli_query($conn, "UPDATE payment SET status = 'success', successPayment = NOW() WHERE id = $paymentId");

    if ($query) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false]);
    }
} else {
    echo json_encode(['success' => false]);
}
?>
