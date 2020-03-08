<div class="review">
    <div class="review-data">
        <div class="user-review-data">
            <span class="user">{$review.alias}</span>
        </div>
        <div class="review-score">
            Score: {$review.puntuacion}/5
        </div>
    </div>
    <p>{$review.mensaje}</p>
    <div class="review-options">
        <a class="btn btn-primary ml-auto" href="doAcceptReview.php?idR={$review.id}&idP={$review.id_pelicula}">Accept</a>
        <a class="btn btn-secondary ml-auto" href="doDenyReview.php?id={$review.id}">Deny</a>
    </div>
</div>