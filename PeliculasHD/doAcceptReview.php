<?php

require_once 'datos.php';

$idR = $_GET["idR"];
$idP = $_GET["idP"];
acceptReview($idR);
updateScore($idP);
header('location:manage_reviews.php');

