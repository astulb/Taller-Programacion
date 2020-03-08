<?php

require_once 'datos.php';

# crear instancia de smarty
$mySmarty = getSmarty();


$movieId = 1;
if (isset($_GET["movieId"])) {
    $movieId = $_GET["movieId"];
}
$pag = 1;
if (isset($_GET["pag"])) {
    $pag = $_GET["pag"];
}

$reviews = getApprovedReviews($movieId, $pag);
$pages = reviewPagesPerMovie($movieId);

# setear variables
$mySmarty->assign("reviews", $reviews);
$mySmarty->assign("page", $pag);
$mySmarty->assign("pages", $pages);

# mostrar el template
$mySmarty->display('reviews_paginados.tpl');
