<div class="review">
    <div class="review-data">
        <div class="user-review-data">
            <span class="user">{$review.alias}</span>
        </div>
        <div class="review-score">
            Score: {$review.puntuacion}/10
        </div>
    </div>
    <p>{$review.mensaje}</p>
    <div class="review-options">
        <button class="btn btn-primary ml-auto">Accept</button>
        <button class="btn btn-secondary ml-auto">Deny</button>
    </div>
</div>