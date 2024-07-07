<?php
ob_start(); // Mulai output buffering

include "../../config/conn.php";

$query = '';

if (isset($_GET['query'])) {
    $query = mysqli_real_escape_string($conn, $_GET['query']);
    $sql = "SELECT * FROM movie WHERE title LIKE '%$query%' OR category LIKE '%$query%'";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        $hasil = mysqli_fetch_all($result, MYSQLI_ASSOC);
    } else {
        echo "Error: " . mysqli_error($conn); // Handle query error gracefully
        exit;
    }

    // Redirect to daftar_pencarian.php with results
    header("Location: daftar_pencarian?query=" . urlencode($query));
    exit();
}

ob_end_flush(); // Akhiri dan kirim output ke browser
?>

<head>
    <style>
        .swiper-container {
            width: 100%;
            height: 100%;
        }

        .swiper-slide {
            text-align: center;
            display: flex;
            justify-content: center;
            align-items: center;
            box-shadow: 0 4px 8px rgba(1, 0, 1, 0.1);
            border-radius: 20px;
        }

        .swiper-slide img {
            max-width: 60%;
            max-height: 40%;
            border-radius: 20px;
        }
    </style>
</head>

<div class="h-screen w-full relative">
    <div class="relative w-screen h-screen">
        <img src="https://res.cloudinary.com/dutlw7bko/image/upload/v1717413141/Cinema/background_homes_wisn4x.jpg" alt="bg" class='w-full h-full object-cover object-center absolute z-0' loading='lazy' />
        <div class="bg-gradient-to-t from-black to-transparent z-10 absolute w-[100vw] h-[30vh] bottom-0 left-0"></div>
        <div class="flex items-center justify-center flex-col w-full h-full gap-4 text-center z-20">
            <div class="flex flex-col gap-2">
                <h2 class="text-4xl font-bold z-20">Nonton film mudah dan nyaman di Jogja</h2>
                <h6 class="text-xl font-semibold z-20">Siap nonton? Telusuri film sekarang!</h6>
            </div>
            <div class="flex flex-col w-[350px] relative">
                <form action="daftar_pencarian" method="GET" class="relative h-fit">
                    <input type="search" id="default-search" name="query" class="text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-5 p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500" placeholder="Cari film..." required>
                    <button type="submit" class="absolute right-2 top-0.5 focus:ring-2 focus:outline-none rounded-lg text-sm px-4 py-2 focus:ring-blue-800"><i class="fa-solid fa-magnifying-glass"></i></button>
                </form>
            </div>
        </div>
    </div>

    <div class="w-full h-auto p-10 lg:p-20">
        <div class="flex flex-row w-full gap-5">
            <?php

            include "C:\laragon\www\black-cinema-php\app\admin\pages\controller\advertisement\advertisement_controller.php";
            $advertisements = getAllAdvertisements();

            // Check if advertisements are available and loop through them
            if (is_array($advertisements) && !empty($advertisements)) {
                foreach ($advertisements as $advertisement) {
                    echo '<a href="#" class="group w-1/2 relative flex h-64 items-end overflow-hidden rounded-lg bg-gray-100 shadow-lg md:h-80">';
                    echo '<img src="' . $advertisement['links'] . '" loading="lazy" alt="" class="absolute inset-0 h-full w-full object-cover object-center transition duration-200 group-hover:scale-110" />';
                    echo '<div class="pointer-events-none absolute inset-0 bg-gradient-to-t from-gray-800 via-transparent to-transparent opacity-50"></div>';
                    echo '<span class="relative ml-4 mb-3 inline-block text-sm text-white md:ml-5 md:text-lg">Iklan</span>';
                    echo '</a>';
                }
            } else {
                // Handle case where no advertisements are found
                echo '<p class="text-gray-500">Iklan tidak ditemukan.</p>';
            }
            ?>
        </div>
    </div>



    <div class='overflow-x-hidden overflow-y-hidden scrollbar-none relative flex flex-nowrap items-center'>
        <?php
        $sql = mysqli_query($conn, "SELECT * FROM movie");
        $hasil = mysqli_fetch_all($sql, MYSQLI_ASSOC);
        foreach ($hasil as $data) {
        ?>
            <div class="flex items-end h-full mr-3">
                <span class="overflow-hidden text-end flex items-end h-full leading-none text-[180px] tracking-[-15px] font-bold text-[#222c38]">
                     
                </span>
                <div class='w-[190px] overflow-hidden' style="margin-inline-end: 12px;">
                    <div class="relative flex overflow-hidden">
                        <div class='w-[100%] max-h-none scale-95 hover:scale-100 duration-300'>
                            <div class='w-full' style="max-height: 'none'; user-select: 'none'; pointer-events: 'none';">
                                <a href="movie_details?id=<?= $data['id'] ?>" class='z-30 w-[190px] h-full'>
                                    <img src="<?= $data['poster_path'] ?>" alt="poster" class="inline-block w-full h-full object-cover rounded-lg" style="pointer-events: 'none';" />
                                </a>
                            </div>
                            <button class="toggleFavorite absolute top-0 right-0 py-4 px-3 bg-black/80 rounded-tr-lg rounded-bl-xl" data-movie-id="<?= $data['id'] ?>">
                                <span class="bookmark-icon far fa-bookmark text-yellow-500 text-[25px]"></span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        <?php
        }
        ?>
    </div>

    <div class="swiper-container mt-0 mb-8 relative">
        <div class="swiper-wrapper">
            <?php
            $sql = mysqli_query($conn, "SELECT * FROM movie LIMIT 6");
            $hasil = mysqli_fetch_all($sql, MYSQLI_ASSOC);
            foreach ($hasil as $data) {
            ?>
                <div class="swiper-slide">
                    <a href="movie_details?id=<?= $data['id'] ?>" class="flex justify-center items-center">
                        <img src="<?= $data['backdrop_path'] ?>" />
                    </a>
                </div>
            <?php
            }
            ?>
        </div>
    </div>

    <?php include "pages/footer.php"; ?>

    <script>
        $(document).ready(function() {
            $('.toggleFavorite').each(function() {
                var movieId = $(this).data('movie-id');
                var isFavorited = localStorage.getItem('favorite_' + movieId);

                if (isFavorited === 'true') {
                    $(this).find('.bookmark-icon').addClass('fas').removeClass('far');
                } else {
                    $(this).find('.bookmark-icon').addClass('far').removeClass('fas');
                }
            });

            $('.toggleFavorite').click(function() {
                var movieId = $(this).data('movie-id');
                var button = $(this);
                var isFavorited = localStorage.getItem('favorite_' + movieId);

                $.ajax({
                    url: 'pages/controller/movies/add_favorite.php',
                    method: 'POST',
                    data: {
                        id: movieId,
                        favorite: !(isFavorited === 'true')
                    },
                    success: function(response) {
                        if (response === 'added') {
                            localStorage.setItem('favorite_' + movieId, 'true');
                            button.find('.bookmark-icon').removeClass('far').addClass('fas');
                            Swal.fire('Added to favorites', '', 'success');
                        } else if (response === 'removed') {
                            localStorage.setItem('favorite_' + movieId, 'false');
                            button.find('.bookmark-icon').removeClass('fas').addClass('far');
                            Swal.fire('Removed from favorites', '', 'success');
                        } else {
                            Swal.fire('Error', 'Something went wrong!', 'error');
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                        Swal.fire('Error', 'Failed to update favorites', 'error');
                    }
                });
            });

            var mySwiper = new Swiper('.swiper-container', {
                loop: true,
                autoplay: {
                    delay: 5000,
                },
                speed: 500,
            });
        });
    </script>
</div>