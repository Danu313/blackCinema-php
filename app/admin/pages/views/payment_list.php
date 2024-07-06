<?php
include "../../config/conn.php";

$query = mysqli_query($conn, "SELECT * FROM payment");
$queryCard = mysqli_query($conn, "SELECT * FROM payment_card");
?>

<section class="bg-gray-50 dark:bg-black p-3 sm:p-5">
    <div class="mx-auto max-w-screen-xl px-4 lg:px-12">
        <div class="bg-white dark:bg-white/10 relative shadow-md sm:rounded-lg overflow-hidden">
            <div class="flex flex-col md:flex-row items-center justify-between space-y-3 md:space-y-0 md:space-x-4 p-4">
                <div class="w-full md:w-1/2">
                    <form class="flex items-center">
                        <label for="simple-search" class="sr-only">Search</label>
                        <div class="relative w-full">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <input type="text" id="simple-search" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-gray-500 focus:border-gray-500 block w-full pl-10 p-2 dark:bg-black/20 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-gray-500 dark:focus:border-gray-500" placeholder="Search" required="">
                        </div>
                    </form>
                </div>
                <div class="w-full md:w-auto flex flex-col md:flex-row space-y-2 md:space-y-0 items-stretch md:items-center justify-end md:space-x-3 flex-shrink-0">
                    <button id="addBtn" type="button" class="flex items-center justify-center text-white bg-gray-700 hover:bg-gray-800 focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-gray-600 dark:hover:bg-gray-700 focus:outline-none dark:focus:ring-gray-800">
                        <svg class="h-3.5 w-3.5 mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                            <path clip-rule="evenodd" fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" />
                        </svg>
                        Tambah Kartu
                    </button>
                </div>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-black/20 uppercase bg-gray-50 dark:bg-black/20 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-4 py-3">Username</th>
                            <th scope="col" class="px-4 py-3">Email</th>
                            <th scope="col" class="px-4 py-3">Waktu Mulai</th>
                            <th scope="col" class="px-4 py-3">Waktu Selesai</th>
                            <th scope="col" class="px-4 py-3">Potongan Admin</th>
                            <th scope="col" class="px-4 py-3">Harga</th>
                            <th scope="col" class="px-4 py-3">Total Harga</th>
                            <th scope="col" class="px-4 py-3">Nama Paket</th>
                            <th scope="col" class="px-4 py-3">Metode Pembayaran</th>
                            <th scope="col" class="px-4 py-3">Kode Promo</th>
                            <th scope="col" class="px-4 py-3">Status</th>
                            <th scope="col" class="px-4 py-3">Pembayaran Expired</th>
                            <th scope="col" class="px-4 py-3">Pembayaran Sukses</th>
                            <th scope="col" class="px-4 py-3">Ruang</th>
                            <th scope="col" colspan="3" class="px-4 py-3">
                                <span class="sr-only">Aksi</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody id="paymentList">
                        <?php
                        while ($row = mysqli_fetch_assoc($query)) {
                        ?>
                            <tr class="border-b dark:border-black/20">
                                <th scope="row" class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    <?= $row['userName']; ?></th>
                                <td class="px-4 py-3"><span><?= $row['userEmail']; ?></span></td>
                                <td class="px-4 py-3"><span><?= $row['startTime']; ?></span></td>
                                <td class="px-4 py-3"><span><?= $row['endTime']; ?></span></td>
                                <td class="px-4 py-3"><span><?= $row['feeAdmin']; ?></span></td>
                                <td class="px-4 py-3"><span><?= $row['price']; ?></span></td>
                                <td class="px-4 py-3"><span><?= $row['totalPrice']; ?></span></td>
                                <td class="px-4 py-3"><span><?= $row['packageName']; ?></span></td>
                                <td class="px-4 py-3"><span><?= $row['methodPayment']; ?></span></td>
                                <td class="px-4 py-3"><span><?= $row['promoCode']; ?></span></td>
                                <td class="px-4 py-3"><span><?= $row['status']; ?></span></td>
                                <td class="px-4 py-3"><span><?= $row['expiredPayment']; ?></span></td>
                                <td class="px-4 py-3"><span><?= $row['successPayment']; ?></span></td>
                                <td class="px-4 py-3"><span><?= $row['room']; ?></span></td>
                                <td class="px-4 py-3">
                                <?php if($row['status'] != 'success') { ?>
                                    <button class="text-gray-600 hover:text-gray-800 duration-200" onclick="updateStatusPayment(<?= $row['id']; ?>)"><i class="fa-solid fa-circle-check"></i></button>
                                <?php }else{ ?>
                                    <button class="text-green-600 hover:text-green-800 duration-200"><i class="fa-solid fa-circle-check"></i></button>
                                <?php } ?>
                                </td>
                                <td class="px-4 py-3">
                                    <a href="edit_payment_list?id=<?= $row['id']; ?>" class="text-blue-600 hover:text-blue-800 duration-200">
                                        <i class="fa-solid fa-pen-to-square text-blue-500"></i>
                                    </a>
                                </td>
                                <td class="px-4 py-3">
                                    <button class="text-red-600 hover:text-red-800 duration-200" onclick="deletePaymentList(<?= $row['id']; ?>)"><i class="fa-solid fa-trash text-red-500"></i></button>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>

<div id="add-modal" tabindex="-1" aria-hidden="true" class="hidden fixed z-50 inset-0 flex items-center justify-center backdrop-blur-sm">
    <div class="rounded-lg shadow-lg p-6 overflow-y-auto max-w-md">
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <div class="flex items-center justify-between p-4 md:p-5 border-b dark:border-gray-600 border-gray-200">
                <h3 class="text-xl font-medium text-gray-700 dark:text-white">
                    Tambah Data Pembayaran
                </h3>
                <button id="closeAddModal" type="button" class="text-gray-400 dark:text-gray-300 focus:outline-none">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path clip-rule="evenodd" d="M19.071 4.929a1 1 0 010 1.414L5.757 19.071a1 1 0 01-1.414-1.414L17.657 4.93a1 1 0 011.414 0z" fill-rule="evenodd"></path>
                        <path clip-rule="evenodd" d="M4.929 4.929a1 1 0 00-1.414 1.414L18.243 19.07a1 1 0 001.414-1.413L4.929 4.93z" fill-rule="evenodd"></path>
                    </svg>
                </button>
            </div>
            <form id="addPaymentListForm" class="p-4 md:p-5" action="pages/controller/payments/payment_list/add_payment_list.php" method="POST">
                <input type="hidden" id="paymentId" name="paymentId" value="">
                <div class="flex flex-row w-full gap-3">
                    <div class="mb-4 w-1/2">
                        <label for="startTime" class="block mb-2 text-sm font-medium text-gray-600 dark:text-gray-300">Waktu Mulai</label>
                        <input type="datetime-local" id="startTime" name="startTime" placeholder="nama paket" required class="w-full px-3 py-2 placeholder-gray-300 border border-gray-300 rounded-md focus:outline-none focus:ring-gray-500 focus:border-gray-500 dark:bg-gray-800 dark:border-gray-600 dark:focus:ring-gray-500 dark:focus:border-gray-500 dark:text-white">
                    </div>
                    <div class="mb-4 w-1/2">
                        <label for="endTime" class="block mb-2 text-sm font-medium text-gray-600 dark:text-gray-300">Waktu Selesai</label>
                        <input type="datetime-local" id="endTime" name="endTime" placeholder="0" required class="w-full px-3 py-2 placeholder-gray-300 border border-gray-300 rounded-md focus:outline-none focus:ring-gray-500 focus:border-gray-500 dark:bg-gray-800 dark:border-gray-600 dark:focus:ring-gray-500 dark:focus:border-gray-500 dark:text-white">
                    </div>
                </div>
                <div class="flex flex-row w-full gap-3">
                    <div class="mb-4 w-1/2">
                        <label for="status" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Status</label>
                        <select id="status" name="status" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option selected>Pilih Status</option>
                            <option value="pending">Pending</option>
                            <option value="success">Sukses</option>
                            <option value="canceled">Cancel</option>
                        </select>
                    </div>
                    <div class="mb-4 w-1/2">
                        <label for="feeAdmin" class="block mb-2 text-sm font-medium text-gray-600 dark:text-gray-300">Potongan Admin</label>
                        <input type="number" id="feeAdmin" name="feeAdmin" placeholder="0" required class="w-full px-3 py-2 placeholder-gray-300 border border-gray-300 rounded-md focus:outline-none focus:ring-gray-500 focus:border-gray-500 dark:bg-gray-800 dark:border-gray-600 dark:focus:ring-gray-500 dark:focus:border-gray-500 dark:text-white">
                    </div>
                </div>
                <div class="flex flex-row w-full gap-3">
                    <div class="mb-4 w-1/2">
                        <label for="price" class="block mb-2 text-sm font-medium text-gray-600 dark:text-gray-300">Harga</label>
                        <input type="number" id="price" name="price" placeholder="0" required class="w-full px-3 py-2 placeholder-gray-300 border border-gray-300 rounded-md focus:outline-none focus:ring-gray-500 focus:border-gray-500 dark:bg-gray-800 dark:border-gray-600 dark:focus:ring-gray-500 dark:focus:border-gray-500 dark:text-white">
                    </div>
                    <div class="mb-4 w-1/2">
                        <label for="totalPrice" class="block mb-2 text-sm font-medium text-gray-600 dark:text-gray-300">Total Harga</label>
                        <input type="number" id="totalPrice" name="totalPrice" placeholder="0" required class="w-full px-3 py-2 placeholder-gray-300 border border-gray-300 rounded-md focus:outline-none focus:ring-gray-500 focus:border-gray-500 dark:bg-gray-800 dark:border-gray-600 dark:focus:ring-gray-500 dark:focus:border-gray-500 dark:text-white">
                    </div>
                </div>
                <div class="flex flex-row w-full gap-3">
                    <div class="mb-4 w-1/2">
                        <label for="packageName" class="block mb-2 text-sm font-medium text-gray-600 dark:text-gray-300">Harga</label>
                        <input type="text" id="packageName" name="packageName" placeholder="nama paket" required class="w-full px-3 py-2 placeholder-gray-300 border border-gray-300 rounded-md focus:outline-none focus:ring-gray-500 focus:border-gray-500 dark:bg-gray-800 dark:border-gray-600 dark:focus:ring-gray-500 dark:focus:border-gray-500 dark:text-white">
                    </div>
                    <div class="mb-4 w-1/2">
                        <label for="methodPayment" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Status</label>
                        <select id="methodPayment" name="methodPayment" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option selected>Pilih Metode</option>
                            <?php while ($row = mysqli_fetch_assoc($queryCard)) { ?>
                                <option value="<?= $row['nameCard']; ?>" class="capitalize"><?= $row['nameCard']; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="flex flex-row w-full gap-3">
                    <div class="mb-4 w-1/2">
                        <label for="promoCode" class="block mb-2 text-sm font-medium text-gray-600 dark:text-gray-300">Kode Promo</label>
                        <input type="text" id="promoCode" name="promoCode" placeholder="kode promo" required class="w-full px-3 py-2 placeholder-gray-300 border border-gray-300 rounded-md focus:outline-none focus:ring-gray-500 focus:border-gray-500 dark:bg-gray-800 dark:border-gray-600 dark:focus:ring-gray-500 dark:focus:border-gray-500 dark:text-white">
                    </div>
                    <div class="mb-4 w-1/2">
                        <label for="expiredPayment" class="block mb-2 text-sm font-medium text-gray-600 dark:text-gray-300">Pembayaran Expired</label>
                        <input type="datetime-local" id="expiredPayment" name="expiredPayment" placeholder="0" required class="w-full px-3 py-2 placeholder-gray-300 border border-gray-300 rounded-md focus:outline-none focus:ring-gray-500 focus:border-gray-500 dark:bg-gray-800 dark:border-gray-600 dark:focus:ring-gray-500 dark:focus:border-gray-500 dark:text-white">
                    </div>
                </div>
                <div class="flex flex-row w-full gap-3">
                    <div class="mb-4 w-1/2">
                        <label for="successPayment" class="block mb-2 text-sm font-medium text-gray-600 dark:text-gray-300">Pembayaran Sukses</label>
                        <input type="datetime-local" id="successPayment" name="successPayment" placeholder="0" required class="w-full px-3 py-2 placeholder-gray-300 border border-gray-300 rounded-md focus:outline-none focus:ring-gray-500 focus:border-gray-500 dark:bg-gray-800 dark:border-gray-600 dark:focus:ring-gray-500 dark:focus:border-gray-500 dark:text-white">
                    </div>
                    <div class="mb-4 w-1/2">
                        <label for="room" class="block mb-2 text-sm font-medium text-gray-600 dark:text-gray-300">Ruang</label>
                        <input type="number" id="room" name="room" placeholder="0" required class="w-full px-3 py-2 placeholder-gray-300 border border-gray-300 rounded-md focus:outline-none focus:ring-gray-500 focus:border-gray-500 dark:bg-gray-800 dark:border-gray-600 dark:focus:ring-gray-500 dark:focus:border-gray-500 dark:text-white">
                    </div>
                </div>
                <div class="mt-2 flex justify-center w-full">
                    <button type="submit" id="savePaymentListBtn" class="bg-gray-600 hover:bg-gray-700 text-white rounded-md px-4 py-2 transition duration-200 focus:outline-none focus:ring-4 focus:ring-gray-300">Tambah</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const addModal = document.getElementById('add-modal');
        const closeAddModalBtn = document.getElementById('closeAddModal');
        const addPaymentListForm = document.getElementById('addPaymentListForm');

        document.getElementById('addBtn').addEventListener('click', function() {
            addModal.classList.remove('hidden');
            document.body.classList.add('overflow-hidden');
        });

        closeAddModalBtn.addEventListener('click', function() {
            addModal.classList.add('hidden');
            document.body.classList.remove('overflow-hidden');
        });

        addPaymentListForm.addEventListener('submit', function(event) {
            event.preventDefault();

            const formData = new FormData(addPaymentListForm);

            fetch('pages/controller/payments/payment_list/add_payment_list.php', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: 'PaymentList added successfully!',
                        }).then(() => {
                            location.reload();
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Failed to add payment. Please try again.',
                        });
                    }
                })
                .catch(error => {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: 'PaymentList added successfully!',
                    }).then(() => {
                        location.reload();
                    });
                });
        });
    });
</script>

<script>
    function deletePaymentList(paymentListId) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Delete'
        }).then((result) => {
            if (result.isConfirmed) {
                fetch(`pages/controller/payments/payment_list/delete_payment_list.php?id=${paymentListId}`, {
                        method: 'DELETE'
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            Swal.fire(
                                'Deleted!',
                                'The payment has been deleted.',
                                'success'
                            ).then(() => {
                                location.reload();
                            });
                        } else {
                            Swal.fire(
                                'Error!',
                                'Failed to delete the payment.',
                                'error'
                            );
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        Swal.fire(
                            'Error!',
                            'Failed to delete the payment.',
                            'error'
                        );
                    });
            }
        });
    }
</script>

<script>
    function updateStatusPayment(paymentListId) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes'
        }).then((result) => {
            if (result.isConfirmed) {
                fetch(`pages/controller/payments/payment_list/update_status.php?id=${paymentListId}`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({ id: paymentListId })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        fetch(`pages/email/resend_payment.php?id=${paymentListId}`, {
                            method: 'GET'
                        })
                        .then(response => response.json())
                        .then(emailData => {
                            if (emailData.success) {
                                Swal.fire(
                                    'Updated!',
                                    'The payment has been set to success and email sent.',
                                    'success'
                                ).then(() => {
                                    location.reload();
                                });
                            } else {
                                Swal.fire(
                                    'Error!',
                                    'Failed to send email notification.',
                                    'error'
                                );
                            }
                        })
                        .catch(error => {
                            console.error('Error sending email:', error);
                            Swal.fire(
                                'Error!',
                                'Failed to send email notification.',
                                'error'
                            );
                        });
                    } else {
                        Swal.fire(
                            'Error!',
                            'Failed to update the payment status.',
                            'error'
                        );
                    }
                })
                .catch(error => {
                    console.error('Error updating payment status:', error);
                    Swal.fire(
                        'Error!',
                        'Failed to update the payment status.',
                        'error'
                    );
                });
            }
        });
    }
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const addModal = document.getElementById('add-modal');
        const closeAddModalBtn = document.getElementById('closeAddModal');
        const editModal = document.getElementById('edit-modal');
        const closeEditModalBtn = document.getElementById('closeEditModal');
        const addBtn = document.getElementById('addBtn');
        const editPaymentListBtns = document.querySelectorAll('.editPaymentListBtn');
        const paymentForm = document.getElementById('paymentForm');
        const paymentList = document.getElementById('paymentList');

        addBtn.addEventListener('click', function() {
            addModal.classList.remove('hidden');
            document.body.classList.add('overflow-hidden');
        });

        closeAddModalBtn.addEventListener('click', function() {
            addModal.classList.add('hidden');
            document.body.classList.remove('overflow-hidden');
        });

        editPaymentListBtns.forEach(function(btn) {
            btn.addEventListener('click', function(e) {
                e.preventDefault();
                const paymentListId = btn.getAttribute('data-id');
                editModal.classList.remove('hidden');
                document.body.classList.add('overflow-hidden');
            });
        });

        closeEditModalBtn.addEventListener('click', function() {
            editModal.classList.add('hidden');
            document.body.classList.remove('overflow-hidden');
        });
    });
</script>