<?php
include "../../../../../../config/conn.php";
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $promoCode = isset($_POST['promoCode']) ? mysqli_real_escape_string($conn, $_POST['promoCode']) : null;
    $priceDisc = isset($_POST['priceDisc']) ? mysqli_real_escape_string($conn, $_POST['priceDisc']) : null;
    $usable = isset($_POST['usable']) ? mysqli_real_escape_string($conn, $_POST['usable']) : null;
    $expired = isset($_POST['expired']) ? mysqli_real_escape_string($conn, $_POST['expired']) : null;

    $insertQuery = "INSERT INTO payment_promo (promoCode, priceDisc, usable, expired) 
                    VALUES (" . var_export($promoCode, true) . ", " . var_export($priceDisc, true) . ", " . var_export($usable, true) . ", " . var_export($expired, true) . ")";

    if (mysqli_query($conn, $insertQuery)) {
        header('Location: pages/views/payment_promo.php');
        exit;
    } else {
        echo "Error: " . $insertQuery . "<br>" . mysqli_error($conn);
    }
}

mysqli_close($conn);
?>
