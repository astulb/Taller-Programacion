<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
              integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <link rel="stylesheet" href="css/bs4Override.css">
        <link rel="stylesheet" href="css/movieStyle.css">
        <meta charset="utf-8">
        
        <script src="js/jquery-3.4.1.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <script src="js/reviews.js"></script>
            
        <title>{$movie.titulo}</title>
    </head>
        
    <body>
        {include file="navbar.tpl"}
        <div id="background-image" ><img src="img/backgroundImg.jpg"></div>    
        <div id="background-overlay"></div>
        
        <div class="main-content">
            <div id="movies">
                <div class="movie-poster">
                    <img  src="img/posters/{$movie.id}"/>
                </div>
                <div class="movie-data">
                    <div class="movie-title">
                        <span class="nombre-producto">{$movie.titulo}</span>
                    </div>
                        
                    <div class="extra-data"> 
                        <div class="genre">{$movie.nombre} ({$movie.fecha_lanzamiento})</div>
                        <div class="rating">Score: {$movie.puntuacion}/5</div>
                    </div>
                    
                    <div class="synopsis">
                        <h3>Synopsis</h3>
                        <p>
                            {$movie.resumen}
                        </p>                
                    </div>
                </div>
                {if {$movie.youtube_trailer} }
                    <div class="section" id="trailer">
                        <div class="section-title">Trailer</div>
                        <div>
                            <iframe width="560" height="315" 
                                    src="{$movie.youtube_trailer}" 
                                    frameborder="0" 
                                    allow="accelerometer; 
                                    encrypted-media; 
                                    gyroscope; 
                                    picture-in-picture" 
                                    allowfullscreen>                                   
                            </iframe>
                        </div>
                    </div>
                {/if}
                <div class="section" id="comments"> 
                    <div class="section-title">Reviews</div>
                    <div id="movie-reviews">
                        <!--REVIEW USUARIO LOGEADO-->
                        {if (isset($usuarioLogueado))}
                            <div class="review-imput">
                                <form action="doInsertReview.php?id={$movie.id}" method="POST" enctype="multipart/form-data">                              
                                    <div class="form-group">
                                        <span class="review-box-title">Leave a review!</span>
                                        <textarea type="text" class="form-control" id="exampleFormControlTextarea1" rows="3" placeholder="Write your review here…" name="mensaje"></textarea>
                                    </div>
                                    <div class="form-inline">
                                        <div class="form-group">
                                            <span class="review-box-text">Score: </span>
                                            <select class="form-control" id="exampleFormControlSelect1" name="puntuacion">
                                                {for $score=1 to 5}
                                                    <option>{$score}</option>
                                                {/for}
                                            </select>
                                        </div>
                                        <input type="submit" class="btn btn-primary ml-auto" value="Submit">
                                    </div>
                                    {if (isset($err))}
                                        <script>
                                            $(function() {
                                                alert("You already reviewed this movie");
                                            });
                                        </script>
                                    {elseif (isset($msg))}
                                        <script>
                                            $(function() {
                                                alert("Review has been submitted for approval");
                                            });
                                        </script>   
                                    {/if}
                                </form>
                            </div>
                            <!--REVIEW USUARIO LOGEADO-->
                        {else}             
                            <div class="review-imput unloged">
                                <a href="#signInModal" data-toggle="modal" data-target="#signInModal">Login to leave a review</a>
                            </div>  
                        {/if}
                        <div id="review-list">

                        </div>
                        
                        
                    </div>
                </div>
                <div class="section" id="creators">
                    <div id="director">
                        <div class="section-title">Director</div>
                        <div class ="director-data">
                            {include file="castMember.tpl" nombre={$movie.director}}
                        </div>
                    </div>
                    <div id="cast">
                        <div class="section-title">Cast</div>   
                        <div class="castGroup">
                            {foreach from=$cast item=c}
                                {include file="castMember.tpl" nombre={$c.nombre}}
                            {/foreach}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>

{include file="signInModal.tpl"}
