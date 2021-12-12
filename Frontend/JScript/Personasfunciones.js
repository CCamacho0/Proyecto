
$(function () { //Creación de los controles
    //agrega los eventos las capas necesarias
    $("#guardar").click(function () {
        addOrUpdatePersonas();
    });
    //agrega los eventos las capas necesarias
    $("#cancelar").click(function () {
        cancelAction();
    });//agrega los eventos las capas necesarias      
});

//Agregar o modificar la información
//*********************************************************************

function addOrUpdatePersonas() {
    //Se envia la información por ajax
    if (validar()) {
        $.ajax({
            url: '../../Backend/Agenda/controller/PersonasController.php',
            data: {
                action:         $("#typeAction").val(),
                PK_cedula:      $("#txtPK_cedula").val(),
                nombre:         $("#txtnombre").val(),
                apellido1:      $("#txtapellido1").val(),
                apellido2:      $("#txtapellido2").val(),
                fecNacimiento:  $("#txtfecNacimiento").val(),
                sexo:           $("#txtsexo").val(),
                celular:        $("#txtcelular").val(),
                correo:         $("#txtcorreo").val(),
                direccion:      $("#pac-input").val(),
                nombreUsuario:  $("#txtnombreUsuario").val(),
                contrasena:     $("#txtcontrasena").val(),
                tipoUsuario:    $("#txttipoUsuario").val()
                
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
                    clearFormPersonas();
                } else {//existe un error
                    swal("Error", responseText, "error");
                }
            },
            type: 'POST'
        });
    }else{
        swal("Error de validación", "Los datos del formulario no fueron digitados, por favor verificar", "error");
    }
}

//Validación
function validar() {
    var validacion = true;

    
    //valida cada uno de los campos del formulario
    //Nota: Solo si fueron digitados
    if ($("#txtPK_cedula").val() === "") {
        validacion = false;
    }

    if ($("#txtnombre").val() === "") {
        validacion = false;
    }

    if ($("#txtapellido1").val() === "") {
        validacion = false;
    }

    if ($("#txtapellido2").val() === "") {
        validacion = false;
    }

    if ($("#txtfecNacimiento").val() === "") {
        validacion = false;
    }

    if ($("#txtsexo").val() === "") {
        validacion = false;
    }
    
    if ($("#txttipoUsuario").val() === "") {
        validacion = false;
    }
    
    if ($("#txtnombreUsuario").val() === "") {
        validacion = false;
    }
    
    if ($("#txtcontrasena").val() === "") {
        validacion = false;
    }
    
    if ($("#txtcorreo").val() === "") {
        validacion = false;
    }
    
    if ($("#txtcelular").val() === "") {
        validacion = false;
    }
    
    if ($("#pac-input").val() === "") {
        validacion = false;
    }

    return validacion;
}

//Botón cancelar, clearFormPersonas
function cancelAction() {
    //clean all fields of the form
    $("#typeAction").val("add_personas");
    $("#myModalFormulario").modal("hide");
    //devolvar al menu pirncipal
}