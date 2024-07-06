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

mysqli_close($conn);
?>


<div class="w-full h-auto">
    <div class="flex px-10 items-center justify-center self-center">
        <form id="editMovieForm" class="p-4 md:p-5" action="pages/controller/movies/edit_movie.php" method="POST">
            <input type="hidden" id="movieId" name="movieId" value="<?= $row['id']; ?>">
            <div class="flex flex-row w-full gap-3">
                <div class="mb-4 w-1/2">
                    <label for="title" class="block mb-2 text-sm font-medium text-gray-600 dark:text-gray-300">Title</label>
                    <input type="text" id="title" name="title" placeholder="Title" value="<?= $row['title']; ?>" required class="w-full px-3 py-2 placeholder-gray-300 border border-gray-300 rounded-md focus:outline-none focus:ring-gray-500 focus:border-gray-500 dark:bg-gray-800 dark:border-gray-600 dark:focus:ring-gray-500 dark:focus:border-gray-500 dark:text-white">
                </div>
                <div class="mb-4 w-1/2">
                    <label for="overview" class="block mb-2 text-sm font-medium text-gray-600 dark:text-gray-300">Deskripsi</label>
                    <textarea id="overview" name="overview" placeholder="Deskripsi" rows="3" class="w-full px-3 py-2 placeholder-gray-300 border border-gray-300 rounded-md focus:outline-none focus:ring-gray-500 focus:border-gray-500 dark:bg-gray-800 dark:border-gray-600 dark:focus:ring-gray-500 dark:focus:border-gray-500 dark:text-white"><?= $row['overview']; ?></textarea>
                </div>
            </div>
            <div class="flex flex-row w-full gap-3">
                <div class="mb-4 w-1/2">
                    <label for="posterPath" class="block mb-2 text-sm font-medium text-gray-600 dark:text-gray-300">Poster</label>
                    <input type="text" id="posterPath" name="posterPath" value="<?= $row['poster_path']; ?>" placeholder="Poster Path" class="w-full px-3 py-2 placeholder-gray-300 border border-gray-300 rounded-md focus:outline-none focus:ring-gray-500 focus:border-gray-500 dark:bg-gray-800 dark:border-gray-600 dark:focus:ring-gray-500 dark:focus:border-gray-500 dark:text-white">
                </div>
                <div class="mb-4 w-1/2">
                    <label for="backdropPath" class="block mb-2 text-sm font-medium text-gray-600 dark:text-gray-300">Backdrop Path</label>
                    <input type="text" id="backdropPath" name="backdropPath" value="<?= $row['backdrop_path']; ?>" placeholder="Backdrop Path" class="w-full px-3 py-2 placeholder-gray-300 border border-gray-300 rounded-md focus:outline-none focus:ring-gray-500 focus:border-gray-500 dark:bg-gray-800 dark:border-gray-600 dark:focus:ring-gray-500 dark:focus:border-gray-500 dark:text-white">
                </div>
            </div>
            <div class="flex flex-row w-full gap-3">
                <div class="mb-4 w-1/2">
                    <label for="genres" class="block mb-2 text-sm font-medium text-gray-600 dark:text-gray-300">Genre</label>
                    <input type="text" id="genres" name="genres" value="<?= implode(', ', $genres); ?>" placeholder="Genre" class="w-full px-3 py-2 placeholder-gray-300 border border-gray-300 rounded-md focus:outline-none focus:ring-gray-500 focus:border-gray-500 dark:bg-gray-800 dark:border-gray-600 dark:focus:ring-gray-500 dark:focus:border-gray-500 dark:text-white">
                </div>
                <div class="mb-4 w-1/2">
                    <label for="category" class="block mb-2 text-sm font-medium text-gray-600 dark:text-gray-300">Category</label>
                    <input type="text" id="category" name="category" value="<?= implode(', ', $category); ?>" placeholder="Category" class="w-full px-3 py-2 placeholder-gray-300 border border-gray-300 rounded-md focus:outline-none focus:ring-gray-500 focus:border-gray-500 dark:bg-gray-800 dark:border-gray-600 dark:focus:ring-gray-500 dark:focus:border-gray-500 dark:text-white">
                </div>
            </div>
            <div class="flex flex-row w-full gap-3">
                <div class="mb-4 w-1/2">
                    <label for="releaseDate" class="block mb-2 text-sm font-medium text-gray-600 dark:text-gray-300">Tanggal Rilis</label>
                    <input type="text" id="releaseDate" name="releaseDate" value="<?= $row['release_date']; ?>" placeholder="YYYY-MM-DD" class="w-full px-3 py-2 placeholder-gray-300 border border-gray-300 rounded-md focus:outline-none focus:ring-gray-500 focus:border-gray-500 dark:bg-gray-800 dark:border-gray-600 dark:focus:ring-gray-500 dark:focus:border-gray-500 dark:text-white">
                </div>
                <div class="mb-4 w-1/2">
                    <label for="trailer" class="block mb-2 text-sm font-medium text-gray-600 dark:text-gray-300">Trailer Link</label>
                    <input type="text" id="trailer" name="trailer" value="<?= $row['trailer']; ?>" placeholder="Trailer Link" class="w-full px-3 py-2 placeholder-gray-300 border border-gray-300 rounded-md focus:outline-none focus:ring-gray-500 focus:border-gray-500 dark:bg-gray-800 dark:border-gray-600 dark:focus:ring-gray-500 dark:focus:border-gray-500 dark:text-white">
                </div>
            </div>
            <div class="flex flex-row w-full gap-3">
                <div class="mb-4 w-1/2">
                    <label for="movieDuration" class="block mb-2 text-sm font-medium text-gray-600 dark:text-gray-300">Durasi Film</label>
                    <input type="text" id="movieDuration" name="movieDuration" value="<?= $row['movieDuration']; ?>" placeholder="Durasi Film" class="w-full px-3 py-2 placeholder-gray-300 border border-gray-300 rounded-md focus:outline-none focus:ring-gray-500 focus:border-gray-500 dark:bg-gray-800 dark:border-gray-600 dark:focus:ring-gray-500 dark:focus:border-gray-500 dark:text-white">
                </div>
                <div class="mb-4 w-1/2">
                    <label for="voteAverage" class="block mb-2 text-sm font-medium text-gray-600 dark:text-gray-300">Jumlah Voting</label>
                    <input type="text" id="voteAverage" name="voteAverage" value="<?= $row['vote_average']; ?>" placeholder="Jumlah Voting" class="w-full px-3 py-2 placeholder-gray-300 border border-gray-300 rounded-md focus:outline-none focus:ring-gray-500 focus:border-gray-500 dark:bg-gray-800 dark:border-gray-600 dark:focus:ring-gray-500 dark:focus:border-gray-500 dark:text-white">
                </div>
            </div>
            <div class="mt-2 flex justify-center w-full">
                <button type="submit" id="updateMovieBtn" class="bg-gray-600 hover:bg-gray-700 text-white rounded-md px-4 py-2 transition duration-200 focus:outline-none focus:ring-4 focus:ring-gray-300">Update</button>
            </div>
        </form>
    </div>
</div>