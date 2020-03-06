var genre = 1;
var pag = 1;
var texto = "test";

function cargar() {
    
    texto = $("#texto-buscador").val();
    genre = $("#genre-select").val();
    
    $.ajax({
        url: "movies_paginadas.php",
        data: {
            genId: genre,
            pag: pag,
            busqueda: texto
        },
        dataType: "html"
    }).done(function (resp) {
        
        $("#main-content").html(resp);
        
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
    
    $("#searchButton").click(function() {
        pag=1;
        cargar();
    });

    cargar();
});
