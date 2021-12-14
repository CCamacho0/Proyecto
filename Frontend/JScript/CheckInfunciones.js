$(function () {
    $("#BuscarFactura").click(function () {
        BuscarFactura();
    });

    $("#BuscarAsiento").click(function () {
        GenerarAsiento();
    });

    $("#guardar").click(function () {
        UpdateAsiento();
    });

    $("#cancelar").click(function () {
        cancelAction();
    });
});

function validar() {
    var validacion = true;

    if ($("#idFac").val() === "") {
        validacion = false;
    }
    return validacion;
}

function GenerarAsiento() {
    var Asiento = Math.round(Math.random() * (100 - 0) + 0);
    $("#asiento").val(Asiento);
}

function UpdateAsiento() {
    //Se envia la información por ajax
    if (validar()) {
        $.ajax({
            url: '../../Backend/Agenda/controller/FacturaController.php',
            data: {
                action: "update_Asiento",
                idFactura: $("#idFac").val(),
                asiento: $("#asiento").val()
            },
            error: function () { //si existe un error en la respuesta del ajax
                swal("Error", "Se presento un error al enviar la informacion", "error");
            },
            success: function (data) { //si todo esta correcto en la respuesta del ajax, la respuesta queda en el data
                swal("Error", data, "error");
                var messageComplete = data.trim();
                var responseText = messageComplete.substring(2);
                var typeOfMessage = messageComplete.substring(0, 2);
                if (typeOfMessage === "M~") { //si todo esta corecto
                    swal("Confirmacion", responseText, "success");
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

function BuscarFactura() {
    if (validar()) {
        $.ajax({
            url: '../../Backend/Agenda/controller/FacturaController.php',
            data: {
                action: "show_Factura",
                idFactura: $("#idFac").val()
            },
            error: function () { //si existe un error en la respuesta del ajax
                swal("Error", "Se presento un error al consultar la informacion", "error");
            },
            success: function (data) { //si todo esta correcto en la respuesta del ajax, la respuesta queda en el data

                var objFacturaJSon = JSON.parse(data);

                $("#idRuta").val(objFacturaJSon.FK_IdRutas);
                BuscarRuta();
            },
            type: 'POST',
        });
    } else {
        swal("Error de validación", "El id de Factura no fue digitado", "error");
    }
}

function BuscarRuta() {
    $.ajax({
        url: '../../Backend/Agenda/controller/gestion_rutasController.php',
        data: {
            action: "show_gestion_rutas",
            PK_IdRutas: $("#idRuta").val()
        },
        error: function () { //si existe un error en la respuesta del ajax
            swal("Error", "Se presento un error al consultar la informacion", "error");
        },
        success: function (data) { //si todo esta correcto en la respuesta del ajax, la respuesta queda en el data
            var objRutaJSon = JSON.parse(data);

            $("#Ruta").val(objRutaJSon.ruta);
            $("#duracion").val(objRutaJSon.duracion);
            $("#precio").val(objRutaJSon.Precio);
        },
        type: 'POST'
    });
}
