<?php
include "../../config/conn.php";

$paymentId = $_GET['id'] ?? null;

$query = mysqli_query($conn, "SELECT * FROM payment WHERE id='$paymentId'");
$queryCard = mysqli_query($conn, "SELECT * FROM payment_card");
$row = mysqli_fetch_assoc($query);

if (!$row) {
    exit('Payment not found.');
}

mysqli_close($conn);
?>


<div class="w-full h-auto">
    <div class="flex px-10 items-center justify-center self-center">
        <form id="editMovieForm" class="p-4 md:p-5" action="pages/controller/payments/payment_list/edit_payment_list.php" method="POST">
            <input type="hidden" id="paymentId" name="paymentId" value="<?= $row['id']; ?>">
            <div class="flex flex-row w-full gap-3">
                <div class="mb-4 w-1/2">
                    <label for="startTime" class="block mb-2 text-sm font-medium text-gray-600 dark:text-gray-300">Waktu Mulai</label>
                    <input type="datetime-local" id="startTime" value="<?= $row['startTime']; ?>" name="startTime" placeholder="nama paket" required class="w-full px-3 py-2 placeholder-gray-300 border border-gray-300 rounded-md focus:outline-none focus:ring-gray-500 focus:border-gray-500 dark:bg-gray-800 dark:border-gray-600 dark:focus:ring-gray-500 dark:focus:border-gray-500 dark:text-white">
                </div>
                <div class="mb-4 w-1/2">
                    <label for="endTime" class="block mb-2 text-sm font-medium text-gray-600 dark:text-gray-300">Waktu Selesai</label>
                    <input type="datetime-local" id="endTime" value="<?= $row['endTime']; ?>" name="endTime" placeholder="0" required class="w-full px-3 py-2 placeholder-gray-300 border border-gray-300 rounded-md focus:outline-none focus:ring-gray-500 focus:border-gray-500 dark:bg-gray-800 dark:border-gray-600 dark:focus:ring-gray-500 dark:focus:border-gray-500 dark:text-white">
                </div>
            </div>
            <div class="flex flex-row w-full gap-3">
                <div class="mb-4 w-1/2">
                    <label for="status" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Status</label>
                    <select id="status" name="status" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option selected>Pilih Status</option>
                        <option value="pending" <?= ($row['status'] == 'pending') ? 'selected' : ''; ?>>Pending</option>
                        <option value="success" <?= ($row['status'] == 'success') ? 'selected' : ''; ?>>Sukses</option>
                        <option value="canceled" <?= ($row['status'] == 'canceled') ? 'selected' : ''; ?>>Cancel</option>
                    </select>
                </div>
                <div class="mb-4 w-1/2">
                    <label for="feeAdmin" class="block mb-2 text-sm font-medium text-gray-600 dark:text-gray-300">Potongan Admin</label>
                    <input type="number" id="feeAdmin" value="<?= $row['feeAdmin']; ?>" name="feeAdmin" placeholder="0" required class="w-full px-3 py-2 placeholder-gray-300 border border-gray-300 rounded-md focus:outline-none focus:ring-gray-500 focus:border-gray-500 dark:bg-gray-800 dark:border-gray-600 dark:focus:ring-gray-500 dark:focus:border-gray-500 dark:text-white">
                </div>
            </div>
            <div class="flex flex-row w-full gap-3">
                <div class="mb-4 w-1/2">
                    <label for="price" class="block mb-2 text-sm font-medium text-gray-600 dark:text-gray-300">Harga</label>
                    <input type="number" id="price" value="<?= $row['price']; ?>" name="price" placeholder="0" required class="w-full px-3 py-2 placeholder-gray-300 border border-gray-300 rounded-md focus:outline-none focus:ring-gray-500 focus:border-gray-500 dark:bg-gray-800 dark:border-gray-600 dark:focus:ring-gray-500 dark:focus:border-gray-500 dark:text-white">
                </div>
                <div class="mb-4 w-1/2">
                    <label for="totalPrice" class="block mb-2 text-sm font-medium text-gray-600 dark:text-gray-300">Total Harga</label>
                    <input type="number" id="totalPrice" value="<?= $row['totalPrice']; ?>" name="totalPrice" placeholder="0" required class="w-full px-3 py-2 placeholder-gray-300 border border-gray-300 rounded-md focus:outline-none focus:ring-gray-500 focus:border-gray-500 dark:bg-gray-800 dark:border-gray-600 dark:focus:ring-gray-500 dark:focus:border-gray-500 dark:text-white">
                </div>
            </div>
            <div class="flex flex-row w-full gap-3">
                <div class="mb-4 w-1/2">
                    <label for="packageName" class="block mb-2 text-sm font-medium text-gray-600 dark:text-gray-300">Harga</label>
                    <input type="text" id="packageName" value="<?= $row['packageName']; ?>" name="packageName" placeholder="nama paket" required class="w-full px-3 py-2 placeholder-gray-300 border border-gray-300 rounded-md focus:outline-none focus:ring-gray-500 focus:border-gray-500 dark:bg-gray-800 dark:border-gray-600 dark:focus:ring-gray-500 dark:focus:border-gray-500 dark:text-white">
                </div>
                <div class="mb-4 w-1/2">
                    <label for="methodPayment" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Metode Pembayaran</label>
                    <select id="methodPayment" name="methodPayment" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option disabled selected>Pilih Metode</option>
                        <?php while ($card = mysqli_fetch_assoc($queryCard)) { ?>
                            <option value="<?= htmlspecialchars($card['nameCard']); ?>" <?= ($card['nameCard'] == $row['methodPayment']) ? 'selected' : ''; ?> class="capitalize"><?= htmlspecialchars($card['nameCard']); ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="flex flex-row w-full gap-3">
                <div class="mb-4 w-1/2">
                    <label for="promoCode" class="block mb-2 text-sm font-medium text-gray-600 dark:text-gray-300">Kode Promo</label>
                    <input type="text" id="promoCode" value="<?= $row['promoCode']; ?>" name="promoCode" placeholder="kode promo" required class="w-full px-3 py-2 placeholder-gray-300 border border-gray-300 rounded-md focus:outline-none focus:ring-gray-500 focus:border-gray-500 dark:bg-gray-800 dark:border-gray-600 dark:focus:ring-gray-500 dark:focus:border-gray-500 dark:text-white">
                </div>
                <div class="mb-4 w-1/2">
                    <label for="expiredPayment" class="block mb-2 text-sm font-medium text-gray-600 dark:text-gray-300">Pembayaran Expired</label>
                    <input type="datetime-local" id="expiredPayment" value="<?= $row['expiredPayment']; ?>" name="expiredPayment" placeholder="0" required class="w-full px-3 py-2 placeholder-gray-300 border border-gray-300 rounded-md focus:outline-none focus:ring-gray-500 focus:border-gray-500 dark:bg-gray-800 dark:border-gray-600 dark:focus:ring-gray-500 dark:focus:border-gray-500 dark:text-white">
                </div>
            </div>
            <div class="flex flex-row w-full gap-3">
                <div class="mb-4 w-1/2">
                    <label for="successPayment" class="block mb-2 text-sm font-medium text-gray-600 dark:text-gray-300">Pembayaran Sukses</label>
                    <input type="datetime-local" id="successPayment" value="<?= $row['successPayment']; ?>" name="successPayment" placeholder="0" required class="w-full px-3 py-2 placeholder-gray-300 border border-gray-300 rounded-md focus:outline-none focus:ring-gray-500 focus:border-gray-500 dark:bg-gray-800 dark:border-gray-600 dark:focus:ring-gray-500 dark:focus:border-gray-500 dark:text-white">
                </div>
                <div class="mb-4 w-1/2">
                    <label for="room" class="block mb-2 text-sm font-medium text-gray-600 dark:text-gray-300">Ruang</label>
                    <input type="number" id="room" value="<?= $row['room']; ?>" name="room" placeholder="0" required class="w-full px-3 py-2 placeholder-gray-300 border border-gray-300 rounded-md focus:outline-none focus:ring-gray-500 focus:border-gray-500 dark:bg-gray-800 dark:border-gray-600 dark:focus:ring-gray-500 dark:focus:border-gray-500 dark:text-white">
                </div>
            </div>
            <div class="mt-2 flex justify-center w-full">
                <button type="submit" id="updateMovieBtn" class="bg-gray-600 hover:bg-gray-700 text-white rounded-md px-4 py-2 transition duration-200 focus:outline-none focus:ring-4 focus:ring-gray-300">Update</button>
            </div>
        </form>
    </div>
</div>