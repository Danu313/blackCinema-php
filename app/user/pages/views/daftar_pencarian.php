<?php
include("../../config/conn.php");

$query = '';
$filter = '';
$hasil = [];

if (isset($_GET['query'])) {
    $query = mysqli_real_escape_string($conn, $_GET['query']);
    $sql = "SELECT * FROM movie WHERE title LIKE '%$query%' OR category LIKE '%$query%'";

    // Menambahkan filter tambahan
    if (isset($_GET['filter'])) {
        $filter = $_GET['filter'];
        switch ($filter) {
            case 'newest':
                $sql .= " ORDER BY release_date DESC";
                break;
            case 'oldest':
                $sql .= " ORDER BY release_date ASC";
                break;
            case 'a-z':
                $sql .= " ORDER BY title ASC";
                break;
            case 'z-a':
                $sql .= " ORDER BY title DESC";
                break;
        }
    }

    $result = mysqli_query($conn, $sql);

    if ($result) {
        $hasil = mysqli_fetch_all($result, MYSQLI_ASSOC);
    } else {
        echo "Error: " . mysqli_error($conn);
        exit;
    }
}
?>

<div class="relative pt-[100px] max-w-screen">
    <h1 class="text-2xl font-bold mb-4 ml-8">Menampilkan Hasil Pencarian <?= isset($_GET['query']) ? htmlspecialchars($_GET['query']) : ''; ?></h1>
    <div class="ml-8 flex flex-row">
        <form method="GET" action="" class="flex items-center">
            <div class="basis-1/2">
                <input type="search" id="default-search" name="query" class="text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-5 p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500" placeholder="Cari film..." value="<?= isset($_GET['query']) ? htmlspecialchars($_GET['query'], ENT_QUOTES) : ''; ?>" required>
            </div>
            <div class="basis-1/4 text-sm text-white ml-4">
                <select name="filter" class="p-2.5 bg-gray-700 border-gray-600 rounded-lg focus:ring-blue-500 focus:border-blue-500 block">
                    <option value="" class="bg-gray-700">--Select Filter--</option>
                    <option value="newest" class="bg-gray-700" <?= ($filter == 'newest') ? 'selected' : ''; ?>>Tahun Terbaru</option>
                    <option value="oldest" class="bg-gray-700" <?= ($filter == 'oldest') ? 'selected' : ''; ?>>Tahun Terlama</option>
                    <option value="a-z" class="bg-gray-700" <?= ($filter == 'a-z') ? 'selected' : ''; ?>>A-Z</option>
                    <option value="z-a" class="bg-gray-700" <?= ($filter == 'z-a') ? 'selected' : ''; ?>>Z-A</option>
                </select>
            </div>
            <div class="basis-1/4 ml-4 text-sm text-white">
                <button type="submit" class="p-2.5 bg-gray-700 hover:bg-gray-800 rounded-lg">Apply Filter</button>
            </div>
        </form>
    </div>
</div>

<div class="flex flex-wrap bg-black ml-8 mt-8">
    <?php
    if (!empty($hasil)) {
        foreach ($hasil as $data) {
            // Menghapus tanda kurung siku dan tanda kutip dari genres
            $genres = str_replace(['[', ']', '"'], '', $data['genres']);
    ?>
            <a href="movie_details?id=<?= $data['id'] ?>" class="flex justify-center items-center mx-auto flex-row w-full sm:w-1/2 lg:w-1/3 max-w-lg overflow-hidden m-5 hover:scale-105  transition duration-200 ease-in-out">

                <img class="w-1/3 rounded-lg object-cover" src="<?= htmlspecialchars($data['poster_path']) ?>" alt="<?= htmlspecialchars($data['title']) ?>">
                <div class="w-2/3 pt-0 pr-6 pb-6 pl-6">
                    <h2 class="text-xl font-bold text-white"><?= htmlspecialchars($data['title']) ?></h2>
                    <p class="text-sm text-gray-400">Genre: <?= htmlspecialchars($genres) ?></p>
                    <p class="text-sm text-gray-400">Tahun Terbit: <?= htmlspecialchars($data['release_date']) ?></p>
                    <p class="text-sm text-gray-400">Durasi: <?= htmlspecialchars($data['movieDuration']) ?> menit</p>
                    <p class="text-sm text-gray-400">Rating: <?= htmlspecialchars($data['vote_average']) ?></p>
                </div>
            </a>
    <?php
        }
    } else {
        echo "<p class='text-white'>No results found for '" . (isset($_GET['query']) ? htmlspecialchars($_GET['query']) : '') . "'</p>";
    }
    ?>
    </div>