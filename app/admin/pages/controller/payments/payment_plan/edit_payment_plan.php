<?php
include "../../../../../../config/conn.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $paymentPlanId = mysqli_real_escape_string($conn, $_POST['paymentPlanId']);
    $packageName = mysqli_real_escape_string($conn, $_POST['packageName']);
    $capacity = mysqli_real_escape_string($conn, $_POST['capacity']);
    $screenResolution = mysqli_real_escape_string($conn, $_POST['screenResolution']);
    $price = mysqli_real_escape_string($conn, $_POST['price']);

    $updateQuery = "UPDATE payment_plan 
                    SET packageName='$packageName', capacity='$capacity', screenResolution='$screenResolution', price='$price'
                    WHERE id='$paymentPlanId'";

    if (mysqli_query($conn, $updateQuery)) {
        header("Location: ../../../../payment_plan");
        exit();
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }
}

mysqli_close($conn);
?>
