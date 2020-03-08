<?php

require_once 'datos.php';

$id = $_GET["id"];
denyReview($id);
header('location:manage_reviews.php');
