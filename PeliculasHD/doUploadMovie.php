<?php

require_once 'datos.php';

if (hayUsuarioAdmin()) {
    $title = $_POST["title"];
    $director = $_POST["director"];
    $synopsis = $_POST["synopsis"];
    $youtube_trailer = $_POST["youtube_trailer"];
    $launch_date = $_POST["launch_date"];
    $id_genre = $_POST["id_genre"];
    $cast = $_POST["cast"];
    $image = $_FILES["image"]["tmp_name"];
    
    $areEmptyFields = strlen($title) == 0 || strlen($director) == 0 || strlen($synopsis) == 0 ||
            strlen($launch_date) == 0 ||  strlen($id_genre) == 0 ||
            !is_uploaded_file($image); 
            
    if ($areEmptyFields) {
        header('location:uploadMovie.php?err=movieUploadError');
        return;
    }
    else{
        uploadMovie($title, $director, $cast, $synopsis, $youtube_trailer, $launch_date, $id_genre,
                $image);
        header('location:index.php');   
    }
} else {
    header('location:index.php');
}

