<?php
include "../../config/conn.php";

$movieId = $_GET['id'] ?? null;
$queryMovie = mysqli_query($conn, "SELECT * FROM movie WHERE id='$movieId'");
$rowMovie = mysqli_fetch_assoc($queryMovie);
$query = mysqli_query($conn, "SELECT * FROM payment_plan");
?>

<div class="w-screen min-h-screen bg-cover bg-no-repeat bg-fixed" style="background: url('<?php echo isset($rowMovie['backdrop_path']) ? $rowMovie['backdrop_path'] : ''; ?>'); background-attachment: fixed">
    <div class="w-full bg-cover bg-black/50">
        <div class="flex flex-col w-full justify-center items-center pt-[100px]">
            <h1 class='flex justify-center text-xl font-bold mb-5 mt-5 md:mt-0'>Pilih Jenis Paket</h1>
            <div class="block md:flex md:flex-row gap-5">
                <?php
                while ($row = mysqli_fetch_assoc($query)) {
                    $paymentPlanId = $row['id'];
                    $queryPaymentPlan = mysqli_query($conn, "SELECT * FROM payment_plan WHERE id='$paymentPlanId'");
                    $queryPaymentCard = mysqli_query($conn, "SELECT * FROM payment_card");
                    $queryPaymentPromo = mysqli_query($conn, "SELECT * FROM payment_promo");
    
                    $rowMovie = mysqli_fetch_assoc($queryMovie);
                    $rowPaymentPlan = mysqli_fetch_assoc($queryPaymentPlan);
                    $feeAdmin = 5000;
                    $price = $rowPaymentPlan['price'];
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
                ?>
                    <form method="post" action="pages/controller/payments/add_payment.php" class="relative flex flex-col mb-5 md:mb-0 bg-clip-border rounded-xl bg-gradient-to-tr from-gray-900 to-gray-800 text-white shadow-gray-900/20 shadow-md w-full max-w-[20rem] p-8">
                        <div class="relative pb-8 m-0 mb-8 overflow-hidden text-center text-gray-700 bg-transparent border-b rounded-none shadow-none bg-clip-border border-white/10">
                            <p class="block font-sans text-sm antialiased font-normal leading-normal text-white uppercase">
                                <?= $row['packageName']; ?>
                            </p>
                            <h1 class="flex justify-center gap-1 mt-6 font-sans antialiased font-normal tracking-normal text-white text-7xl">
                                <span class="mt-2 text-4xl">Rp <?= $row['price']; ?></span>
                            </h1>
                        </div>
                        <div class="p-0">
                            <ul class="flex flex-col gap-4">
                                <li class="flex items-center gap-4">
                                    <p class="block font-sans text-base antialiased font-normal leading-relaxed text-inherit">
                                        Kapasitas : <?= $row['screenResolution']; ?> orang </p>
                                </li>
                                <li class="flex items-center gap-4">
                                    <p class="block font-sans text-base antialiased font-normal leading-relaxed text-inherit">
                                        Ukuran Layar : <?= $row['screenResolution']; ?> inch
                                    </p>
                                </li>
                            </ul>
                        </div>
                        <div class="p-0 mt-12">
                            <input type="hidden" name="movieId" value="<?= $movieId; ?>">
                            <input type="hidden" name="price" value="<?= $rowPaymentPlan['price']; ?>">
                            <input type="hidden" name="packageName" value="<?= $rowPaymentPlan['packageName']; ?>">
                            <div class="flex flex-col items-center justify-center w-full gap-2">
                                <h1>Pilih waktu nonton</h1>
                                <input type="datetime-local" name="startTime" class="px-5 py-2 bg-white text-black border border-gray-600 rounded-lg" required>
                                <button type="submit" class="align-middle text-black select-none font-sans font-bold text-center uppercase transition-all disabled:opacity-50 disabled:shadow-none disabled:pointer-events-none text-sm py-3.5 px-7 rounded-lg bg-white text-blue-gray-900 shadow-md shadow-blue-gray-500/10 hover:shadow-lg hover:shadow-blue-gray-500/20 focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] active:shadow-none block w-full hover:scale-[1.02] focus:scale-[1.02] active:scale-100" type="button">
                                    Order Now
                                </button>
                            </div>
                        </div>
                    </form>
                <?php } ?>
            </div>
        </div>
    </div>
</body>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const addPaymentForm = document.getElementById('addPaymentForm');

        addPaymentForm.addEventListener('submit', function(event) {
            event.preventDefault();
            const formData = new FormData(addPaymentForm);

            fetch('pages/controller/payments/add_payment.php', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: 'Payment added successfully!'
                        }).then(() => {
                            location.reload();
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Failed to add payment. Please try again.'
                        });
                    }
                })
                .catch(error => {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Failed to add payment. Please try again.'
                    });
                });
        });
    });

    const checkBookingCount = () => {
        fetch('pages/controller/payments/check_booking_count.php')
            .then(response => response.json())
            .then(data => {
                if (data.count > 6) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Alert',
                        text: 'More than 6 bookings have passed their endTime.'
                    });
                }
            })
            .catch(error => {
                console.error('Error checking booking count:', error);
            });
    };

    checkBookingCount();
</script>

<?php
mysqli_close($conn);
?>