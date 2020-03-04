<!DOCTYPE html>
<?php
require_once 'datos.php';
require_once 'libs/Smarty.class.php';

$mySmarty = getSmarty();

ini_set("display_errors",1);

session_start();
$usuario = $_SESSION["usuarioLogueado"];

# Cargar datos
$movieID = 1;
if (isset($_GET["id"])) {
    $movieID = $_GET["id"];
}

//$movie = getMovie($movieId);

//if (isset($movie)) 
if(true){
    # Crear una instancia de Smarty
    #     
    # asignar valores a las variables
    //$mySmarty->assign("movie", $movie);
    $mySmarty->assign("usuarioLogueado", $usuario);
    
    # mostrar el template
    $mySmarty->display('movie.tpl');
}
                   
       
