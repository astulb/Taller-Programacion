<!doctype html>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
              integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <link rel="stylesheet" href="css/bs4Override.css">
        <link rel="stylesheet" href="css/movieStyle.css">
            
        <script src="js/jquery-3.4.1.min.js"></script>
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
                <form method="POST" action="doUploadMovie.php"
                      enctype="multipart/form-data">
                    <label class="extra-data">Title</label>
                    <br>
                    <input type="text" name="title" />
                    <br>
                    <label class="extra-data">Trailer (Youtube link)</label>
                    <br>
                    <input type="text" name="youtube_trailer" />
                    <br>
                    <label class="extra-data">Director</label>
                    <br>
                    <input type="text" name="director" />
                    <br>
                    <label class="extra-data">Launch date</label>
                    <br>
                    <input type="text" name="launch_date" placeholder="i.e. yyyy-mm-dd" />
                    <br>
                    <label class="extra-data">Genre</label>
                    <br>
                    <select name="id_genre">
                        {foreach from=$generos item=gen}
                            <option value="{$gen.id}">{$gen.nombre}</option>
                        {/foreach}
                    </select>
                    <br>
                    <br>
                    <label class="extra-data">Synopsis</label>
                    <br>
                    <textarea type="text" name="synopsis" cols="40" rows="5"></textarea>>
                    <br>
                    <label class="extra-data">Cast</label>
                    <br>
                    <textarea name="cast" cols="40" rows="5"placeholder="Each name separated by ; &#010;i.e. Tom Cruise;Ben Stiller;Silvester Stalone"></textarea>
                    <br>
                    {if (isset($err))}
                        <script>
                            $(function() {
                                alert("Error in upload, there were empty fields. Please try again");
                            });
                        </script>
                    {/if}
                    <br>
                    <label class="extra-data">Poster</label>
                    <input type="file" accept=".jpg,.png" name="image" id="movie-poster-input" class="hidden"/>
                    <br>
                    <br>
                    <input class="btn btn-primary" type="submit" value="Save" />
                </form>
            </div>
        </div>
    </body>
</html>

