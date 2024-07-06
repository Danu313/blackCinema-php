<?php

session_start();
if ($_SESSION['user_role'] != "admin") {
    header("location: ../../signin");
}
?>

<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Dashboard</title>
    <link rel="stylesheet" href="../../style/globals.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css">
    <script src="https://cdn.jsdelivr.net/npm/moment/moment.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <style>
        .daterangepicker {
            background-color: rgba(0, 0, 0, 0.6) !important;
            color: #cbd5e0;
        }

        .daterangepicker td,
        .daterangepicker th {
            color: #cbd5e0;
        }

        .daterangepicker .calendar-time {
            color: #cbd5e0 !important;
        }

        .daterangepicker td.off,
        .daterangepicker td.off.in-range,
        .daterangepicker td.off.start-date,
        .daterangepicker td.off.end-date {
            background-color: transparent !important;
        }

        .daterangepicker .calendar-table .next span,
        .daterangepicker .calendar-table .prev span {
            border: solid white !important;
            border-width: 0 2px 2px 0 !important;
        }

        .daterangepicker .calendar-table .next:hover,
        .daterangepicker .calendar-table .prev:hover {
            background-color: rgba(255, 255, 255, 0.1) !important;
        }

        .daterangepicker td.available:hover, .daterangepicker th.available:hover {
            background-color: rgba(255, 255, 255, 0.1) !important;
        }

        .daterangepicker .calendar-time .hour,
        .daterangepicker .calendar-time .minute {
            color: #cbd5e0 !important;
        }

        .daterangepicker .calendar-table {
            background-color: rgba(0, 0, 0, 0.6) !important;
        }

        .daterangepicker .daterangepicker-selected {
            background-color: #4a5568 !important;
        }
    </style>
</head>

<body class="bg-white text-black dark:bg-black dark:text-white">
    <div>
        <?php include "pages/navbar.php"; ?>
        <?php include "pages/content.php"; ?>
    </div>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>

</html>