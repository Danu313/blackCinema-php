<?php
include "../../../../../config/conn.php";
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userId = $_SESSION['user_id'];
    $title = isset($_POST['title']) ? mysqli_real_escape_string($conn, $_POST['title']) : null;
    $overview = isset($_POST['overview']) ? mysqli_real_escape_string($conn, $_POST['overview']) : null;
    $posterPath = isset($_POST['posterPath']) ? mysqli_real_escape_string($conn, $_POST['posterPath']) : null;
    $backdropPath = isset($_POST['backdropPath']) ? mysqli_real_escape_string($conn, $_POST['backdropPath']) : null;
    $genres = isset($_POST['genres']) ? json_encode(explode(',', $_POST['genres'])) : null;
    $category = isset($_POST['category']) ? json_encode(explode(',', $_POST['category'])) : null;
    $releaseDate = isset($_POST['releaseDate']) ? mysqli_real_escape_string($conn, $_POST['releaseDate']) : null;
    $trailer = isset($_POST['trailer']) ? mysqli_real_escape_string($conn, $_POST['trailer']) : null;
    $movieDuration = isset($_POST['movieDuration']) ? mysqli_real_escape_string($conn, $_POST['movieDuration']) : null;
    $voteAverage = isset($_POST['voteAverage']) ? mysqli_real_escape_string($conn, $_POST['voteAverage']) : null;

    $insertQuery = "INSERT INTO movie (userId, title, overview, poster_path, backdrop_path, genres, category, release_date, trailer, movieDuration, vote_average) 
                    VALUES ('$userId', " . var_export($title, true) . ", " . var_export($overview, true) . ", " . var_export($posterPath, true) . ", " . var_export($backdropPath, true) . ", " . var_export($genres, true) . ", " . var_export($category, true) . ", " . var_export($releaseDate, true) . ", " . var_export($trailer, true) . ", " . var_export($movieDuration, true) . ", " . var_export($voteAverage, true) . ")";

    if (mysqli_query($conn, $insertQuery)) {
        header('Location: pages/views/movies.php');
        exit;
    } else {
        echo "Error: " . $insertQuery . "<br>" . mysqli_error($conn);
    }
}

mysqli_close($conn);
?>
