$(document).ready(function () {
    cargarTablas();

});

function mostrarFomulario(){
    //El boton ya tiene el metodo 
    //metodo que se carga cuando el boton de la tabla es precionado debe mostrar un formulario de pago como el que esta en reservar 
}
//Metodo para cargar las tablas
function cargarTablas() {

    var dataTableRutas_const = function () {
        if ($("#dt_Promos").length) {
            $("#dt_Promos").DataTable({
                dom: "Bfrtip",
                bFilter: false,
                ordering: false,
                buttons: [
                ],
                "columnDefs": [
                    {
                        targets: 7,
                        className: "dt-center",
                        render: function (data, type, row, meta) {
                            var botones = '<button type="button" class="btn btn-default btn-xs" aria-label="Left Align" onclick= mostrarFomulario()";">Cargar</button> ';
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
                            action: "showPromo"
                        });
                    }
                },
                drawCallback: function (nRow, aData, iDisplayIndex, iDisplayIndexFull) {
                    $('#dt_Promos').DataTable().columns.adjust().responsive.recalc();
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
    $('#dt_Promos').DataTable().columns.adjust().responsive.recalc();
};


