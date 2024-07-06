<?php
include "../../../../../../config/conn.php";
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $packageName = isset($_POST['packageName']) ? mysqli_real_escape_string($conn, $_POST['packageName']) : null;
    $capacity = isset($_POST['capacity']) ? mysqli_real_escape_string($conn, $_POST['capacity']) : null;
    $screenResolution = isset($_POST['screenResolution']) ? mysqli_real_escape_string($conn, $_POST['screenResolution']) : null;
    $price = isset($_POST['price']) ? mysqli_real_escape_string($conn, $_POST['price']) : null;

    $insertQuery = "INSERT INTO payment_plan (packageName, capacity, screenResolution, price) 
                    VALUES (" . var_export($packageName, true) . ", " . var_export($capacity, true) . ", " . var_export($screenResolution, true) . ", " . var_export($price, true) . ")";

    if (mysqli_query($conn, $insertQuery)) {
        header('Location: pages/views/payment_plan.php');
        exit;
    } else {
        echo "Error: " . $insertQuery . "<br>" . mysqli_error($conn);
    }
}

mysqli_close($conn);
?>
