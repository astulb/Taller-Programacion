<?php

require_once 'datos.php';
//ini_set('display_errors', 1);

# crear instancia de smarty
$mySmarty = getSmarty();

# cargar datos
session_start();
$usuario = $_SESSION["usuarioLogueado"];

$genId = 0;
if (isset($_COOKIE["ultimoGenero"])) {
    $genId = $_COOKIE["ultimoGenero"];
}

if (isset($_GET["genId"])) {
    $genId = $_GET["genId"];
}

//$genre = getGenre($genId);
//if (isset($genre)) {
//     setcookie("ultimoGenero", $genId, time() + (60 * 60 * 24), "/");
//}

# setear variables
$mySmarty->assign("indexLocation", $_GET["err"]);
$mySmarty->assign("usuarioLogueado", $usuario);
$mySmarty->assign("generos", getGeneros());
$mySmarty->assign("err1", $_GET["err"]);
$mySmarty->assign("err2", $_GET["err"]);
$mySmarty->assign("movies", getMoviesPerGenre($genId, 1));

# mostrar el template
$mySmarty->display('index.tpl');