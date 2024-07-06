<?php
include "../../../../../../config/conn.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $paymentCardId = mysqli_real_escape_string($conn, $_POST['paymentCardId']);
    $numberCard = mysqli_real_escape_string($conn, $_POST['numberCard']);
    $nameCard = mysqli_real_escape_string($conn, $_POST['nameCard']);
    $imageCard = mysqli_real_escape_string($conn, $_POST['imageCard']);
    $categoryInstitue = mysqli_real_escape_string($conn, $_POST['categoryInstitue']);
    $imageQR = mysqli_real_escape_string($conn, $_POST['imageQR']);

    $updateQuery = "UPDATE payment_card 
                    SET numberCard='$numberCard', nameCard='$nameCard', imageCard='$imageCard', categoryInstitue='$categoryInstitue', imageQR='$imageQR'
                    WHERE id='$paymentCardId'";

    if (mysqli_query($conn, $updateQuery)) {
        header("Location: ../../../../payment_card");
        exit();
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }
}

mysqli_close($conn);
?>
