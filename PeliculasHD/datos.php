<?php

require_once 'libs/Smarty.class.php';
require_once 'class.Conexion.BD.php';

/*
 * Todas las funciones en este archivo devuelven datos.
 * Por ahora son datos "harcoded", pero en el futuro las vamos 
 * a cambiar para que hagan consultas a la base de datos. 
 *  */

/*
  function getConexion() {
  $usuario = "root";
  $clave = "root";

  $cn = new PDO(
  'mysql:host=localhost;dbname=sitio_ventas', $usuario, $clave);
  return $cn;
  }
 */

function abrirConexion() {
    $cn = new ConexionBD("mysql", "localhost", "guia_cine", "root", "root");
    $cn->conectar();
    return $cn;
}

function getCategorias() {
    $cn = abrirConexion();
    $cn->consulta('SELECT id, nombre FROM categorias ORDER BY nombre');
    return $cn->restantesRegistros();
}

function getCategoria($id) {
    $cn = abrirConexion();
    $cn->consulta('SELECT id, nombre FROM categorias WHERE id=:id', array(
        array("id", $id, 'int')
    ));
    return $cn->siguienteRegistro();
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

function getProductosDeCategoria($idCategoria, $pagina, $filtro = "") {
    $tamano = 4;
    $offset = ($pagina - 1) * $tamano;
    $filtro = '%' . $filtro . '%';
    
    $cn = abrirConexion();
    $cn->consulta(
            'SELECT * FROM productos '
            . 'WHERE categoria_id = :id AND nombre LIKE :filtro '
            . 'ORDER BY nombre '
            . 'LIMIT :offset, :tamano', array(
        array("id", $idCategoria, 'int'),
        array("offset", $offset, 'int'),
        array("tamano", $tamano, 'int'),
        array("filtro", $filtro, 'string')
    ));
    return $cn->restantesRegistros();
}

function getProducto($id) {

    $cn = abrirConexion();
    $cn->consulta(
            'SELECT * FROM productos '
            . 'WHERE id = :id ', array(
        array("id", $id, 'int')
    ));
    return $cn->siguienteRegistro();
}

function login($usuario, $password) {
    if ($usuario == "test" && $password == "test") {
        return array(
            "usuario" => "test",
            "nombre" => "Usuario de Prueba"
        );
    }

    return NULL;
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
