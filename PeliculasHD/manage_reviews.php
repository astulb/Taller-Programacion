<?php
require_once 'datos.php';
//ini_set('display_errors', 1);

# crear instancia de smarty
$mySmarty = getSmarty();

# cargar datos
session_start();
$usuario = $_SESSION["usuarioLogueado"];


# mostrar el template
if(hayUsuarioAdmin()){
  $mySmarty->assign("usuarioLogueado", $usuario);
  $mySmarty->assign("reviews", getPendingReviews());

  $mySmarty->display('manage_reviews.tpl');  
}
else{
 header('location:index.php');
}


