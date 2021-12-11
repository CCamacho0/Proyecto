$(function () { //Creación de los controles
    //agrega los eventos las capas necesarias
    $("#guardar").click(function () {
        addOrUpdateRutas();
    });
    //agrega los eventos las capas necesarias
    $("#cancelar").click(function () {
        cancelAction();
    });//agrega los eventos las capas necesarias

    $("#btMostarForm").click(function () {
        //muestra el formulario
        clearFormRutas();
        $("#typeAction").val("add_gestion_rutas");
        $("#myModalFormulario").modal();
    });

    $("#Cargar").click(function () {
        calFecha();
    });

});

//cuando el documento esta cargado se procede a cargar la información
$(document).ready(function () {
    cargarTablas();

});

//Numero Random para el ID
function aleatorio(minimo, maximo) {
    return Math.round(Math.random() * (maximo - minimo) + minimo);
}

function Fecha() {
    var fecha = $("#fecha").val();
    fecha = fecha.replace('T', ' ');
    return fecha;
}

function calFecha() {
    var FechaS = new Date(Fecha());
    var duracion = $("#duracion").val();
    duracion = duracion.split(":");
    duracion[0] = duracion[0] - 6;
    FechaS.setHours(FechaS.getHours() + duracion[0]);
    FechaS.setMinutes(FechaS.getMinutes() + parseInt(duracion[1]));

    FechaS = FechaS.toJSON();
    FechaS = FechaS.split("T");
    var Horas = FechaS[1].split(":");
    var FechaE = FechaS[0] + " " + Horas[0] + ":" + Horas[1];
    $("#fechaEntrada").val(FechaE);
}

//Agregar o modificar la información
function addOrUpdateRutas() {
    //Se envia la información por ajax
    if (validar()) {
        var ruta = $("#origin-input").val() + "-" + $("#destination-input").val();

        var IdRuta = Math.round(Math.random() * (99999999 - 10000000) + 10000000);
        var IdVuelo = Math.round(Math.random() * (99999999 - 10000000) + 10000000);
        var descuento;
        if ($("#Descuento").val() === "") {
            descuento = 0;
        } else {
            descuento = $("#Descuento").val();
        }
        $.ajax({
            url: '../../Backend/Agenda/controller/gestion_rutasController.php',
            data: {
                action: $("#typeAction").val(),
                PK_IdRutas: IdRuta,
                ruta: ruta,
                duracion: $("#duracion").val() + ":00",
                FechaSalida: Fecha(),
                FechaEntrada: $("#fechaEntrada").val(),
                Precio: $("#precio").val(),
                Promocion: descuento,
                FK_tipoAvion: $("#Avion").val()
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
                    clearFormRutas();
                    $("#dt_GestionRutas").DataTable().ajax.reload();
                } else {//existe un error
                    swal("Error", responseText, "error");
                }
            },
            type: 'POST'
        });
        
        $.ajax({
            url: '../../Backend/Agenda/controller/gestionVueloController.php',
            data: {
                action: "add_gestionVuelo",
                idgestionVuelo: IdVuelo,
                FK_IdRutas: IdRuta,
                FK_tipoAvion: $("#Avion").val()
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
                    clearFormRutas();
                    $("#dt_GestionRutas").DataTable().ajax.reload();
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

    if ($("#origin-input").val() === "") {
        validacion = false;
    }
    if ($("#destination-input").val() === "") {
        validacion = false;
    }
    if ($("#duracion").val() === "") {
        validacion = false;
    }
    if ($("#fecha").val() === "") {
        validacion = false;
    }
    if ($("#precio").val() === "") {
        validacion = false;
    }
    if ($("#Avion").val() === "") {
        validacion = false;
    }

    if ($("#fechaEntrada").val() === "") {
        validacion = false;
    }

    return validacion;
}

//Limpiar los campos
function clearFormRutas() {
    $('#formRutas').trigger("reset");
}

//Botón cancelar, clearFormPersonas
function cancelAction() {
    //clean all fields of the form
    clearFormRutas();
    $("#typeAction").val("add_gestion_rutas");
    $("#myModalFormulario").modal("hide");
}

//*****************************************************************

function showRutasByID(PK_IdRutas) {
    //Se envia la información por ajax
    $.ajax({
        url: '../../Backend/Agenda/controller/gestion_rutasController.php',
        data: {
            action: "show_gestion_rutas",
            PK_IdRutas: PK_IdRutas
        },
        error: function () { //si existe un error en la respuesta del ajax
            swal("Error", "Se presento un error al consultar la informacion", "error");
        },
        success: function (data) { //si todo esta correcto en la respuesta del ajax, la respuesta queda en el data
            var objRutasJSon = JSON.parse(data);

            var Cadena = objRutasJSon.ruta;
            var CadenaDiv = Cadena.split("-");
            $("#origin-input").val(CadenaDiv[0]);
            $("#destination-input").val(CadenaDiv[1]);

            $("#duracion").val(objRutasJSon.duracion);

            var fecha = objRutasJSon.FechaSalida;
            fecha = fecha.replace(' ', 'T');
            $("#fecha").val(fecha);
            $("#fechaEntrada").val(FechaEntrada);
            $("#precio").val(Precio);
            $("#Avion").val(FK_tipoAvion);
            $("#typeAction").val("update_gestion_rutas");

            swal("Confirmacion", "Los datos de la persona fueron cargados correctamente", "success");
        },
        type: 'POST'
    });
}

//Eliminar Aviones por ID

function deleteRutasByID(PK_IdRutas) {
    //Se envia la información por ajax
    $.ajax({
        url: '../../Backend/Agenda/controller/gestion_rutasController.php',
        data: {
            action: "delete_gestion_rutas",
            PK_IdRutas: PK_IdRutas
        },
        error: function () { //si existe un error en la respuesta del ajax
            swal("Error", "Se presento un error al eliminar la informacion", "error");
        },
        success: function (data) { //si todo esta correcto en la respuesta del ajax, la respuesta queda en el data
            var responseText = data.trim().substring(2);
            var typeOfMessage = data.trim().substring(0, 2);
            if (typeOfMessage === "M~") { //si todo esta corecto
                swal("Confirmacion", responseText, "success");
                clearFormRutas();
                $("#dt_GestionRutas").DataTable().ajax.reload();
            } else {//existe un error
                swal("Error", responseText, "error");
            }
        },
        type: 'POST'
    });
}

//Metodo para cargar las tablas
function cargarTablas() {

    var dataTableRutas_const = function () {
        if ($("#dt_GestionRutas").length) {
            $("#dt_GestionRutas").DataTable({
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
                        targets: 3,
                        className: "dt-center",
                        render: function (data, type, row, meta) {
                            var botones = '<button type="button" class="btn btn-default btn-xs" aria-label="Left Align" onclick="showRutasByID(\'' + row[0] + '\');">Cargar</button> ';
                            botones += '<button type="button" class="btn btn-default btn-xs" aria-label="Left Align" onclick="deleteRutasByID(\'' + row[0] + '\');">Eliminar</button>';
                            return botones;
                        }
                    }

                ],
                pageLength: 10,
                language: dt_lenguaje_espanol,
                ajax: {
                    url: '../../Backend/Agenda/controller/gestion_rutasController.php',
                    type: "POST",
                    data: function (d) {
                        return $.extend({}, d, {
                            action: "showAll_gestion_rutas"
                        });
                    }
                },
                drawCallback: function (nRow, aData, iDisplayIndex, iDisplayIndexFull) {
                    $('#dt_GestionRutas').DataTable().columns.adjust().responsive.recalc();
                }
            });
        }
    };

    TableManageButtons = function () {
        "use strict";
        return {
            init: function () {
                dataTableRutas_const();
                $(".dataTables_filter input").addClass("form-control input-rounded ml-sm");
            }
        };
    }();

    TableManageButtons.init();
}

//Evento que reajusta la tabla en el tamaño de la pantalla
window.onresize = function () {
    $('#dt_GestionRutas').DataTable().columns.adjust().responsive.recalc();
};