<?php
include "../../../../../../config/conn.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $paymentPromoId = mysqli_real_escape_string($conn, $_POST['paymentPromoId']);
    $promoCode = mysqli_real_escape_string($conn, $_POST['promoCode']);
    $priceDisc = mysqli_real_escape_string($conn, $_POST['priceDisc']);
    $usable = mysqli_real_escape_string($conn, $_POST['usable']);
    $expired = mysqli_real_escape_string($conn, $_POST['expired']);

    $updateQuery = "UPDATE payment_promo 
                    SET promoCode='$promoCode', priceDisc='$priceDisc', usable='$usable', expired='$expired'
                    WHERE id='$paymentPromoId'";

    if (mysqli_query($conn, $updateQuery)) {
        header("Location: ../../../../payment_promo_code");
        exit();
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }
}

mysqli_close($conn);
?>
