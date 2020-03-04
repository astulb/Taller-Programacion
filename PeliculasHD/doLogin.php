<?php

require_once 'datos.php';

$email = $_POST["email"];
$password = $_POST["password"];

$usuarioLogueado = login($email, $password);

if (isset($usuarioLogueado)) {
    session_start();
    $_SESSION["usuarioLogueado"] = $usuarioLogueado;
    header('location:index.php');
} 
else {
    header('location:index.php?err=signInError');
}