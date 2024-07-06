<?php
include "../../config/conn.php";

$user_id = $_GET['user_id'] ?? null;

$query = mysqli_query($conn, "SELECT * FROM user WHERE user_id='$user_id'");
$row = mysqli_fetch_assoc($query);

if (!$row) {
    exit('User not found.');
}

mysqli_close($conn);
?>


<div class="w-full h-auto">
    <div class="flex px-10 items-center justify-center self-center">
        <form id="editMovieForm" class="p-4 md:p-5" action="pages/controller/payments/payment_list/edit_payment_list.php" method="POST">
            <input type="hidden" id="user_id" name="user_id" value="<?= $row['user_id']; ?>">
            <div class="flex flex-row w-full gap-3">
                <div class="mb-4 w-1/2">
                    <label for="user_username" class="block mb-2 text-sm font-medium text-gray-600 dark:text-gray-300">Waktu Mulai</label>
                    <input type="text" id="user_username" value="<?= $row['user_username']; ?>" name="user_username" placeholder="nama" required class="w-full px-3 py-2 placeholder-gray-300 border border-gray-300 rounded-md focus:outline-none focus:ring-gray-500 focus:border-gray-500 dark:bg-gray-800 dark:border-gray-600 dark:focus:ring-gray-500 dark:focus:border-gray-500 dark:text-white">
                </div>
                <div class="mb-4 w-1/2">
                    <label for="user_email" class="block mb-2 text-sm font-medium text-gray-600 dark:text-gray-300">Waktu Selesai</label>
                    <input type="text" id="user_email" value="<?= $row['user_email']; ?>" name="user_email" placeholder="email" required class="w-full px-3 py-2 placeholder-gray-300 border border-gray-300 rounded-md focus:outline-none focus:ring-gray-500 focus:border-gray-500 dark:bg-gray-800 dark:border-gray-600 dark:focus:ring-gray-500 dark:focus:border-gray-500 dark:text-white">
                </div>
            </div>
            <div class="flex flex-row w-full gap-3">
                <div class="mb-4 w-full">
                    <label for="user_role" class="block mb-2 text-sm font-medium text-gray-600 dark:text-gray-300">Harga</label>
                    <input type="text" id="user_role" value="<?= $row['user_role']; ?>" name="user_role" placeholder="admin/user" required class="w-full px-3 py-2 placeholder-gray-300 border border-gray-300 rounded-md focus:outline-none focus:ring-gray-500 focus:border-gray-500 dark:bg-gray-800 dark:border-gray-600 dark:focus:ring-gray-500 dark:focus:border-gray-500 dark:text-white">
                </div>
            </div>
            <div class="mt-2 flex justify-center w-full">
                <button type="submit" id="updateMovieBtn" class="bg-gray-600 hover:bg-gray-700 text-white rounded-md px-4 py-2 transition duration-200 focus:outline-none focus:ring-4 focus:ring-gray-300">Update</button>
            </div>
        </form>
    </div>
</div>