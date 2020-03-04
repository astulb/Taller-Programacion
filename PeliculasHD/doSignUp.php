<?php

require_once 'datos.php';

$alias = $_POST["alias"];
$password = $_POST["password"];
$email = $_POST["email"];

$areEmptyFields = strlen($alias) == 0 || strlen($password) == 0 || strlen($email) == 0;
if ($areEmptyFields) {
        header('location:index.php?err=signUpErrorEmptyFields');
        return;
} 
else {
    $password = md5($password);
    
    $existsUser = existsUser($email, $alias);
    if($existsUser){
        header('location:index.php?err=signUpErrorExistentUser');
        return;
    }
    else {
        registerUser($email, $alias, $password);
        $usuarioLogueado = array(
                    "email" => $email,
                    "password" => $password,
                    "alias" => $alias
                );
        session_start();
        $_SESSION["usuarioLogueado"] = $usuarioLogueado;
        header('location:index.php');
    }
}