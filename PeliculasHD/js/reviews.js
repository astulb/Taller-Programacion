var genre = 1;
var pag = 1;
var texto = "test";

function cargar(movieId) {
    
    texto = $("#texto-buscador").val();
    genre = $("#genre-select").val();
    
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
            cargar();
        });
        
        $("#next").click(function () {
            pag++;
            cargar();
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
