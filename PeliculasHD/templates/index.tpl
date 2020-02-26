<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>PeliculasHD</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" 
              integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">
        <!--<link rel="stylesheet" type="text/css" href="css/ventas.css">
        <script src="js/jquery-3.4.1.min.js"></script>
        <script src="js/index.js"></script>-->
    </head>
    {*<body>
        {include file="encabezado.tpl"}
        <div id="menu">
            <ul>
                <li><a href="#">Pagina Principal</a></li>
                    {if (isset($usuarioLogueado))}
                    <li>Hola {$usuarioLogueado.nombre} <a href="doLogout.php">Salir</a></li>
                    <li><a href="categorias.php">ABM Categorias</a></li>
                    <li><a href="editarProducto.php">Alta Producto</a></li>
                    {else}
                    <li><a href="login.php">Inicio de Sesion</a></li>
                    {/if}
                <li><a href="#">Contacto</a></li>
            </ul>
        </div>
        <div id="buscador">
            <label>Ingresa tu busqueda</label>
            <input type="text" id="texto"/>
            <input type="button" value="Buscar" id="buscar" />
        </div>
        <div id="categorias">
            <h2>Categorias</h2>
            <ul>
                {foreach from=$categorias item=cat}
                    <li>
                        <a href=#" class="categoria" catId="{$cat.id}">
                            {$cat.nombre}
                        </a>
                    </li>
                {/foreach}

            </ul>
        </div>
        <div id="productos">
           
        </div>
    </body>*}
</html>