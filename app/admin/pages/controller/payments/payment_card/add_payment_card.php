<?php
include "../../../../../../config/conn.php";
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $numberCard = isset($_POST['numberCard']) ? mysqli_real_escape_string($conn, $_POST['numberCard']) : null;
    $nameCard = isset($_POST['nameCard']) ? mysqli_real_escape_string($conn, $_POST['nameCard']) : null;
    $imageCard = isset($_POST['imageCard']) ? mysqli_real_escape_string($conn, $_POST['imageCard']) : null;
    $categoryInstitue = isset($_POST['categoryInstitue']) ? mysqli_real_escape_string($conn, $_POST['categoryInstitue']) : null;
    $imageQR = isset($_POST['imageQR']) ? mysqli_real_escape_string($conn, $_POST['imageQR']) : null;

    $insertQuery = "INSERT INTO payment_card (numberCard, nameCard, imageCard, categoryInstitue, imageQR) 
                    VALUES (" . var_export($numberCard, true) . ", " . var_export($nameCard, true) . ", " . var_export($imageCard, true) . ", " . var_export($categoryInstitue, true) . ", " . var_export($imageQR, true) . ")";

    if (mysqli_query($conn, $insertQuery)) {
        header('Location: pages/views/payment_card.php');
        exit;
    } else {
        echo "Error: " . $insertQuery . "<br>" . mysqli_error($conn);
    }
}

mysqli_close($conn);
?>
