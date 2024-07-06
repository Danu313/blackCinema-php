<?php
include "../../config/conn.php";

$paymentPromoId = $_GET['id'] ?? null;

$query = mysqli_query($conn, "SELECT * FROM payment_promo WHERE id='$paymentPromoId'");
$row = mysqli_fetch_assoc($query);

if (!$row) {
    exit('Payment promo_code not found.');
}

mysqli_close($conn);
?>


<div class="w-full h-auto">
    <div class="flex px-10 items-center justify-center self-center">
        <form id="editMovieForm" class="p-4 md:p-5" action="pages/controller/payments/payment_promo_code/edit_payment_promo_code.php" method="POST">
            <input type="hidden" id="paymentPromoId" name="paymentPromoId" value="<?= $row['id']; ?>">
            <div class="flex flex-row w-full gap-3">
                <div class="mb-4 w-1/2">
                    <label for="promoCode" class="block mb-2 text-sm font-medium text-gray-600 dark:text-gray-300">Kode Promo</label>
                    <input type="text" id="promoCode" name="promoCode" value="<?= $row['promoCode']; ?>" placeholder="nama paket" required class="w-full px-3 py-2 placeholder-gray-300 border border-gray-300 rounded-md focus:outline-none focus:ring-gray-500 focus:border-gray-500 dark:bg-gray-800 dark:border-gray-600 dark:focus:ring-gray-500 dark:focus:border-gray-500 dark:text-white">
                </div>
                <div class="mb-4 w-1/2">
                    <label for="priceDisc" class="block mb-2 text-sm font-medium text-gray-600 dark:text-gray-300">Diskon</label>
                    <input type="number" id="priceDisc" name="priceDisc" value="<?= $row['priceDisc']; ?>" placeholder="0" required class="w-full px-3 py-2 placeholder-gray-300 border border-gray-300 rounded-md focus:outline-none focus:ring-gray-500 focus:border-gray-500 dark:bg-gray-800 dark:border-gray-600 dark:focus:ring-gray-500 dark:focus:border-gray-500 dark:text-white">
                </div>
            </div>
            <div class="flex flex-row w-full gap-3">
                <div class="mb-4 w-1/2">
                    <label for="usable" class="block mb-2 text-sm font-medium text-gray-600 dark:text-gray-300">Tgl. Berlaku</label>
                    <input type="datetime-local" id="usable" name="usable" value="<?= $row['usable']; ?>" placeholder="0" required class="w-full px-3 py-2 placeholder-gray-300 border border-gray-300 rounded-md focus:outline-none focus:ring-gray-500 focus:border-gray-500 dark:bg-gray-800 dark:border-gray-600 dark:focus:ring-gray-500 dark:focus:border-gray-500 dark:text-white">
                </div>
                <div class="mb-4 w-1/2">
                    <label for="expired" class="block mb-2 text-sm font-medium text-gray-600 dark:text-gray-300">Tgl. Expired</label>
                    <input type="datetime-local" id="expired" name="expired" value="<?= $row['expired']; ?>" placeholder="0" required class="w-full px-3 py-2 placeholder-gray-300 border border-gray-300 rounded-md focus:outline-none focus:ring-gray-500 focus:border-gray-500 dark:bg-gray-800 dark:border-gray-600 dark:focus:ring-gray-500 dark:focus:border-gray-500 dark:text-white">
                </div>
            </div>
            <div class="mt-2 flex justify-center w-full">
                <button type="submit" id="updateMovieBtn" class="bg-gray-600 hover:bg-gray-700 text-white rounded-md px-4 py-2 transition duration-200 focus:outline-none focus:ring-4 focus:ring-gray-300">Update</button>
            </div>
        </form>
    </div>
</div>