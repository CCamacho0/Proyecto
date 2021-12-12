$(document).ready(function () {
    cargarTablas();

});

function cargarTablas() {

    var dataTableHistorico_const = function () {
        if ($("#dt_historico").length) {
            $("#dt_historico").DataTable({
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
                    }

                ],
                pageLength: 10,
                language: dt_lenguaje_espanol,
                ajax: {
                    url: '../../Backend/Agenda/controller/FacturaController.php',
                    type: "POST",
                    data: function (d) {
                        return $.extend({}, d, {
                            action: "showHistorico"
                        });
                    }
                },
                drawCallback: function (nRow, aData, iDisplayIndex, iDisplayIndexFull) {
                    $('#dt_historico').DataTable().columns.adjust().responsive.recalc();
                }
            });
        }
    };

    TableManageButtons = function () {
        "use strict";
        return {
            init: function () {
                dataTableHistorico_const();
                $(".dataTables_filter input").addClass("form-control input-rounded ml-sm");
            }
        };
    }();

    TableManageButtons.init();
}

//Evento que reajusta la tabla en el tamaño de la pantalla
window.onresize = function () {
    $('#dt_historico').DataTable().columns.adjust().responsive.recalc();
};


