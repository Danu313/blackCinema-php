<?php
include "../../../../../config/conn.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $movieId = mysqli_real_escape_string($conn, $_POST['movieId']);
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $overview = mysqli_real_escape_string($conn, $_POST['overview']);
    $posterPath = mysqli_real_escape_string($conn, $_POST['posterPath']);
    $backdropPath = mysqli_real_escape_string($conn, $_POST['backdropPath']);
    
    $genresArray = array_map('trim', explode(',', $_POST['genres']));
    $categoryArray = array_map('trim', explode(',', $_POST['category']));
    
    $genres = json_encode($genresArray);
    $category = json_encode($categoryArray);
    
    $releaseDate = mysqli_real_escape_string($conn, $_POST['releaseDate']);
    $trailer = mysqli_real_escape_string($conn, $_POST['trailer']);
    $movieDuration = mysqli_real_escape_string($conn, $_POST['movieDuration']);
    $voteAverage = mysqli_real_escape_string($conn, $_POST['voteAverage']);

    $updateQuery = "UPDATE movie 
                    SET title='$title', overview='$overview', poster_path='$posterPath', backdrop_path='$backdropPath', 
                        genres='$genres', category='$category', release_date='$releaseDate', trailer='$trailer', 
                        movieDuration='$movieDuration', vote_average='$voteAverage' 
                    WHERE id='$movieId'";

    if (mysqli_query($conn, $updateQuery)) {
        header("Location: ../../../movies");
        exit();
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }
}

mysqli_close($conn);
?>
