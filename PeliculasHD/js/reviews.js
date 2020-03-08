var pag = 1;

function cargar(movieId) {
    
    console.log(movieId);
    console.log(pag);
    
    $.ajax({
        url: "reviews_paginados.php",
        data: {
            pag: pag,
            movieId: movieId
        },
        dataType: "html"
    }).done(function (resp) {
        
        $("#review-list").html(resp);
        
        $("#previous").click(function () {
            pag--;
            cargar(movieId);
        });
        
        $("#next").click(function () {
            pag++;
            cargar(movieId);
        });

    }).fail(function () {
        alert("error al cargar la pagina");
    });
    
}

$(document).ready(function () {
    
    const queryString = window.location.search;
    const urlParams = new URLSearchParams(queryString);

    const movieId = urlParams.get('id')
    cargar(movieId);
    
});
