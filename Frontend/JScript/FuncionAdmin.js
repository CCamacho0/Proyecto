
$(function () { //Creación de los controles
    //agrega los eventos las capas necesarias
    $("#CerrarSesion").click(function () {
        CerrarSesion();
    });
});

$(document).ready(function () {
    cargarInfoUser();

});

function CerrarSesion() {
    $.ajax({
        url: '../../Backend/Agenda/controller/PersonasController.php',
        data: {
            action: "Destruir",
        },
        error: function () { //si existe un error en la respuesta del ajax
            swal("Error", "Se presento un error al enviar la informacion", "error");
        },
        success: function (data) { //si todo esta correcto en la respuesta del ajax, la respuesta queda en el data
            var messageComplete = data.trim();
            var responseText = messageComplete.substring(2);
            var typeOfMessage = messageComplete.substring(0, 2);
            if (typeOfMessage === "E~") {
                swal("Error", responseText, "error");

            } else {
                window.location.replace("../PnUsuario/inicio_sesion.html");
            }
        },
        type: 'POST'
    });

}


