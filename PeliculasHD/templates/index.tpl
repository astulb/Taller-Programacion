<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
              integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <link rel="stylesheet" href="css/bs4Override.css">
        <link rel="stylesheet" href="css/homeStyle.css">
        <script src="js/jquery-3.4.1.min.js"></script>
        <script src="js/index.js"></script>

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
                <button  id="previous" class="previous btn btn-primary" {if ($page<=1)}disabled{/if}>Previous</button>
                {$page}1 / 3{$pages}
                <button  id="next" class="next btn btn-primary" {if ($page>=$pages)}disabled{/if}>Next</button>
            </div> 
            
            <div id="movies">
                
            </div>
        </div>
    </body>
</html>