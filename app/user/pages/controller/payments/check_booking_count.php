<?php
include "../../config/conn.php";

$query = mysqli_query($conn, "SELECT COUNT(*) AS count FROM payment WHERE endTime < NOW() AND status != 'canceled'");

$row = mysqli_fetch_assoc($query);
$count = $row['count'];

echo json_encode(['count' => $count]);

mysqli_close($conn);
?>
