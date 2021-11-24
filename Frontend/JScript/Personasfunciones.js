//*******************************
//Inyección de eventos en el HTML
//*******************************


$(function () { //Creación de los controles
    //agrega los eventos las capas necesarias
    $("#guardar").click(function () {
        addOrUpdatePersonas();
    });
    //agrega los eventos las capas necesarias
    $("#cancelar").click(function () {
        cancelAction();
    });//agrega los eventos las capas necesarias

    $("#btMostarForm").click(function () {
        //muestra el formulario
        clearFormPersonas();
        $("#typeAction").val("add_personas");
        $("#myModalFormulario").modal();
    });
        
});

//*********************************************************************
//cuando el documento esta cargado se procede a cargar la información
//*********************************************************************

$(document).ready(function () {
    cargarTablas();
    
});

//*********************************************************************
//Agregar o modificar la información
//*********************************************************************

function addOrUpdatePersonas() {
    //Se envia la información por ajax
    if (validar()) {
        $.ajax({
            url: '../Backend/Agenda/controller/PersonasController.php',
            data: {
                action:         $("#typeAction").val(),
                PK_cedula:      $("#txtPK_cedula").val(),
                nombre:         $("#txtnombre").val(),
                apellido1:      $("#txtapellido1").val(),
                apellido2:      $("#txtapellido2").val(),
                fecNacimiento:  $("#txtfecNacimiento").val(),
                sexo:           $("#txtsexo").val(),
                tipoUsuario:    $("#txttipoUsuario").val(),
                nombreUsuario:  $("#txtnombreUsuario").val(),
                contrasena:     $("#txtcontrasena").val(),
                correo:         $("#txtcorreo").val(),
                celular:        $("#txtcelular").val(),
                direccion:      $("#txtdireccion").val()
                
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
                    $("#dt_personas").DataTable().ajax.reload();
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
        validacion = true;
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
    
    if ($("#txtdireccion").val() === "") {
        validacion = false;
    }

    return validacion;
}

//Limpiar los campos

function clearFormPersonas() {
    $('#formPersonas').trigger("reset");
}

//Botón cancelar, clearFormPersonas
function cancelAction() {
    //clean all fields of the form
    clearFormPersonas();
    $("#typeAction").val("add_personas");
    $("#myModalFormulario").modal("hide");
}

//*****************************************************************

function showPersonasByID(PK_cedula) {
    //Se envia la información por ajax
    $.ajax({
        url: '../Backend/Agenda/controller/PersonasController.php',
        data: {
            action: "show_personas",
            PK_cedula: PK_cedula
        },
        error: function () { //si existe un error en la respuesta del ajax
            swal("Error", "Se presento un error al consultar la informacion", "error");
        },
        success: function (data) { //si todo esta correcto en la respuesta del ajax, la respuesta queda en el data
            var objPersonasJSon = JSON.parse(data);
            $("#txtPK_cedula").val(objPersonasJSon.PK_cedula);
            $("#txtnombre").val(objPersonasJSon.nombre);
            $("#txtapellido1").val(objPersonasJSon.apellido1);
            $("#txtapellido2").val(objPersonasJSon.apellido2);
            $("#txtfecNacimiento").val(objPersonasJSon.fecNacimiento);
            $("#txtsexo").val(objPersonasJSon.sexo);
            $("#txttipoUsuario").val(objPersonasJSon.tipoUsuario);
            $("#txtnombreUsuario").val(objPersonasJSon.nombreUsuario);
            $("#txtcontrasena").val(objPersonasJSon.contrasena);
            $("#txtcorreo").val(objPersonasJSon.correo);
            $("#txtcelular").val(objPersonasJSon.celular);
            $("#txtdireccion").val(objPersonasJSon.direccion);
            $("#typeAction").val("update_personas");
            
            swal("Confirmacion", "Los datos de la persona fueron cargados correctamente", "success");
        },
        type: 'POST'
    });
}

//Eliminar personas por ID

function deletePersonasByID(PK_cedula) {
    //Se envia la información por ajax
    $.ajax({
        url: '../Backend/Agenda/controller/PersonasController.php',
        data: {
            action: "delete_personas",
            PK_cedula: PK_cedula
        },
        error: function () { //si existe un error en la respuesta del ajax
            swal("Error", "Se presento un error al eliminar la informacion", "error");
        },
        success: function (data) { //si todo esta correcto en la respuesta del ajax, la respuesta queda en el data
            var responseText = data.trim().substring(2);
            var typeOfMessage = data.trim().substring(0, 2);
            if (typeOfMessage === "M~") { //si todo esta corecto
                swal("Confirmacion", responseText, "success");
                clearFormPersonas();
                $("#dt_personas").DataTable().ajax.reload();
            } else {//existe un error
                swal("Error", responseText, "error");
            }
        },
        type: 'POST'
    });
}


//Metodo para cargar las tablas


function cargarTablas() {



    var dataTablePersonas_const = function () {
        if ($("#dt_personas").length) {
            $("#dt_personas").DataTable({
                dom: "Bfrtip",
                bFilter: false,
                ordering: false,
                buttons: [
                    {
                        extend: "copy",
                        className: "btn-sm",
                        text: "Copiar"
                    },
                    {
                        extend: "csv",
                        className: "btn-sm",
                        text: "Exportar a CSV"
                    },
                    {
                        extend: "print",
                        className: "btn-sm",
                        text: "Imprimir"
                    }

                ],
                "columnDefs": [
                    {
                        targets: 6,
                        className: "dt-center",
                        render: function (data, type, row, meta) {
                            var botones = '<button type="button" class="btn btn-default btn-xs" aria-label="Left Align" onclick="showPersonasByID(\''+row[0]+'\');">Cargar</button> ';
                            botones += '<button type="button" class="btn btn-default btn-xs" aria-label="Left Align" onclick="deletePersonasByID(\''+row[0]+'\');">Eliminar</button>';
                            return botones;
                        }
                    }

                ],
                pageLength: 2,
                language: dt_lenguaje_espanol,
                ajax: {
                    url: '../Backend/Agenda/controller/PersonasController.php',
                    type: "POST",
                    data: function (d) {
                        return $.extend({}, d, {
                            action: "showAll_personas"
                        });
                    }
                },
                drawCallback: function (nRow, aData, iDisplayIndex, iDisplayIndexFull) {
                    $('#dt_personas').DataTable().columns.adjust().responsive.recalc();
                }
            });
        }
    };

    TableManageButtons = function () {
        "use strict";
        return {
            init: function () {
                dataTablePersonas_const();
                $(".dataTables_filter input").addClass("form-control input-rounded ml-sm");
            }
        };
    }();

    TableManageButtons.init();

}


//Evento que reajusta la tabla en el tamaño de la pantalla

window.onresize = function () {
    $('#dt_personas').DataTable().columns.adjust().responsive.recalc();
};