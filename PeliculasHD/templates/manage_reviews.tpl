<!doctype html>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
              integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <link rel="stylesheet" href="css/bs4Override.css">
        <link rel="stylesheet" href="css/movieStyle.css">
            
        <meta charset="utf-8">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
            
        <title>Upload Movie</title>
            
    </head>
    <body>
        {include file="navbar.tpl"}
        <div id="background-image" ><img src="img/backgroundImg.jpg"></div>    
        <div id="background-overlay"></div>
        
        <div class="main-content">
            <div class="management-content">
                <div class="section"> 
                    <div class="section-title">Review Management</div>
                    <div id="movie-reviews">
                        {foreach from=$reviews item=rev}
                            {include file="review_to_manage.tpl" review=$rev}   
                        {/foreach}
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>

