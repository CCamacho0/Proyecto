$(function () {

    $("#guardar").click(function () {//Termina el pago
        addFactura();
    });

    $("#cambioColon").click(function () {//Termina el pago
        consultarTipoCambio(true);
    });
    $("#cambioDolar").click(function () {//Termina el pago
        consultarTipoCambio(false);
    });
});

$(document).ready(function () {
    cargarTablas();
});

function GenerarID() {
    var IdRuta = Math.round(Math.random() * (99999999 - 10000000) + 10000000);
    $("#idFactura").val(IdRuta);
}

function showBoleto(PK_IdRutas) {//Mostrar Info del vuelo 
    CalPrecio();
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
            $("#IdRuta").val(objRutasJSon.PK_IdRutas);
            $("#Ruta").val(objRutasJSon.ruta);
            $("#Duracion").val(objRutasJSon.duracion);
            $("#Fecha1").val(objRutasJSon.FechaSalida);
            $("#Fecha2").val(objRutasJSon.FechaEntrada);
            $("#Precio").val(objRutasJSon.Precio);
        },
        type: 'POST'
    });

}

function showBoleto2(PK_IdRutas) {
    CalPrecio();
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
            $("#IdRutaR").val(objRutasJSon.PK_IdRutas);
            $("#RutaR").val(objRutasJSon.ruta);
            $("#DuracionR").val(objRutasJSon.duracion);
            $("#Fecha1R").val(objRutasJSon.FechaSalida);
            $("#Fecha2R").val(objRutasJSon.FechaEntrada);
            $("#PrecioR").val(objRutasJSon.Precio);
        },
        type: 'POST'
    });

}

function addFactura() {
    //Se envia la información por ajax
    for (var i = 0; i < $("#cantidadAsientos").val(); i++) {
        if (validarCompra()) {
            if (document.getElementById("AAAAAA").hidden === false) {
                GenerarID();
                $.ajax({
                    url: '../../Backend/Agenda/controller/FacturaController.php',
                    data: {
                        action: "add_Factura",
                        idFactura: $("#idFactura").val(),
                        CantidadAsientos: 1,
                        FK_IdRutas: $("#IdRutaR").val()
                    },

                    error: function () { //si existe un error en la respuesta del ajax
                        swal("Error", "Se presento un error al enviar la informacion  Ida vuelta", "error");
                    },

                    success: function (data) { //si todo esta correcto en la respuesta del ajax, la respuesta queda en el data
                        var messageComplete = data.trim();
                        var responseText = messageComplete.substring(2);
                        var typeOfMessage = messageComplete.substring(0, 2);
                        if (typeOfMessage === "M~") { //si todo esta corecto
                            swal("Confirmacion", responseText, "success");
                        } else {//existe un error
                            swal("Error", "Para realizar una compra debe inicar sesion", "error");
                        }
                    },
                    type: 'POST'
                });
            }
            GenerarID();
            $.ajax({
                url: '../../Backend/Agenda/controller/FacturaController.php',
                data: {
                    action: "add_Factura",
                    idFactura: $("#idFactura").val(),
                    CantidadAsientos: 1,
                    FK_IdRutas: $("#IdRuta").val()
                },

                error: function () { //si existe un error en la respuesta del ajax
                    swal("Error", "Se presento un error al enviar la informacion Ida", "error");
                },

                success: function (data) { //si todo esta correcto en la respuesta del ajax, la respuesta queda en el data
                    var messageComplete = data.trim();
                    var responseText = messageComplete.substring(2);
                    var typeOfMessage = messageComplete.substring(0, 2);
                    if (typeOfMessage === "M~") { //si todo esta corecto
                        swal("Confirmacion", responseText, "success");
                    } else {//existe un error
                        swal("Error", "Para realizar una compra debe inicar sesion", "error");
                    }
                },
                type: 'POST'
            });
        } else {
            swal("Error de validación", "Los datos del formulario no fueron digitados, por favor verificar", "error");
        }
    }

}

function validarCompra() {

    var validacion = true;

    if ($("#NombreTarjeta").val() === "") {
        validacion = false;
    }
    if ($("#NumeroTarjeta").val() === "") {
        validacion = false;
    }
    if ($("#Vencimiento").val() === "") {
        validacion = false;
    }
    if ($("#CCV").val() === "") {
        validacion = false;
    }
    return validacion;
}

function mostrarDatos(dato) {
    if (dato === "Soloida") {
        document.getElementById("AAAAAA").hidden = true;
    }
    if (dato === "IdaVuelta") {
        document.getElementById("AAAAAA").hidden = false;
    }
}

function cargarTablas() {
    var dataTable_const = function () {
        if ($("#dt____").length) {
            $("#dt____").DataTable({
                dom: "Bfrtip",
                bFilter: true,
                ordering: true,
                buttons: [
                    {
                        extend: "copy",
                        className: "btn-sm",
                        text: "Copiar"
                    }
                ],
                "columnDefs": [
                    {
                        targets: 6,
                        className: "dt-center",
                        render: function (data, type, row, meta) {
                            var botones = '<button type="button" class="btn btn-default btn-xs" aria-label="Left Align" onclick="showBoleto(\'' + row[0] + '\');">Cargar Ida</button> ';
                            botones += '<button type="button" class="btn btn-default btn-xs" aria-label="Left Align" onclick="showBoleto2(\'' + row[0] + '\');">Cargar Regreso</button>';
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
                            action: "showVuelos"
                        });
                    }
                },
                drawCallback: function (nRow, aData, iDisplayIndex, iDisplayIndexFull) {
                    $('#dt____').DataTable().columns.adjust().responsive.recalc();
                }
            });
        }
    };

    TableManageButtons = function () {
        "use strict";
        return {
            init: function () {
                dataTable_const();
                $(".dataTables_filter input").addClass("form-control input-rounded ml-sm");
            }
        };
    }();

    TableManageButtons.init();
}

function CalPrecio() {
    var total = 0;
    if (document.getElementById("AAAAAA").hidden === false) {
        total = $("#Precio").val() * $("#cantidadAsientos").val() + ($("#PrecioR").val() * $("#cantidadAsientos").val());
        $("#Total").val(total);
    } else {
        total = $("#Precio").val() * $("#cantidadAsientos").val();
        $("#Total").val(total);
    }
    return total;
}

function consultarTipoCambio(cambio) {

    $.ajax({
        url: '../../Backend/Agenda/controller/tipoCambio.php',
        type: 'POST',
        data: {
            action: "consultarTipoCambio"
        },
        error: function () { //si existe un error en la respuesta del ajax
            alert("Error al consultar el tipo de cambio");
        },
        success: function (data) { //si todo esta correcto en la respuesta del ajax, la respuesta queda en el data
            var json = JSON.parse(data.trim());
            
            if (cambio === true) {
                var total = CalPrecio();
                total = total * json.compra;
                $("#Total").val(total);
            } else {
                var total = CalPrecio();
                $("#Total").val(total);
            }

        }
    });
}

window.onresize = function () {
    $('#dt____').DataTable().columns.adjust().responsive.recalc();
};

    