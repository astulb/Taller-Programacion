<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Star Wars</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
              integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <link rel="stylesheet" href="css/bs4Override.css">
        <link rel="stylesheet" href="css/movieStyle.css">
        
        <meta charset="utf-8">
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    </head>
    
    <body>
        {include file="navbar.tpl"}
        <div id="background-image" ><img src="img/backgroundImg.jpg"></div>    
        <div id="background-overlay"></div>
            
        <div class="main-content">
            <div id="movies">
                <div class="movie-poster">
                    <img  src="img/posters/star wars III"/>
                </div>
                <div class="movie-data">
                    <div class="movie-title">
                        <span class="nombre-producto">Star Wars </span>
                    </div>
                    
                    <div class="extra-data"> 
                        <div class="genre">Si-Fi (1990)</div>
                        <div class="rating">Score: 8/10</div>
                    </div>
                        
                    <div class="synopsis">
                        <h3>Synopsis</h3>
                        <p>
                            Anakin joins forces with Obi-Wan and sets Palpatine free from the evil clutches of Count Doku. 
                            However, he falls prey to Palpatine and the Jedis' mind games and gives into temptation.
                        </p>                
                    </div>
                </div>
                <div class="section" id="trailer">
                    <div class="section-title">Trailer</div>
                    <div>
                        <iframe width="560" height="315" 
                                src="https://www.youtube.com/embed/eSIA5mOjZLQ" 
                                frameborder="0" 
                                allow="accelerometer; 
                                encrypted-media; 
                                gyroscope; 
                                picture-in-picture" 
                                allowfullscreen>                                   
                        </iframe>
                    </div>
                </div>
                <div class="section" id="comments"> 
                    <div class="section-title">Reviews</div>
                    <div id="movie-reviews">
                        {include file="review.tpl"}
                        {include file="review.tpl"}
                           
                        <!--REVIEW USUARIO LOGEADO-->
                        {if (isset($usuarioLogueado))}
                            <div class="review-imput">
                                <form>                              
                                    <div class="form-group">
                                        <span class="review-box-title">Leave a review!</span>
                                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" placeholder="Write your comment here…"></textarea>
                                    </div>
                                    <div class="form-inline">
                                        <div class="form-group">
                                            <span class="review-box-text">Score: </span>
                                            <select class="form-control" id="exampleFormControlSelect1">
                                                {for $score=1 to 10}
                                                    <option>{$score}</option>
                                                {/for}
                                            </select>
                                        </div>
                                        <button type="submit" class="btn btn-primary ml-auto">Sign in</button>
                                    </div>
                                </form>
                            </div>
                        <!--REVIEW USUARIO LOGEADO-->
                        {else}             
                            <div class="review-imput unloged">
                                <a href="#signInModal" data-toggle="modal" data-target="#signInModal">Login to leave a review</a>
                            </div>  
                        {/if}
                    </div>
                </div>
                <div class="section" id="creators">
                    <div id="director">
                        <div class="section-title">Director</div>
                        <div class ="director-data">
                            {include file="castMember.tpl"}
                        </div>
                    </div>
                    <div id="cast">
                        <div class="section-title">Cast</div>
                        <div class="castGroup">
                            {include file="castMember.tpl"}
                            {include file="castMember.tpl"}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
