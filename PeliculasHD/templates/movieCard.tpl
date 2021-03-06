<div class="movie">
    <div class="stretchy-wrapper">
        <div>
            <a class="movie-poster" href="movie.php?id={$movie.id}">
                <img  src="img/posters/{$movie.id}"/>
            </a>
        </div>
    </div>
    <div class="movie-data">
        <a class="movie-title" href="movie.php?id={$movie.id}">
            <span class="nombre-producto">{$movie.titulo}</span>
        </a>
        <div class="extra-data"> 
            <span class="genre">{$movie.nombre}</span>
            <span class="year">({$movie.fecha_lanzamiento})</span>
            <div class="rating">{$movie.puntuacion}</div>
        </div>
    </div>
</div> 