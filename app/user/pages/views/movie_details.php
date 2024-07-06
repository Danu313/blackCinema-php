<?php
include "../../config/conn.php";

$movieId = $_GET['id'] ?? null;

$query = mysqli_query($conn, "SELECT * FROM movie WHERE id='$movieId'");
$row = mysqli_fetch_assoc($query);

if (!$row) {
    exit('Movie not found.');
}

$genres = json_decode($row['genres'], true);
$category = json_decode($row['category'], true);
$trailer = json_decode($row['trailer'], true);

$topMoviesQuery = mysqli_query($conn, "SELECT * FROM movie WHERE category LIKE '%top movies%' LIMIT 5");

// Query to check pending payments
$queryPayment = mysqli_query($conn, "SELECT * FROM payment WHERE status = 'pending' AND userId = '{$_SESSION['user_id']}' AND expiredPayment > NOW()");

// Check if there are pending payments
$pendingPaymentExists = mysqli_num_rows($queryPayment) > 0;

mysqli_close($conn);
?>

<div class="w-screen min-h-screen bg-cover bg-no-repeat bg-fixed" style="background-image: url('<?= isset($row['backdrop_path']) ? $row['backdrop_path'] : ''; ?>'); background-attachment: fixed">
    <div class="w-full bg-cover bg-black/50">
        <div class="flex flex-col w-full justify-center items-center pt-[100px]">
            <div class="flex flex-row w-full h-auto items-center justify-center">
                <div class="w-1/3">
                    <img src="<?= $row['poster_path']; ?>" class="h-[80vh] mx-auto mt-8 mb-8 rounded-lg">
                </div>
                <div class="relative w-1/3 flex justify-center mt-8">
                    <div class="max-w-5xl text-white p-8 rounded-lg">
                        <h1 class="text-5xl font-bold mb-4"><?= $row['title']; ?></h1>
                        <p class="text-lg text-gray-300"><?= $row['overview']; ?></p>
                        <div class="flex flex-col mt-4">
                            <p class="text-lg text-gray-250"><span class="font-semibold">Genre:</span> <?= implode(', ', $genres); ?></p>
                            <p class="text-lg text-gray-250"><span class="font-semibold">Category:</span> <?= implode(', ', $category); ?></p>
                            <p class="text-lg text-gray-250"><span class="font-semibold">Release Date:</span> <?= $row['release_date']; ?></p>
                            <p class="text-lg text-gray-250"><span class="font-semibold">Duration:</span> <?= $row['movieDuration']; ?></p>
                            <p class="text-lg text-gray-250"><span class="font-semibold">Voting Average:</span> <?= $row['vote_average']; ?></p>
                        </div>
                        <div class="flex flex-row mt-4 mx-auto justify-center lg:gap-6">
                            <?php if ($pendingPaymentExists) : ?>
                                <button class="mt-4 block px-8 py-5 rounded-3xl bg-amber-500 cursor-not-allowed opacity-50" disabled>Order Tickets</button>
                            <?php else : ?>
                                <a href="movie_order?id=<?= $row['id']; ?>" class="mt-4 block px-8 py-5 rounded-3xl bg-amber-500 hover:bg-amber-400 text-white">Order Tickets</a>
                            <?php endif; ?>
                            <a href="<?= $row['trailer']; ?>" class="mt-4 block px-8 py-5 rounded-3xl bg-red-600 hover:bg-red-500 text-white">Watch Trailer</a>
                        </div>
                    </div>
                </div>
            </div>
            <?php if ($pendingPaymentExists) : ?>
                <div class="px-4 py-2 bg-red-500 text-white mt-4 rounded-md">
                    <p>Anda memiliki pembayaran yang tertunda. Silakan selesaikan pembayaran sebelum melanjutkan.</p>
                </div>
            <?php endif; ?>
            <div class="px-4 py-8 bg-transparent">
                <h2 class="text-3xl font-bold text-white mb-4">Rekomendasi Untukmu</h2>
                <div class="flex p-4">
                    <?php while ($topMovie = mysqli_fetch_assoc($topMoviesQuery)) : ?>
                        <a class="flex lg:flex-row md:flex-row max-w-lg rounded-2xl overflow-hidden m-4 hover:scale-105 transition duration-200 ease-in-out" href="movie_details?id=<?= $topMovie['id'] ?>">
                            <img class="w-full md:w-60 object-cover" src="<?= $topMovie['poster_path'] ?>" alt="<?= $topMovie['title'] ?>">
                        </a>
                    <?php endwhile; ?>
                </div>
            </div>
        </div>
    </div>
</div>
