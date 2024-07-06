<?php
include "../../../../../../config/conn.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $paymentId = isset($_POST['paymentId']) ? intval($_POST['paymentId']) : null;
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

    $updateQuery = "UPDATE payment SET 
                    startTime = $startTime,
                    endTime = $endTime,
                    feeAdmin = $feeAdmin,
                    price = $price,
                    totalPrice = $totalPrice,
                    packageName = '$packageName',
                    methodPayment = '$methodPayment',
                    promoCode = '$promoCode',
                    status = '$status',
                    expiredPayment = $expiredPayment,
                    successPayment = $successPayment,
                    room = $room
                    WHERE id = $paymentId";

    if (mysqli_query($conn, $updateQuery)) {
        header("Location: ../../../../payment_list");
        exit();
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }
}

mysqli_close($conn);
?>
