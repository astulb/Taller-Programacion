var categoria = 1;
var pagina = 1;
var texto = "";

function cargar() {

    texto = $("#texto").val();
       
    $.ajax({
        url: "movies_paginadas.php",
        data: {
            genId: categoria,
            pag: pagina,
            busqueda: texto
        },
        dataType: "html"
    }).done(function (resp) {
        $("#productos").html(resp);

        $("#anterior").click(function () {
            pagina--;
            cargar();
        });

        $("#siguiente").click(function () {
            pagina++;
            cargar();
        });

    }).fail(function () {
        alert("error al cargar la pagina");
    });
}

$(document).ready(function () {

    $(".categoria").click(function () {
        categoria = $(this).attr("catId");
        pagina = 1;
        cargar();
    });
    
    $("#buscar").click(function() {
        pagina=1;
        cargar();
    });
    
    cargar();
});
