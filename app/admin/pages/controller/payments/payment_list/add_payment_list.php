<?php
include "../../../../../../config/conn.php";
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userId = $_SESSION['user_id'];
    $userName = $_SESSION['user_username'];
    $userEmail = $_SESSION['user_email'];

    $movieId = 707;

    // $movieId = isset($_POST['movieId']) ? intval($_POST['movieId']) : null;
    $startTime = isset($_POST['startTime']) ? mysqli_real_escape_string($conn, $_POST['startTime']) : null;
    $endTime = isset($_POST['endTime']) ? mysqli_real_escape_string($conn, $_POST['endTime']) : null;
    $feeAdmin = isset($_POST['feeAdmin']) ? intval($_POST['feeAdmin']) : null;
    $price = isset($_POST['price']) ? intval($_POST['price']) : null;
    $totalPrice = isset($_POST['totalPrice']) ? intval($_POST['totalPrice']) : null;
    $packageName = isset($_POST['packageName']) ? mysqli_real_escape_string($conn, $_POST['packageName']) : null;
    $methodPayment = isset($_POST['methodPayment']) ? mysqli_real_escape_string($conn, $_POST['methodPayment']) : null;
    $promoCode = isset($_POST['promoCode']) ? mysqli_real_escape_string($conn, $_POST['promoCode']) : null;
    $status = isset($_POST['status']) ? mysqli_real_escape_string($conn, $_POST['status']) : null;
    $expiredPayment = isset($_POST['expiredPayment']) ? mysqli_real_escape_string($conn, $_POST['expiredPayment']) : null;
    $successPayment = isset($_POST['successPayment']) ? mysqli_real_escape_string($conn, $_POST['successPayment']) : null;
    $room = isset($_POST['room']) ? intval($_POST['room']) : null;

    $startTime = $startTime ? "'" . $startTime . "'" : "NULL";
    $endTime = $endTime ? "'" . $endTime . "'" : "NULL";
    $expiredPayment = $expiredPayment ? "'" . $expiredPayment . "'" : "NULL";
    $successPayment = $successPayment ? "'" . $successPayment . "'" : "NULL";

    $insertQuery = "INSERT INTO payment 
                    (userId, movieId, startTime, endTime, userName, userEmail, feeAdmin, price, totalPrice, 
                     packageName, methodPayment, promoCode, status, expiredPayment, successPayment, room)
                    VALUES 
                    ($userId, $movieId, $startTime, $endTime, '$userName', '$userEmail', $feeAdmin, $price, $totalPrice,
                     '$packageName', '$methodPayment', '$promoCode', '$status', $expiredPayment, $successPayment, $room)";

    if (mysqli_query($conn, $insertQuery)) {
        header('Location: pages/views/payment_list.php');
        exit;
    } else {
        echo "Error: " . $insertQuery . "<br>" . mysqli_error($conn);
    }
}

mysqli_close($conn);
?>
