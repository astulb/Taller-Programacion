<?php

require_once 'datos.php';

session_start();
$usuario = $_SESSION["usuarioLogueado"];

if (hayUsuario()) {
    $mensaje = $_POST["mensaje"];
    $puntuacion = $_POST["puntuacion"];
    
    $movieID = 1;
    if (isset($_GET["id"])) {
        $movieID = $_GET["id"];
    }
    
    $isReviewInserted = insertReview($mensaje, $puntuacion, $usuario["id"], $movieID, "PENDIENTE");
    if($isReviewInserted == true){
        header('location:movie.php?id='.$movieID .'&msg=SentForApproval');
    }
    else{
        header('location:movie.php?id='.$movieID .'&err=ExistentReview');
    }
    
} else {
    header('location:index.php');
}

