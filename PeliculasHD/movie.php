<!DOCTYPE html>
<?php
require_once 'datos.php';
require_once 'libs/Smarty.class.php';

ini_set("display_errors",1);

# Cargar datos
$movieID = 1;
if (isset($_GET["id"])) {
    $movieID = $_GET["id"];
}

//$movie = getMovie($movieId);

//if (isset($movie)) 
if(true){
    # Crear una instancia de Smarty
    $mySmarty = getSmarty();
    
    # asignar valores a las variables
    //$mySmarty->assign("movie", $movie);
    
    # mostrar el template
    $mySmarty->display('movie.tpl');
}
                   
       
