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
            pagina--;
            cargar();
        });
        
        $("#next").click(function () {
            pagina++;
            cargar();
        });

    }).fail(function () {
        alert("error al cargar la pagina");
    });
    
}

$(document).ready(function () {

    $(".categoria").click(function () {
        alert("entro al click de categoria");
        categoria = $(this).attr("catId");
        pagina = 1;
        cargar();
    });
    
    $("#searchButton").click(function() {
        pag=1;
        cargar();
    });

    cargar();
});
