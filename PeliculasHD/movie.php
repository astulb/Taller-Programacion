<!DOCTYPE html>
<?php
require_once 'datos.php';
require_once 'libs/Smarty.class.php';

$mySmarty = getSmarty();


session_start();
$usuario = $_SESSION["usuarioLogueado"];

# Cargar datos
$movieID = 1;
if (isset($_GET["id"])) {
    $movieID = $_GET["id"];
}


$movie = getMovie($movieID);


if (isset($movie)) 
{
    # Crear una instancia de Smarty
    #     
    # asignar valores a las variables
    $mySmarty->assign("cast", getCast($movieID));
    $mySmarty->assign("reviews", getApprovedReviews($movieID));
    $mySmarty->assign("movie", $movie);
    $mySmarty->assign("usuarioLogueado", $usuario);
    $mySmarty->assign("generos", getGeneros());
    $mySmarty->assign("err", $_GET["err"]);
    $mySmarty->assign("msg", $_GET["msg"]);

    
    # mostrar el template
    $mySmarty->display('movie.tpl');
}
                   
       
