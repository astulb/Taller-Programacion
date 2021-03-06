<?php

require_once 'libs/Smarty.class.php';
require_once 'class.Conexion.BD.php';
require_once 'configuracion.php';


function abrirConexion() {
    $cn = new ConexionBD($GLOBALS['SQL_language'], $GLOBALS['host'], $GLOBALS['DB_name'], $GLOBALS['vm_user'], $GLOBALS['vm_pass']);
    $cn->conectar();
    return $cn;
}

function getGeneros() {
    $cn = abrirConexion();
    $cn->consulta('SELECT id, nombre FROM generos ORDER BY id');
    return $cn->restantesRegistros();
}

function getGenre($id) {
    if($id == 0){
        return array("id" => 0,"nombre" => "All Genres");
         
    }
    else{
        $cn = abrirConexion();
        $cn->consulta('SELECT id, nombre FROM generos WHERE id=:id', array(
        array("id", $id, 'int')
    ));
    return $cn->siguienteRegistro();   
    }
}

function pagesPerGenre($idGen, $filtro="") {
    $filtro = '%' . $filtro . '%';
    $tamano = 6;
    $cn = abrirConexion();
    if($idGen == 0){
         $cn->consulta(
            'SELECT count(*) as total FROM peliculas '
            . 'WHERE titulo LIKE :filtro ', array(
        array("filtro", $filtro, 'string')
    ));
    }else{
         $cn->consulta(
            'SELECT count(*) as total FROM peliculas '
            . 'WHERE id_genero = :id AND titulo LIKE :filtro ', array(
        array("id", $idGen, 'int'),
        array("filtro", $filtro, 'string')
    ));
    }
   

    $fila = $cn->siguienteRegistro();
    $total = $fila["total"];
    $paginas = ceil($total / $tamano);
    if ($paginas == 0) {
        $paginas = 1;
    };
    return $paginas;
}

function getMoviesPerGenre($genId, $pagina, $filtro = "") {
    $tamano = 6;
    $offset = ($pagina - 1) * $tamano;
    $filtro = '%' . $filtro . '%';
    
    $cn = abrirConexion();
    if($genId == 0){
            $cn->consulta(
        'SELECT peliculas.id, peliculas.titulo, peliculas.fecha_lanzamiento, peliculas.director, peliculas.puntuacion, '
            . 'peliculas.youtube_trailer, peliculas.resumen, generos.nombre ' 
            . 'FROM peliculas RIGHT JOIN generos ON id_genero = generos.id '
            . 'WHERE titulo LIKE :filtro '
            . 'ORDER BY fecha_lanzamiento DESC '
            . 'LIMIT :offset, :tamano', array(
        array("offset", $offset, 'int'),
        array("tamano", $tamano, 'int'),
        array("filtro", $filtro, 'string')
    ));
    } else {
            $cn->consulta(
                'SELECT peliculas.id, peliculas.titulo, peliculas.fecha_lanzamiento, peliculas.director, peliculas.puntuacion, '
            . 'peliculas.youtube_trailer, peliculas.resumen, generos.nombre ' 
            . 'FROM peliculas RIGHT JOIN generos ON id_genero = generos.id '
            . 'WHERE id_genero = :id AND titulo LIKE :filtro '
            . 'ORDER BY fecha_lanzamiento DESC '
            . 'LIMIT :offset, :tamano', array(
        array("id", $genId, 'int'),
        array("offset", $offset, 'int'),
        array("tamano", $tamano, 'int'),
        array("filtro", $filtro, 'string')
    ));
    }

    return $cn->restantesRegistros();
}

function getMovie($id) {
    $cn = abrirConexion();
    $cn->consulta(
            'SELECT peliculas.id, peliculas.titulo, peliculas.fecha_lanzamiento, peliculas.director, peliculas.puntuacion,'
            . ' peliculas.youtube_trailer, peliculas.resumen, generos.nombre '
            . 'FROM peliculas JOIN generos ON id_genero = generos.id '
            . 'WHERE peliculas.id = :id ', array(
        array("id", $id, 'int')
    ));
    return $cn->siguienteRegistro();
}

function registerUser($email, $alias, $password) {
    $cn = abrirConexion();
    $cn->consulta('INSERT INTO usuarios(email, alias, password) '
            . 'VALUES (:email, :alias, :password)', array(
        array("email", $email, 'string'),
        array("alias", $alias, 'string'),
        array("password", $password, 'string'),
    ));
}

function login($email, $password) {
    $password = md5($password);
    $cn = abrirConexion();
    $cn->consulta('SELECT * FROM usuarios '
            . 'WHERE email = :email AND '
            . 'password = :password', array(
        array("email", $email, 'string'),
        array("password", $password, 'string'),
    ));
    
    $usuarioRetornado = $cn->siguienteRegistro();
    if($usuarioRetornado != null){
        return array(
            "id" => $usuarioRetornado["id"],
            "alias" => $usuarioRetornado["alias"],
            "email" => $usuarioRetornado["email"],
            "es_administrador" => $usuarioRetornado["es_administrador"]
        );
    }
    else{
        return null;
    }
}

function uploadActors($cast, $id){
    $cast = explode(";", $cast);
    $cn = abrirConexion();
    foreach ($cast as $actor) {
        $cn->consulta('INSERT INTO elencos(id_pelicula, nombre) '
                . 'VALUES (:id_pelicula, :nombre)',array(
                array("id_pelicula", $id, 'int'),
                array("nombre", $actor, 'string'),
                ));
    }
}

function uploadMovie($title, $director, $cast, $synopsis, $youtube_trailer, $launch_date, $id_genre,
                $image) {
    $cn = abrirConexion();
    $cn->consulta('INSERT INTO peliculas(titulo, id_genero, fecha_lanzamiento, resumen, director, youtube_trailer) '
            . 'VALUES (:titulo, :id_genero, :fecha_lanzamiento, :resumen, :director, :youtube_trailer)', array(
        array("titulo", $title, 'string'),
        array("id_genero", $id_genre, 'int'),
        array("fecha_lanzamiento", $launch_date, 'string'),
        array("resumen", $synopsis, 'string'),
        array("director", $director, 'string'),
        array("youtube_trailer", $youtube_trailer, 'string'),
    ));

    $id = $cn->ultimoIdInsert();
    uploadActors($cast, $id);
    move_uploaded_file($image, "img/posters/" . $id);
}

function existsUser($email, $alias){
    $cn = abrirConexion();
    $cn->consulta(
            'SELECT * FROM usuarios '
            . 'WHERE email = :email OR '
            . 'alias = :alias;', array(
        array("email", $email, 'string'),
        array("alias", $alias, 'string')        
    ));
    
    if($cn->siguienteRegistro() != null){
        return true;
    }
    else{
        return false;
    }
}

function getCast($movieId){
    $cn = abrirConexion();
    $cn->consulta(
            'SELECT * FROM elencos '
            . 'WHERE id_pelicula = :id ', array(
        array("id", $movieId, 'int')
    ));
    return $cn->restantesRegistros();
}

function insertReview($mensaje, $puntuacion, $usuarioId, $movieID, $estado){
    $cn = abrirConexion();
    $cn->consulta('SELECT * FROM comentarios WHERE id_usuario = :id_usuario AND id_pelicula = :id_pelicula', array(
                array("id_pelicula", $movieID, 'int'),
                array("id_usuario", $usuarioId, 'int'),
    ));
    if($cn->siguienteRegistro() == null){
        $cn->consulta('INSERT INTO comentarios(id_pelicula, mensaje, puntuacion, id_usuario, estado) '
            . 'VALUES (:id_pelicula, :mensaje, :puntuacion, :id_usuario, :estado)', array(
        array("id_pelicula", $movieID, 'int'),
        array("mensaje", $mensaje, 'string'),
        array("puntuacion", $puntuacion, 'int'),
        array("id_usuario", $usuarioId, 'int'),
        array("estado", $estado, 'string'),
    ));
        return true;
    }
    return false;
}
    
function getApprovedReviews($movieId, $pag){
    $tamano = 5;
    $offset = ($pag - 1) * $tamano;
        
    $cn = abrirConexion();
    $cn->consulta(
            'SELECT comentarios.id, comentarios.mensaje, comentarios.puntuacion, comentarios.estado, usuarios.alias '
            . 'FROM comentarios JOIN usuarios ON id_usuario = usuarios.id '
            . 'WHERE id_pelicula = :id AND estado = "APROBADO" '
            . 'ORDER by id DESC '
            . 'LIMIT :offset, :tamano', array(
        array("id", $movieId, 'int'),
        array("offset", $offset, 'int'),
        array("tamano", $tamano, 'int')
    ));
    return $cn->restantesRegistros();
}

function reviewPagesPerMovie($movieId) {
    $tamano = 5;
        
    $cn = abrirConexion();
        
    $cn->consulta(
        'SELECT count(*) as total FROM comentarios '
        . 'WHERE id_pelicula = :movieId AND estado = "APROBADO" ', array(
    array("movieId", $movieId, 'int'),
    ));
        
    $fila = $cn->siguienteRegistro();
    $total = $fila["total"];
    $paginas = ceil($total / $tamano);
    if ($paginas == 0) {
        $paginas = 1;
    };
    return $paginas;
}

function getPendingReviews(){
    $cn = abrirConexion();
    $cn->consulta(
            'SELECT comentarios.id, comentarios.mensaje, comentarios.puntuacion, usuarios.alias, comentarios.id_pelicula '
            . 'FROM comentarios JOIN usuarios ON id_usuario = usuarios.id '
            . 'WHERE comentarios.estado = "PENDIENTE" ');
    return $cn->restantesRegistros();
}

function denyReview($id){
    $cn = abrirConexion();
    $cn->consulta('UPDATE comentarios SET estado = "RECHAZADO" WHERE id = :id', array(
        array("id", $id, 'int')
    ));
}

function acceptReview($id){
    $cn = abrirConexion();
    $cn->consulta('UPDATE comentarios SET estado = "APROBADO" WHERE id = :id', array(
        array("id", $id, 'int')
    ));
}

function updateScore($id){
    $cn = abrirConexion();
    $cn->consulta('UPDATE peliculas SET puntuacion = '
            . '(SELECT AVG(puntuacion) FROM comentarios WHERE id_pelicula = :id AND estado = "APROBADO") '
            . 'WHERE id = :id', array(
        array("id", $id, 'int'),      
    ));
}

function getSmarty() {
    $mySmarty = new Smarty();
    $mySmarty->template_dir = 'templates';
    $mySmarty->compile_dir = 'templates_c';
    $mySmarty->config_dir = 'config';
    $mySmarty->cache_dir = 'cache';
    return $mySmarty;
}

function hayUsuario() {
    session_start();
    $usuarioLogueado = $_SESSION["usuarioLogueado"];
    
    return isset($usuarioLogueado);
}

function hayUsuarioAdmin() {
    session_start();
    $usuarioLogueado = $_SESSION["usuarioLogueado"];
    
    return isset($usuarioLogueado) && $usuarioLogueado["es_administrador"] == 1;
}
