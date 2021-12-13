
$(function () { //Creación de los controles
    //agrega los eventos las capas necesarias
    $("#guardar").click(function () {
        addOrUpdatePersonas();
    });

    $("#editar").click(function () {
        document.getElementById('Cedula').disabled = false;
        document.getElementById('nombre').disabled = false;
        document.getElementById('apellido').disabled = false;
        document.getElementById('apellido2').disabled = false;
        document.getElementById('fecha').disabled = false;
        document.getElementById('Sexo').disabled = false;
        document.getElementById('celular').disabled = false;
        document.getElementById('correo').disabled = false;
        document.getElementById('direccion').disabled = false;
        document.getElementById('NombreUsuario').disabled = false;
        document.getElementById('contra').disabled = false;
        document.getElementById('cancelar').disabled = false;
        document.getElementById('guardar').disabled = false;

    });

    $("#cancelar").click(function () {
        document.getElementById('Cedula').disabled = true;
        document.getElementById('nombre').disabled = true;
        document.getElementById('apellido').disabled = true;
        document.getElementById('apellido2').disabled = true;
        document.getElementById('fecha').disabled = true;
        document.getElementById('Sexo').disabled = true;
        document.getElementById('celular').disabled = true;
        document.getElementById('correo').disabled = true;
        document.getElementById('direccion').disabled = true;
        document.getElementById('NombreUsuario').disabled = true;
        document.getElementById('contra').disabled = true;
        document.getElementById('cancelar').disabled = true;
        document.getElementById('guardar').disabled = true;

    });

});


$(document).ready(function () {
    showUsuarioByID();
});
//Valida cada uno de los campos del formulario
function validar() {
    var validacion = true;

    if ($("#Cedula").val() === "") {
        validacion = false;
    }

    if ($("#nombre").val() === "") {
        validacion = false;
    }

    if ($("#apellido1").val() === "") {
        validacion = false;
    }

    if ($("#apellido2").val() === "") {
        validacion = false;
    }

    if ($("#fecha").val() === "") {
        validacion = false;
    }

    if ($("#Sexo").val() === "") {
        validacion = false;
    }

    if ($("#celular").val() === "") {
        validacion = false;
    }

    if ($("#correo").val() === "") {
        validacion = false;
    }

    if ($("#direccion").val() === "") {
        validacion = false;
    }

    if ($("#NombreUsuario").val() === "") {
        validacion = false;
    }

    if ($("#contra").val() === "") {
        validacion = false;
    }

    return validacion;
}

function addOrUpdatePersonas() {
    //Se envia la información por ajax
    if (validar()) {
        $.ajax({
            url: '../../Backend/Agenda/controller/PersonasController.php',
            data: {
                action: "update_personas",
                PK_cedula: $("#Cedula").val(),
                nombre: $("#nombre").val(),
                apellido1: $("#apellido").val(),
                apellido2: $("#apellido2").val(),
                fecNacimiento: $("#fecha").val(),
                sexo: $("#Sexo").val(),
                celular: $("#celular").val(),
                correo: $("#correo").val(),
                direccion: $("#direccion").val(),
                nombreUsuario: $("#NombreUsuario").val(),
                contrasena: $("#contra").val(),
                tipoUsuario: $("#Usuariotipo").val()

            },
            error: function () { //si existe un error en la respuesta del ajax
                swal("Error", "Se presento un error al enviar la informacion", "error");
            },
            success: function (data) { //si todo esta correcto en la respuesta del ajax, la respuesta queda en el data
                var messageComplete = data.trim();
                var responseText = messageComplete.substring(2);
                var typeOfMessage = messageComplete.substring(0, 2);
                if (typeOfMessage === "M~") { //si todo esta corecto
                    swal("Confirmacion", responseText, "success");
                } else {//existe un error
                    swal("Error", responseText, "error");
                }
            },
            type: 'POST'
        });
    } else {
        swal("Error de validación", "Los datos del formulario no fueron digitados, por favor verificar", "error");
    }
}

function showUsuarioByID() {
    //Se envia la información por ajax
    $.ajax({
        url: '../../Backend/Agenda/controller/PersonasController.php',
        data: {
            action: "show_personas",
        },
        error: function () { //si existe un error en la respuesta del ajax
            swal("Error", "Se presento un error al consultar la informacion", "error");
        },
        success: function (data) { //si todo esta correcto en la respuesta del ajax, la respuesta queda en el data
            var objAvionesJSon = JSON.parse(data);

            $("#nombre").val(objAvionesJSon.nombre);
            $("#apellido").val(objAvionesJSon.apellido1);
            $("#apellido2").val(objAvionesJSon.apellido2);
            $("#correo").val(objAvionesJSon.correo);
            $("#fecha").val(objAvionesJSon.fecNacimiento);
            $("#direccion").val(objAvionesJSon.direccion);
            $("#NombreUsuario").val(objAvionesJSon.nombreUsuario);
            $("#Cedula").val(objAvionesJSon.PK_cedula);
            $("#celular").val(objAvionesJSon.celular);
            $("#contra").val(objAvionesJSon.contrasena);
            $("#Usuariotipo").val(objAvionesJSon.tipoUsuario);
            $("#Sexo").val(objAvionesJSon.sexo);
            $("#typeAction").val("update_gestion_tipoavion");
        },
        type: 'POST'
    });
}