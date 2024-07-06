<?php
include "../../config/conn.php";

$query = mysqli_query($conn, "SELECT * FROM movie");
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
                    <button id="addMovieBtn" type="button" class="flex items-center justify-center text-white bg-gray-700 hover:bg-gray-800 focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-gray-600 dark:hover:bg-gray-700 focus:outline-none dark:focus:ring-gray-800">
                        <svg class="h-3.5 w-3.5 mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                            <path clip-rule="evenodd" fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" />
                        </svg>
                        Tambah Film
                    </button>
                </div>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-black/20 uppercase bg-gray-50 dark:bg-black/20 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-4 py-3">Title</th>
                            <th scope="col" class="px-4 py-3">Deskripsi</th>
                            <th scope="col" class="px-4 py-3">Poster</th>
                            <th scope="col" class="px-4 py-3">Backdrop</th>
                            <th scope="col" class="px-4 py-3">Genre</th>
                            <th scope="col" class="px-4 py-3">Category</th>
                            <th scope="col" class="px-4 py-3">Tanggal Rilis</th>
                            <th scope="col" class="px-4 py-3">Trailer</th>
                            <th scope="col" class="px-4 py-3">Durasi</th>
                            <th scope="col" class="px-4 py-3">Jumlah Voting</th>
                            <th scope="col" colspan="2" class="px-4 py-3">
                                <span class="sr-only">Aksi</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody id="movieList">
                        <?php
                        while ($row = mysqli_fetch_assoc($query)) {
                            $genres = json_decode($row['genres'], true);
                            $category = json_decode($row['category'], true);
                        ?>
                            <tr class="border-b dark:border-black/20">
                                <th scope="row" class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    <?= $row['title']; ?></th>
                                <td class="px-4 py-3"><span class="line-clamp-2"><?= $row['overview']; ?></span></td>
                                <td class="px-4 py-3"><img src="<?= $row['poster_path']; ?>" alt="" width="60"></td>
                                <td class="px-4 py-3"><img src="<?= $row['backdrop_path']; ?>" alt="" width="120"></td>
                                <td class="px-4 py-3"><?= implode(', ', $genres); ?></td>
                                <td class="px-4 py-3"><?= implode(', ', $category); ?></td>
                                <td class="px-4 py-3"><span class="line-clamp-2"><?= $row['release_date']; ?></span></td>
                                <td class="px-4 py-3"><a href="<?= $row['trailer']; ?>" target="_blank" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded duration-200">Trailer</a>
                                </td>
                                <td class="px-4 py-3"><span class="line-clamp-2"><?= $row['movieDuration']; ?></span></td>
                                <td class="px-4 py-3"><span class="line-clamp-2"><?= $row['vote_average']; ?></span></td>
                                <td class="px-4 py-3">
                                    <a href="edit_movie?id=<?= $row['id']; ?>" class="text-green-600 hover:text-green-800">
                                        <i class="fa-solid fa-pen-to-square text-green-500"></i>
                                    </a>
                                </td>
                                <td class="px-4 py-3">
                                    <button class="text-red-600 hover:text-red-800" onclick="deleteMovie(<?= $row['id']; ?>)"><i class="fa-solid fa-trash text-red-500"></i></button>
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
                    Tambah Data Film
                </h3>
                <button id="closeAddModal" type="button" class="text-gray-400 dark:text-gray-300 focus:outline-none">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path clip-rule="evenodd" d="M19.071 4.929a1 1 0 010 1.414L5.757 19.071a1 1 0 01-1.414-1.414L17.657 4.93a1 1 0 011.414 0z" fill-rule="evenodd"></path>
                        <path clip-rule="evenodd" d="M4.929 4.929a1 1 0 00-1.414 1.414L18.243 19.07a1 1 0 001.414-1.413L4.929 4.93z" fill-rule="evenodd"></path>
                    </svg>
                </button>
            </div>
            <div class="w-full h-auto px-4 flex flex-row gap-3">
                <form class="flex items-center w-1/2">
                    <label for="tmdb-search" class="sr-only">Search</label>
                    <div class="relative w-full">
                        <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                            <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5v10M3 5a2 2 0 1 0 0-4 2 2 0 0 0 0 4Zm0 10a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm12 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm0 0V6a3 3 0 0 0-3-3H9m1.5-2-2 2 2 2" />
                            </svg>
                        </div>
                        <input type="text" id="tmdb-search" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search branch name..." required />
                    </div>
                </form>
                <form class="w-1/2">
                    <label for="movie_select" class="sr-only">Select a Movie</label>
                    <select id="movie_select" class="block w-full px-3 py-2 placeholder-gray-300 border border-gray-300 rounded-md focus:outline-none focus:ring-gray-500 focus:border-gray-500 dark:bg-gray-800 dark:border-gray-600 dark:focus:ring-gray-500 dark:focus:border-gray-500 dark:text-white">
                        <option selected disabled>Choose a movie title</option>
                    </select>
                </form>
            </div>
            <form id="addMovieForm" class="p-4 md:p-5" action="pages/controller/movies/add_movie.php" method="POST">
                <input type="hidden" id="movieId" name="movieId" value="">
                <div class="flex flex-row w-full gap-3">
                    <div class="mb-4 w-1/2">
                        <label for="title" class="block mb-2 text-sm font-medium text-gray-600 dark:text-gray-300">Title</label>
                        <input type="text" id="title" name="title" placeholder="Title" required class="w-full px-3 py-2 placeholder-gray-300 border border-gray-300 rounded-md focus:outline-none focus:ring-gray-500 focus:border-gray-500 dark:bg-gray-800 dark:border-gray-600 dark:focus:ring-gray-500 dark:focus:border-gray-500 dark:text-white">
                    </div>
                    <div class="mb-4 w-1/2">
                        <label for="overview" class="block mb-2 text-sm font-medium text-gray-600 dark:text-gray-300">Deskripsi</label>
                        <textarea id="overview" name="overview" placeholder="Deskripsi" rows="3" class="w-full px-3 py-2 placeholder-gray-300 border border-gray-300 rounded-md focus:outline-none focus:ring-gray-500 focus:border-gray-500 dark:bg-gray-800 dark:border-gray-600 dark:focus:ring-gray-500 dark:focus:border-gray-500 dark:text-white"></textarea>
                    </div>
                </div>
                <div class="flex flex-row w-full gap-3">
                    <div class="mb-4 w-1/2">
                        <label for="posterPath" class="block mb-2 text-sm font-medium text-gray-600 dark:text-gray-300">Poster
                            Path</label>
                        <input type="text" id="posterPath" name="posterPath" placeholder="Poster Path" class="w-full px-3 py-2 placeholder-gray-300 border border-gray-300 rounded-md focus:outline-none focus:ring-gray-500 focus:border-gray-500 dark:bg-gray-800 dark:border-gray-600 dark:focus:ring-gray-500 dark:focus:border-gray-500 dark:text-white">
                    </div>
                    <div class="mb-4 w-1/2">
                        <label for="backdropPath" class="block mb-2 text-sm font-medium text-gray-600 dark:text-gray-300">Backdrop
                            Path</label>
                        <input type="text" id="backdropPath" name="backdropPath" placeholder="Backdrop Path" class="w-full px-3 py-2 placeholder-gray-300 border border-gray-300 rounded-md focus:outline-none focus:ring-gray-500 focus:border-gray-500 dark:bg-gray-800 dark:border-gray-600 dark:focus:ring-gray-500 dark:focus:border-gray-500 dark:text-white">
                    </div>
                </div>
                <div class="flex flex-row w-full gap-3">
                    <div class="mb-4 w-1/2">
                        <label for="genres" class="block mb-2 text-sm font-medium text-gray-600 dark:text-gray-300">Genre</label>
                        <input type="text" id="genres" name="genres" placeholder="Genre" class="w-full px-3 py-2 placeholder-gray-300 border border-gray-300 rounded-md focus:outline-none focus:ring-gray-500 focus:border-gray-500 dark:bg-gray-800 dark:border-gray-600 dark:focus:ring-gray-500 dark:focus:border-gray-500 dark:text-white">
                    </div>
                    <div class="mb-4 w-1/2">
                        <label for="category" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Category</label>
                        <select id="category" name="category" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option selected>Pilih Category</option>
                            <option value="popular movies">Popular Movies</option>
                            <option value="top movies">Top Movies</option>
                            <option value="now playing">Now Playing</option>
                            <option value="upcoming">Upcoming</option>
                        </select>
                    </div>
                </div>
                <div class="flex flex-row w-full gap-3">
                    <div class="mb-4 w-1/2">
                        <label for="releaseDate" class="block mb-2 text-sm font-medium text-gray-600 dark:text-gray-300">Tanggal
                            Rilis</label>
                        <input type="text" id="releaseDate" name="releaseDate" placeholder="YYYY-MM-DD" class="w-full px-3 py-2 placeholder-gray-300 border border-gray-300 rounded-md focus:outline-none focus:ring-gray-500 focus:border-gray-500 dark:bg-gray-800 dark:border-gray-600 dark:focus:ring-gray-500 dark:focus:border-gray-500 dark:text-white">
                    </div>
                    <div class="mb-4 w-1/2">
                        <label for="trailer" class="block mb-2 text-sm font-medium text-gray-600 dark:text-gray-300">Trailer
                            Link</label>
                        <input type="text" id="trailer" name="trailer" placeholder="Trailer Link" class="w-full px-3 py-2 placeholder-gray-300 border border-gray-300 rounded-md focus:outline-none focus:ring-gray-500 focus:border-gray-500 dark:bg-gray-800 dark:border-gray-600 dark:focus:ring-gray-500 dark:focus:border-gray-500 dark:text-white">
                    </div>
                </div>
                <div class="flex flex-row w-full gap-3">
                    <div class="mb-4 w-1/2">
                        <label for="movieDuration" class="block mb-2 text-sm font-medium text-gray-600 dark:text-gray-300">Durasi
                            Film</label>
                        <input type="text" id="movieDuration" name="movieDuration" placeholder="Durasi Film" class="w-full px-3 py-2 placeholder-gray-300 border border-gray-300 rounded-md focus:outline-none focus:ring-gray-500 focus:border-gray-500 dark:bg-gray-800 dark:border-gray-600 dark:focus:ring-gray-500 dark:focus:border-gray-500 dark:text-white">
                    </div>
                    <div class="mb-4 w-1/2">
                        <label for="voteAverage" class="block mb-2 text-sm font-medium text-gray-600 dark:text-gray-300">Jumlah
                            Voting</label>
                        <input type="float" id="voteAverage" name="voteAverage" placeholder="Jumlah Voting" class="w-full px-3 py-2 placeholder-gray-300 border border-gray-300 rounded-md focus:outline-none focus:ring-gray-500 focus:border-gray-500 dark:bg-gray-800 dark:border-gray-600 dark:focus:ring-gray-500 dark:focus:border-gray-500 dark:text-white">
                    </div>
                </div>
                <div class="mt-2 flex justify-center w-full">
                    <button type="submit" id="saveMovieBtn" class="bg-gray-600 hover:bg-gray-700 text-white rounded-md px-4 py-2 transition duration-200 focus:outline-none focus:ring-4 focus:ring-gray-300">Tambah</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const tmdbSearchInput = document.getElementById('tmdb-search');
        const movieSelect = document.getElementById('movie_select');
        const tmdbApiKey = '494764bde6bc7132f40fc9dc02b9e782';

        const searchTMDB = async (query) => {
            try {
                const response = await fetch(`https://api.themoviedb.org/3/search/movie?api_key=${tmdbApiKey}&query=${query}`);
                if (!response.ok) {
                    throw new Error('Failed to fetch movies');
                }
                const data = await response.json();
                return data.results;
            } catch (error) {
                console.error('Error fetching movies:', error);
                return [];
            }
        };

        const populateSelectOptions = async (query) => {
            const movies = await searchTMDB(query);
            movieSelect.innerHTML = '<option selected disabled>Choose a movie title</option>';
            movies.forEach(movie => {
                const option = document.createElement('option');
                option.value = movie.id;
                option.textContent = movie.title;
                movieSelect.appendChild(option);
            });
        };

        tmdbSearchInput.addEventListener('input', function() {
            const searchQuery = tmdbSearchInput.value.trim();
            if (searchQuery.length > 0) {
                populateSelectOptions(searchQuery);
            }
        });

        movieSelect.addEventListener('change', async function() {
            const selectedMovieId = movieSelect.value;
            if (selectedMovieId) {
                const response = await fetch(`https://api.themoviedb.org/3/movie/${selectedMovieId}?api_key=${tmdbApiKey}`);
                if (response.ok) {
                    const movieData = await response.json();
                    fillFormFields(movieData);
                } else {
                    console.error('Failed to fetch movie details');
                }
            }
        });

        const fillFormFields = async (movie) => {
            document.getElementById('title').value = movie.title || '';
            document.getElementById('overview').value = movie.overview || '';
            document.getElementById('posterPath').value = `https://image.tmdb.org/t/p/w500/${movie.poster_path}` || '';
            document.getElementById('backdropPath').value = `https://image.tmdb.org/t/p/w1280/${movie.backdrop_path}` || '';

            const genres = movie.genres.map(genre => genre.name).join(', ');
            document.getElementById('genres').value = genres || '';

            document.getElementById('releaseDate').value = movie.release_date || '';

            const trailerLink = await fetchTrailerLink(movie.id);
            document.getElementById('trailer').value = trailerLink || '';

            document.getElementById('movieDuration').value = movie.runtime ? `${movie.runtime}` : '';

            document.getElementById('voteAverage').value = movie.vote_average || '';
        };

        const fetchTrailerLink = async (movieId) => {
            try {
                const response = await fetch(`https://api.themoviedb.org/3/movie/${movieId}/videos?api_key=${tmdbApiKey}`);
                if (!response.ok) {
                    throw new Error('Failed to fetch trailer');
                }
                const data = await response.json();
                const trailer = data.results.find(video => video.type === 'Trailer');
                if (trailer) {
                    return `https://www.youtube.com/watch?v=${trailer.key}`;
                } else {
                    return '';
                }
            } catch (error) {
                console.error('Error fetching trailer:', error);
                return '';
            }
        };
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const addModal = document.getElementById('add-modal');
        const closeAddModalBtn = document.getElementById('closeAddModal');
        const addMovieForm = document.getElementById('addMovieForm');

        document.getElementById('addMovieBtn').addEventListener('click', function() {
            addModal.classList.remove('hidden');
            document.body.classList.add('overflow-hidden');
        });

        closeAddModalBtn.addEventListener('click', function() {
            addModal.classList.add('hidden');
            document.body.classList.remove('overflow-hidden');
        });

        addMovieForm.addEventListener('submit', function(event) {
            event.preventDefault();

            const formData = new FormData(addMovieForm);

            fetch('pages/controller/movies/add_movie.php', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: 'Movie added successfully!',
                        }).then(() => {
                            location.reload();
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Failed to add movie. Please try again.',
                        });
                    }
                })
                .catch(error => {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: 'Movie added successfully!',
                    }).then(() => {
                        location.reload();
                    });
                });
        });
    });
</script>

<script>
    function deleteMovie(movieId) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                fetch(`pages/controller/movies/delete_movie.php?id=${movieId}`, {
                        method: 'DELETE'
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            Swal.fire(
                                'Deleted!',
                                'The movie has been deleted.',
                                'success'
                            ).then(() => {
                                location.reload();
                            });
                        } else {
                            Swal.fire(
                                'Error!',
                                'Failed to delete the movie.',
                                'error'
                            );
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        Swal.fire(
                            'Error!',
                            'Failed to delete the movie.',
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
        const addMovieBtn = document.getElementById('addMovieBtn');
        const editMovieBtns = document.querySelectorAll('.editMovieBtn');
        const movieForm = document.getElementById('movieForm');
        const movieList = document.getElementById('movieList');

        addMovieBtn.addEventListener('click', function() {
            addModal.classList.remove('hidden');
            document.body.classList.add('overflow-hidden');
        });

        closeAddModalBtn.addEventListener('click', function() {
            addModal.classList.add('hidden');
            document.body.classList.remove('overflow-hidden');
        });

        editMovieBtns.forEach(function(btn) {
            btn.addEventListener('click', function(e) {
                e.preventDefault();
                const movieId = btn.getAttribute('data-id');
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