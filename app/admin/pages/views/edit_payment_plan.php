<?php
include "../../config/conn.php";

$paymentPlanId = $_GET['id'] ?? null;

$query = mysqli_query($conn, "SELECT * FROM payment_plan WHERE id='$paymentPlanId'");
$row = mysqli_fetch_assoc($query);

if (!$row) {
    exit('Payment plan not found.');
}

mysqli_close($conn);
?>


<div class="w-full h-auto">
    <div class="flex px-10 items-center justify-center self-center">
        <form id="editMovieForm" class="p-4 md:p-5" action="pages/controller/payments/payment_plan/edit_payment_plan.php" method="POST">
            <input type="hidden" id="paymentPlanId" name="paymentPlanId" value="<?= $row['id']; ?>">
            <div class="flex flex-row w-full gap-3">
                <div class="mb-4 w-1/2">
                    <label for="packageName" class="block mb-2 text-sm font-medium text-gray-600 dark:text-gray-300">Nama Paket</label>
                    <input type="text" id="packageName" name="packageName" value="<?= $row['packageName']; ?>" placeholder="nama paket" required class="w-full px-3 py-2 placeholder-gray-300 border border-gray-300 rounded-md focus:outline-none focus:ring-gray-500 focus:border-gray-500 dark:bg-gray-800 dark:border-gray-600 dark:focus:ring-gray-500 dark:focus:border-gray-500 dark:text-white">
                </div>
                <div class="mb-4 w-1/2">
                    <label for="capacity" class="block mb-2 text-sm font-medium text-gray-600 dark:text-gray-300">Kapasitas</label>
                    <input type="number" id="capacity" name="capacity" placeholder="0" value="<?= $row['capacity']; ?>" required class="w-full px-3 py-2 placeholder-gray-300 border border-gray-300 rounded-md focus:outline-none focus:ring-gray-500 focus:border-gray-500 dark:bg-gray-800 dark:border-gray-600 dark:focus:ring-gray-500 dark:focus:border-gray-500 dark:text-white">
                </div>
            </div>
            <div class="flex flex-row w-full gap-3">
                <div class="mb-4 w-1/2">
                    <label for="screenResolution" class="block mb-2 text-sm font-medium text-gray-600 dark:text-gray-300">Resolusi Layar (inch)</label>
                    <input type="number" id="screenResolution" name="screenResolution" value="<?= $row['screenResolution']; ?>" placeholder="0" required class="w-full px-3 py-2 placeholder-gray-300 border border-gray-300 rounded-md focus:outline-none focus:ring-gray-500 focus:border-gray-500 dark:bg-gray-800 dark:border-gray-600 dark:focus:ring-gray-500 dark:focus:border-gray-500 dark:text-white">
                </div>
                <div class="mb-4 w-1/2">
                    <label for="price" class="block mb-2 text-sm font-medium text-gray-600 dark:text-gray-300">Harga</label>
                    <input type="number" id="price" name="price" placeholder="0" value="<?= $row['price']; ?>" required class="w-full px-3 py-2 placeholder-gray-300 border border-gray-300 rounded-md focus:outline-none focus:ring-gray-500 focus:border-gray-500 dark:bg-gray-800 dark:border-gray-600 dark:focus:ring-gray-500 dark:focus:border-gray-500 dark:text-white">
                </div>
            </div>
            <div class="mt-2 flex justify-center w-full">
                <button type="submit" id="updateMovieBtn" class="bg-gray-600 hover:bg-gray-700 text-white rounded-md px-4 py-2 transition duration-200 focus:outline-none focus:ring-4 focus:ring-gray-300">Update</button>
            </div>
        </form>
    </div>
</div>