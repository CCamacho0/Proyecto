$(function () { //Creación de los controles
    //agrega los eventos las capas necesarias
    $("#guardar").click(function () {
        addOrUpdateAviones();
    });
    //agrega los eventos las capas necesarias
    $("#cancelar").click(function () {
        cancelAction();
    });//agrega los eventos las capas necesarias

    $("#btMostarForm").click(function () {
        //muestra el formulario
        clearFormAviones();
        $("#typeAction").val("add_gestion_tipoavion");
        $("#myModalFormulario").modal();
    });

});

//cuando el documento esta cargado se procede a cargar la información
$(document).ready(function () {
    cargarTablas();

});

//Numero Random para el ID
function aleatorio(minimo,maximo){
    return Math.round(Math.random() * (maximo - minimo) + minimo);
}

//Agregar o modificar la información
function addOrUpdateAviones() {
    //Se envia la información por ajax
    if (validar()) {
        $.ajax({
            url: '../../Backend/Agenda/controller/gestion_tipoAvionController.php',
            data: {
                action: $("#typeAction").val(),
                idgestion_tipoavion: aleatorio(10000000, 99999999),
                anno: $("#txtAnno").val(),
                modelo: $("#txtModelo").val(),
                marca: $("#txtMarca").val(),
                cantidad_pasajeros: $("#txtCant_pasajeros").val(),
                cantidad_filas: $("#txtCant_filas").val(),
                cantidadasientos_fila: $("#Asientos_fila").val()

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
                    clearFormAviones();
                    $("#dt_GestionAviones").DataTable().ajax.reload();
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

//Valida cada uno de los campos del formulario
function validar() {
    var validacion = true;
    
    if ($("#txtAnno").val() === "") {
        validacion = false;
    }
    if ($("#txtModelo").val() === "") {
        validacion = false;
    }
    if ($("#txtMarca").val() === "") {
        validacion = false;
    }
    if ($("#txtCant_pasajeros").val() === "") {
        validacion = false;
    }
    if ($("#txtCant_filas").val() === "") {
        validacion = false;
    }
    if ($("#Asientos_fila").val() === "") {
        validacion = false;
    }
    return validacion;
}

//Limpiar los campos
function clearFormAviones() {
    $('#formAviones').trigger("reset");
}

//Botón cancelar, clearFormPersonas
function cancelAction() {
    //clean all fields of the form
    clearFormAviones();
    $("#typeAction").val("add_gestion_tipoavion");
    $("#myModalFormulario").modal("hide");
}

//*****************************************************************

function showAvionesByID(idgestion_tipoavion) {
    //Se envia la información por ajax
    $.ajax({
        url: '../../Backend/Agenda/controller/gestion_tipoAvionController.php',
        data: {
            action: "show_gestion_tipoavion",
            idgestion_tipoavion: idgestion_tipoavion
        },
        error: function () { //si existe un error en la respuesta del ajax
            swal("Error", "Se presento un error al consultar la informacion", "error");
        },
        success: function (data) { //si todo esta correcto en la respuesta del ajax, la respuesta queda en el data
            var objAvionesJSon = JSON.parse(data);
            
            $("#txtAnno").val(objAvionesJSon.anno);
            $("#txtModelo").val(objAvionesJSon.modelo);
            $("#txtMarca").val(objAvionesJSon.marca);
            $("#txtCant_pasajeros").val(objAvionesJSon.cantidad_pasajeros);
            $("#txtCant_filas").val(objAvionesJSon.cantidad_filas);
            $("#Asientos_fila").val(objAvionesJSon.cantidadasientos_fila);
            $("#typeAction").val("update_gestion_tipoavion");

            swal("Confirmacion", "Los datos del avion fueron cargados correctamente", "success");
        },
        type: 'POST'
    });
}

//Eliminar Aviones por ID

function deleteAvionesByID(idgestion_tipoAvion) {
    //Se envia la información por ajax
    $.ajax({
        url: '../../Backend/Agenda/controller/gestion_tipoAvionController.php',
        data: {
            action: "delete_gestion_tipoavion",
            idgestion_tipoAvion: idgestion_tipoAvion
        },
        error: function () { //si existe un error en la respuesta del ajax
            swal("Error", "Se presento un error al eliminar la informacion", "error");
        },
        success: function (data) { //si todo esta correcto en la respuesta del ajax, la respuesta queda en el data
            var responseText = data.trim().substring(2);
            var typeOfMessage = data.trim().substring(0, 2);
            if (typeOfMessage === "M~") { //si todo esta corecto
                swal("Confirmacion", responseText, "success");
                clearFormAviones();
                $("#dt_GestionAviones").DataTable().ajax.reload();
            } else {//existe un error
                swal("Error", responseText, "error");
            }
        },
        type: 'POST'
    });
}

//Metodo para cargar las tablas
function cargarTablas() {

    var dataTableAviones_const = function () {
        if ($("#dt_GestionAviones").length) {
            $("#dt_GestionAviones").DataTable({
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
                            var botones = '<button type="button" class="btn btn-default btn-xs" aria-label="Left Align" onclick="showAvionesByID(\'' + row[0] + '\');">Cargar</button> ';
                            botones += '<button type="button" class="btn btn-default btn-xs" aria-label="Left Align" onclick="deleteAvionesByID(\'' + row[0] + '\');">Eliminar</button>';
                            return botones;
                        }
                    }

                ],
                pageLength: 10,
                language: dt_lenguaje_espanol,
                ajax: {
                    url: '../../Backend/Agenda/controller/gestion_tipoAvionController.php',
                    type: "POST",
                    data: function (d) {
                        return $.extend({}, d, {
                            action: "showAll_gestion_tipoavion"
                        });
                    }
                },
                drawCallback: function (nRow, aData, iDisplayIndex, iDisplayIndexFull) {
                    $('#dt_GestionAviones').DataTable().columns.adjust().responsive.recalc();
                }
            });
        }
    };

    TableManageButtons = function () {
        "use strict";
        return {
            init: function () {
                dataTableAviones_const();
                $(".dataTables_filter input").addClass("form-control input-rounded ml-sm");
            }
        };
    }();

    TableManageButtons.init();
}

//Evento que reajusta la tabla en el tamaño de la pantalla
window.onresize = function () {
    $('#dt_GestionAviones').DataTable().columns.adjust().responsive.recalc();
};