<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
              integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <link rel="stylesheet" href="css/bs4Override.css">
        <link rel="stylesheet" href="css/homeStyle.css">

        <meta charset="utf-8">
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <title>PelisHD</title>
        <!--<link rel="stylesheet" type="text/css" href="css/ventas.css">
        <script src="js/jquery-3.4.1.min.js"></script>
        <script src="js/index.js"></script>-->
    </head>
    <body>
            
        {include file="navbar.tpl"}
        <div id="background-image" ><img src="img/backgroundImg.jpg"></div>    
        <div id="background-overlay"></div>
            
        <div class="main-content">
            <div id="paginacion">
                <button  class="previous btn btn-primary" {if ($pagina<=1)}disabled{/if}>Previous</button>
                {$pagina}1 / 3{$paginas}
                <button  class="next btn btn-primary" {if ($pagina>=$paginas)}disabled{/if}>Next</button>
            </div> 
            
            <div id="movies">
                {include file="movieCard.tpl"}            
            </div>
        </div>
    </body>
</html>


    
    
    
        
        {*{include file="encabezado.tpl"}
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
           
        </div> *}
