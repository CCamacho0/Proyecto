$(function () { //Creación de los controles
    //agrega los eventos las capas necesarias
    $("#guardar").click(function () {
        Iniciar();
    });
});

$(document).ready(function () {
    SesionIniciada();
});

function Iniciar() {
    //Se envia la información por ajax
    $.ajax({
        url: '../../Backend/Agenda/controller/PersonasController.php',
        data: {
            action: $("#typeAction").val(),
            correo: $("#Correo").val(),
            contrasena: $("#Contra").val()
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
                window.location.replace("../MenuPrincipal.html");
            }
        },
        type: 'POST'
    });
}

function SesionIniciada(){
    $.ajax({
        url: '../../Backend/Agenda/controller/PersonasController.php',
        data: {
            action: "Verificar",
        },
        error: function () { //si existe un error en la respuesta del ajax
            swal("Error", "Se presento un error al enviar la informacion", "error");
        },
        success: function (data) { //si todo esta correcto en la respuesta del ajax, la respuesta queda en el data
            var messageComplete = data.trim();
            var responseText = messageComplete.substring(2);
            var typeOfMessage = messageComplete.substring(0, 2);
            if (typeOfMessage === "E~") {
                window.location.replace("../MenuPrincipal.html");
            }
        },
        type: 'POST'
    });
}



