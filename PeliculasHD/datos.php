<?php

require_once 'libs/Smarty.class.php';
require_once 'class.Conexion.BD.php';

function abrirConexion() {
    $cn = new ConexionBD("mysql", "localhost", "guia_cine", "root", "root");
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

function eliminarCategoria($id) {
    $cn = abrirConexion();
    $cn->consulta('DELETE FROM categorias WHERE id=:id', array(
        array("id", $id, 'int')
    ));
}

function existeCategoria($nombre) {
    $cn = abrirConexion();
    $cn->consulta('SELECT id, nombre FROM categorias WHERE nombre=:nombre', array(
        array("nombre", $nombre, 'string')
    ));
    return $cn->cantidadRegistros() > 0;
}

function guardarCategoria($categoria) {
    $cn = abrirConexion();
    if ($categoria["id"] > 0) {
        $cn->consulta('UPDATE categorias SET nombre = :nombre '
                . 'WHERE id = :id', array(
            array("nombre", $categoria["nombre"], 'string'),
            array("id", $categoria["id"], 'int')
        ));
    } else {
        $cn->consulta('INSERT INTO categorias(nombre) VALUES (:nombre)', array(
            array("nombre", $categoria["nombre"], 'string')
        ));
    }
}

function guardarProducto($nombre, $descripcion, $precio, $categoria, $imagen) {
    $cn = abrirConexion();
    $cn->consulta('INSERT INTO productos(nombre, descripcion, precio, categoria_id) '
            . 'VALUES (:nombre, :descripcion, :precio, :categoria)', array(
        array("nombre", $nombre, 'string'),
        array("descripcion", $descripcion, 'string'),
        array("precio", $precio, 'int'),
        array("categoria", $categoria, 'int')
    ));

    $id = $cn->ultimoIdInsert();
    if (is_uploaded_file($imagen)) {
        move_uploaded_file($imagen, "img_productos/" . $id);
    }
}

function cantidadPaginasCategoria($idCategoria, $filtro="") {
    $filtro = '%' . $filtro . '%';
    $tamano = 4;
    $cn = abrirConexion();
    $cn->consulta(
            'SELECT count(*) as total FROM productos '
            . 'WHERE categoria_id = :id AND nombre LIKE :filtro ', array(
        array("id", $idCategoria, 'int'),
        array("filtro", $filtro, 'string')
    ));

    $fila = $cn->siguienteRegistro();
    $total = $fila["total"];
    $paginas = ceil($total / $tamano);
    if ($paginas == 0) {
        $paginas = 1;
    };
    return $paginas;
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

function getReviews($movieId){
    $cn = abrirConexion();
    $cn->consulta(
            'SELECT comentarios.mensaje, comentarios.puntuacion, comentarios.estado, usuarios.alias '
            . 'FROM comentarios JOIN usuarios ON id_usuario = usuarios.id '
            . 'WHERE id_pelicula = :id AND estado = "APROBADO" ', array(
        array("id", $movieId, 'int')
    ));
    return $cn->restantesRegistros();
}

function getPendingReviews(){
    $cn = abrirConexion();
    $cn->consulta(
            'SELECT comentarios.id, comentarios.mensaje, comentarios.puntuacion, usuarios.alias '
            . 'FROM comentarios JOIN usuarios ON id_usuario = usuarios.id '
            . 'WHERE comentarios.estado = "PENDIENTE" ');
    return $cn->restantesRegistros();
}

function getSmarty() {
    $mySmarty = new Smarty();
    $mySmarty->template_dir = 'templates';
    $mySmarty->compile_dir = 'templates_c';
    $mySmarty->config_dir = 'config';
    $mySmarty->cache_dir = 'cache';
    return $mySmarty;
}

function hayUsuarioAdmin() {
    session_start();
    $usuarioLogueado = $_SESSION["usuarioLogueado"];
    
    return isset($usuarioLogueado) && $usuarioLogueado["es_administrador"] == 1;
}
