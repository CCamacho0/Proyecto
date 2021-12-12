$(document).ready(function () {
    cargarTablas();

});

function deleteReservacionByID(idFactura) {
    //Se envia la información por ajax
    $.ajax({
        url: '../../Backend/Agenda/controller/FacturaController.php',
        data: {
            action: "delete_Factura",
            idFactura: idFactura
        },
        error: function () { //si existe un error en la respuesta del ajax
            swal("Error", "Se presento un error al eliminar la informacion", "error");
        },
        success: function (data) { //si todo esta correcto en la respuesta del ajax, la respuesta queda en el data
            var responseText = data.trim().substring(2);
            var typeOfMessage = data.trim().substring(0, 2);
            if (typeOfMessage === "M~") { //si todo esta corecto
                swal("Confirmacion", responseText, "success");
                $("#dt_Reservaciones").DataTable().ajax.reload();
            } else {//existe un error
                swal("Error", responseText, "error");
            }
        },
        type: 'POST'
    });
}

function cargarTablas() {

    var dataTableReservaciones_const = function () {
        if ($("#dt_Reservaciones").length) {
            $("#dt_Reservaciones").DataTable({
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
                            var botones = '<button type="button" class="btn btn-default btn-xs" aria-label="Left Align" onclick="deleteReservacionByID(\'' + row[0] + '\');">Eliminar</button>';
                            return botones;
                        }
                    }

                ],
                pageLength: 10,
                language: dt_lenguaje_espanol,
                ajax: {
                    url: '../../Backend/Agenda/controller/FacturaController.php',
                    type: "POST",
                    data: function (d) {
                        return $.extend({}, d, {
                            action: "showReservaciones"
                        });
                    }
                },
                drawCallback: function (nRow, aData, iDisplayIndex, iDisplayIndexFull) {
                    $('#dt_Reservaciones').DataTable().columns.adjust().responsive.recalc();
                }
            });
        }
    };

    TableManageButtons = function () {
        "use strict";
        return {
            init: function () {
                dataTableReservaciones_const();
                $(".dataTables_filter input").addClass("form-control input-rounded ml-sm");
            }
        };
    }();

    TableManageButtons.init();
}

//Evento que reajusta la tabla en el tamaño de la pantalla
window.onresize = function () {
    $('#dt_Reservaciones').DataTable().columns.adjust().responsive.recalc();
};


