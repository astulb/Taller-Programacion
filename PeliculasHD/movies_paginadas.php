<?php

require_once 'datos.php';
//ini_set('display_errors', 1);

# crear instancia de smarty
$mySmarty = getSmarty();


$genId = 0;
if (isset($_GET["genId"])) {
    $genId = $_GET["genId"];
}

$pag = 1;
if (isset($_GET["pag"])) {
    $pag = $_GET["pag"];
}

# setear variables
//$mySmarty->assign("genre", $genre);
$mySmarty->assign("movies", getMoviesPerGenre($genId, $pag, $_GET['busqueda']));
$mySmarty->assign("page", $pag);
$mySmarty->assign("pages", pagesPerGenre($genId, $_GET['busqueda']));

# mostrar el template
$mySmarty->display('movies_paginadas.tpl');
