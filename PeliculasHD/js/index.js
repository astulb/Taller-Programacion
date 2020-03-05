var genre = 1;
var pag = 1;
var texto = "test";

function cargar() {
    
    texto = $("#texto-buscador").val();
    
    $.ajax({
        url: "movies_paginadas.php",
        data: {
            genId: genre,
            pag: pag,
            busqueda: texto
        },
        dataType: "html"
    }).done(function (resp) {
        alert("error al cargar la pagina ASD");
        
        
        $("#movies").html(resp);
        
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
    
    $("#buscar").click(function() {
        alert("entro al click de buscar");
        pagina=1;
        cargar();
    });

    cargar();
});
