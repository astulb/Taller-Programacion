<?php

require_once 'datos.php';
//ini_set('display_errors', 1);

# crear instancia de smarty
$mySmarty = getSmarty();



if (isset($_GET["movieId"])) {
    $movieId = $_GET["movieId"];
}


if (isset($_GET["pag"])) {
    $pag = $_GET["pag"];
}

# setear variables
//$mySmarty->assign("genre", $genre);
$mySmarty->assign("reviews", getApprovedReviews($genId, $pag));
$mySmarty->assign("page", $pag);
$mySmarty->assign("pages", reviewPagesPerMovie($movieId));

# mostrar el template
$mySmarty->display('reviews-paginados.tpl');
