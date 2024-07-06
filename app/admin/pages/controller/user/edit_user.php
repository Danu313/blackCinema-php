<?php
include "../../../../../config/conn.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_POST['user_id'];
    $user_username = $_POST['user_username'];
    $user_email = $_POST['user_email'];
    $user_role = $_POST['user_role'];

    $updateQuery = "UPDATE user 
                    SET user_username='$user_username', user_email='$user_email', user_role='$user_role'
                    WHERE user_id='$user_id'";

    if (mysqli_query($conn, $updateQuery)) {
        header("Location: ../../../users");
        exit();
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }
}

mysqli_close($conn);
?>
