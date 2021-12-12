//cuando el documento esta cargado se procede a cargar la información
$(document).ready(function () {
    cargarGrafico();

});

function cargarGrafico() {
    //Se envia la información por ajax
    $.ajax({
        url: '../../../Backend/Agenda/controller/FacturaController.php',
        data: {action: "showFacturaMes"},
        error: function () { //si existe un error en la respuesta del ajax
            swal("Error", "Se presento un error al consultar la informacion", "error");
        },
        success: function (data) { //si todo esta correcto en la respuesta del ajax, la respuesta queda en el data
            var objPersonasJSon = JSON.parse(data);
            alert(objPersonasJSon);
            Highcharts.chart('container', {
                chart: {
                    type: 'line'
                },
                title: {
                    text: 'Ingresos del Año'
                },

                xAxis: {
                    categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
                },

                plotOptions: {
                    line: {
                        dataLabels: {
                            enabled: true
                        },
                        enableMouseTracking: false
                    }
                },
                series: [{
                        name: 'Facturado',
                        data: [700.0, 600.9, 900.5, 1400.5, 1800.4, 2100.5, 2500.2, 2600.5, 2300.3, 1800.3, 1300.9, 900.6]
                                //Meter una funcion que recorra la base de datos para sacar el total de cada mes 
                    }]
            });

        },
        type: 'POST'
    });
}

