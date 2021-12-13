//cuando el documento esta cargado se procede a cargar la información
$(document).ready(function () {
    cargarTablas();

});

//Metodo para cargar las tablas
function cargarTablas() {

    var dataTableClientes_const = function () {
        if ($("#dt_Rutaspop").length) {
            $("#dt_Rutaspop").DataTable({
                dom: "Bfrtip",
                bFilter: true,
                ordering: true,
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
                        targets: 2,
                        className: "dt-center",
                    }
                ],
                pageLength: 10,
                language: dt_lenguaje_espanol,
                ajax: {
                    url: '../../../Backend/Agenda/controller/gestion_rutasController.php',
                    type: "POST",
                    data: function (d) {
                        return $.extend({}, d, {
                            action: "ShowRutasPop"
                        });
                    }
                },
                drawCallback: function (nRow, aData, iDisplayIndex, iDisplayIndexFull) {
                    $('#dt_Rutaspop').DataTable().columns.adjust().responsive.recalc();
                }
            });
        }
    };

    TableManageButtons = function () {
        "use strict";
        return {
            init: function () {
                dataTableClientes_const();
                $(".dataTables_filter input").addClass("form-control input-rounded ml-sm");
            }
        };
    }();

    TableManageButtons.init();
}

//Evento que reajusta la tabla en el tamaño de la pantalla
window.onresize = function () {
    $('#dt_Rutaspop').DataTable().columns.adjust().responsive.recalc();
};

