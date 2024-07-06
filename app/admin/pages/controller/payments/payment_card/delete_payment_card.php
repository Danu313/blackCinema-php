<?php
include "../../../../../../config/conn.php";

if ($_SERVER["REQUEST_METHOD"] === "DELETE" && isset($_GET['id'])) {
    $paymentCardId = $_GET['id'];
    $query = mysqli_query($conn, "DELETE FROM payment_card WHERE id = $paymentCardId");

    if ($query) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false]);
    }
} else {
    echo json_encode(['success' => false]);
}
?>
