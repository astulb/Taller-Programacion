<?php
require_once 'datos.php';
//ini_set('display_errors', 1);

# crear instancia de smarty
$mySmarty = getSmarty();

# cargar datos
session_start();
$usuario = $_SESSION["usuarioLogueado"];

# setear variables
$mySmarty->assign("usuarioLogueado", $usuario);
$mySmarty->assign("generos", getGeneros());
$mySmarty->assign("err", $_GET["err"]);

# mostrar el template
if(hayUsuarioAdmin()){
  $mySmarty->display('uploadMovie.tpl');  
}
else{
 header('location:index.php');
}


