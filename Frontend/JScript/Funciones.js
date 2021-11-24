
$(function () {
    $("#fecha").datepicker(
            {
                dateFormat: "yy/mm/dd"
            }
    );
});

$(document).ready(function(e){
    $("#TipoAviones").on("click", function(){
        $('#content').load('../TipoAviones.html');
    });
    
    $("#Rutas").on("click", function(){
        $('#content').load('../Rutas.html');
    });
    $("#GestionHorarios").on("click", function(){
        $('#content').load('../GestionHorarios.html');
    });
    
});
    