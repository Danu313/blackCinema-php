<?php
include "../../../../../config/conn.php";
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userId = isset($_SESSION['user_id']) ? intval($_SESSION['user_id']) : null;
    $userName = isset($_SESSION['user_username']) ? mysqli_real_escape_string($conn, $_SESSION['user_username']) : null;
    $userEmail = isset($_SESSION['user_email']) ? mysqli_real_escape_string($conn, $_SESSION['user_email']) : null;

    $movieId = isset($_POST['movieId']) ? intval($_POST['movieId']) : null;
    $startTime = isset($_POST['startTime']) ? mysqli_real_escape_string($conn, $_POST['startTime']) : null;

    $queryMovie = mysqli_query($conn, "SELECT * FROM movie WHERE id='$movieId'");
    if ($queryMovie && mysqli_num_rows($queryMovie) > 0) {
        $rowMovie = mysqli_fetch_assoc($queryMovie);
        $calculateEndTime = date('Y-m-d H:i:s', strtotime('+' . $rowMovie['movieDuration'] . ' minutes', strtotime($startTime)));
    } else {
        die("Error: Movie not found.");
    }

    $endTime = mysqli_real_escape_string($conn, $calculateEndTime);
    $feeAdmin = 5000;
    $promoCode = isset($_POST['promoCode']) ? mysqli_real_escape_string($conn, $_POST['promoCode']) : null;
    $price = isset($_POST['price']) ? intval($_POST['price']) : null;

    if (!empty($promoCode)) {
        $queryPaymentPromo = mysqli_query($conn, "SELECT * FROM payment_promo WHERE promoCode LIKE '%$promoCode%'");
        if ($queryPaymentPromo && mysqli_num_rows($queryPaymentPromo) > 0) {
            $rowPaymentPromo = mysqli_fetch_assoc($queryPaymentPromo);
            $promoDiscount = $rowPaymentPromo['discount'];
            $totalPrice = $price + $feeAdmin - $promoDiscount;
        } else {
            $totalPrice = $price + $feeAdmin;
        }
    } else {
        $totalPrice = $price + $feeAdmin;
    }

    $packageName = isset($_POST['packageName']) ? mysqli_real_escape_string($conn, $_POST['packageName']) : null;
    $methodPayment = isset($_POST['methodPayment']) ? mysqli_real_escape_string($conn, $_POST['methodPayment']) : null;
    $status = "pending";
    date_default_timezone_set('Asia/Bangkok');

    $expiredPayment = date('Y-m-d H:i:s', strtotime('+30 minutes'));
    $successPayment = null;

    $dateStart = new DateTime($startTime);

    function findLargestRoom($conn, $dateStart)
    {
        $largestRoom = 1;
        $query = mysqli_query($conn, "SELECT * FROM payment WHERE status != 'canceled'");
        while ($row = mysqli_fetch_assoc($query)) {
            $paymentStart = new DateTime($row['startTime']);
            $paymentEnd = new DateTime($row['endTime']);
            if ($paymentStart <= $dateStart && $paymentEnd > $dateStart && $row['room'] > $largestRoom) {
                $largestRoom = $row['room'];
            }
        }
        return $largestRoom;
    }

    function findNextRoom($conn, $dateStart)
    {
        $largestRoom = findLargestRoom($conn, $dateStart);

        $query = mysqli_query($conn, "SELECT * FROM payment WHERE status != 'canceled'");

        $passedEndTimeCount = 0;
        $roomCount = 0;

        while ($row = mysqli_fetch_assoc($query)) {
            $paymentStart = new DateTime($row['startTime']);
            $paymentEnd = new DateTime($row['endTime']);

            if ($paymentStart <= $dateStart && $paymentEnd > $dateStart) {
                if ($paymentEnd <= new DateTime()) {
                    $passedEndTimeCount++;
                }

                if ($row['room'] >= $largestRoom) {
                    $largestRoom = $row['room'] + 1;
                }

                $roomCount++;
            }
        }

        if ($passedEndTimeCount > 6) {
            echo "<script>alert('More than 6 bookings have passed their endTime.');</script>";
        }

        return $largestRoom;
    }



    $room = findNextRoom($conn, $dateStart);

    $insertQuery = "INSERT INTO payment 
                    (userId, movieId, startTime, endTime, userName, userEmail, feeAdmin, price, totalPrice, 
                     packageName, methodPayment, promoCode, status, expiredPayment, successPayment, room)
                    VALUES 
                    ('$userId', '$movieId', '$startTime', '$endTime', '$userName', '$userEmail', '$feeAdmin', '$price', '$totalPrice',
                     '$packageName', '$methodPayment', '$promoCode', '$status', '$expiredPayment', NULL, '$room')";

    if (mysqli_query($conn, $insertQuery)) {
        header('Location: ../../../movie_cart');
        exit;
    } else {
        echo "Error: " . $insertQuery . "<br>" . mysqli_error($conn);
    }
}

mysqli_close($conn);
