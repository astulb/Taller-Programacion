<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="#">
        <img src="img/Logo.png" width="30" height="30" class="d-inline-block align-top" alt="">
        PelisHD
    </a>
                
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <form class="form-inline my-2 my-lg-0 mr-auto ml-auto">
            <select class="form-control" id="categorySelect">
                <option>All Categories</option>
                <option>Accion</option>
                <option>Terror</option>
                <option>Comedia</option>
                <option>Shock</option>
            </select> 
            <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-primary my-2 my-sm-0" id="searchButton" type="submit">Search</button>
        </form>
        
        <ul class="navbar-nav "> 
            <!--NOMBRE USUARIO-->
            {if (isset($usuarioLogueado))}
                <li class="nav-item">
                    <span class="navbar-brand">{$usuarioLogueado.alias}</span>                                       
                </li>
                            
                {if ($usuarioLogueado.es_administrador)}
                    <!-- OPCIONES PARA ADMINISTRADORES -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Manage
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="#">Manage Comments</a>
                            <a class="dropdown-item" href="#">Add Movie</a>
                        </div>
                    </li>
                {/if}
                            
                <!--LOGOUT-->
                <li class="nav-item">
                    <a class="nav-link" href="login.php">Sign Out</a>
                </li>
            {else}
                
                <!-- BOTONOES LOGIN/REGISTER -->
                <li class="nav-item">
                    <a class="nav-link" href="#signInModal" data-toggle="modal" data-target="#signInModal">Sign In</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#signUpModal" data-toggle="modal" data-target="#signUpModal">Sign Up</a>
                </li>
            {/if}
        </ul>
                    
    </div>
</nav>
        
<!-- Modals -->
{include file="signInModal.tpl"}
{include file="signUpModal.tpl"}
