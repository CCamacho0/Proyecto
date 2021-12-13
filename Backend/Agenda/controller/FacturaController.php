<?php

require_once("../bo/FacturaBo.php");
require_once("../domain/Factura.php");

// Factura Controller 
//----------------------------------------------------------------------------------

if (filter_input(INPUT_POST, 'action') != null) {
    $action = filter_input(INPUT_POST, 'action');

    try {
        $myFacturaBo = new FacturaBo();
        $myFactura = Factura::createNullFactura();

        //choose the action
        //----------------------------------------------------------------------------------

        if ($action === "add_Factura" or $action === "update_Factura") {
            //se valida que los parametros hayan sido enviados por post
            if ((filter_input(INPUT_POST, 'idFactura') != null) && (filter_input(INPUT_POST, 'FK_IdRutas') != null) && (filter_input(INPUT_POST, 'CantidadAsientos') != null)) {

                $myFactura->setidFactura(filter_input(INPUT_POST, 'idFactura'));
                $myFactura->setCantidadAsiento(filter_input(INPUT_POST, 'CantidadAsientos'));
                $myFactura->setFK_cedula(filter_input(INPUT_POST, 'FK_IdRutas'));
                $myFactura->setFK_IdRutas(filter_input(INPUT_POST, 'FK_IdRutas'));

                if ($action == "add_Factura") {
                    $myFacturaBo->add($myFactura);
                    echo('M~Registro Incluido Correctamente');
                }
                if ($action == "update_Factura") {
                    $myFacturaBo->update($myFactura);
                    echo('M~Registro Modificado Correctamente');
                }
            } else {
                echo('E-Los valorres no fueron enviados');
            }
        }

        //----------------------------------------------------------------------------------

        if ($action === "showAll_Factura") {//accion de consultar todos los registros
            $resultDB = $myFacturaBo->getAll();
            $json = json_encode($resultDB->GetArray());
            $resultado = '{"data": ' . $json . '}';
            if ($resultDB->RecordCount() === 0) {
                $resultado = '{"data": []}';
            }
            echo $resultado;
        }

        //----------------------------------------------------------------------------------

        if ($action === "show_Factura") {//accion de mostrar Facturas por ID
            //se valida que los parametros hayan sido enviados por post
            if (filter_input(INPUT_POST, 'idFactura') != null) {
                $myFactura->setidFactura(filter_input(INPUT_POST, 'idFactura'));
                $myFactura = $myFacturaBo->searchById($myFactura);
                if ($myFactura != null) {
                    echo json_encode(($myFactura));
                } else {
                    echo('E~NO Existe un cliente con el ID especificado');
                }
            }
        }

        //----------------------------------------------------------------------------------

        if ($action === "delete_Factura") {//accion de eliminar Facura por ID
            //se valida que los parametros hayan sido enviados por post
            if (filter_input(INPUT_POST, 'idFactura') != null) {
                $myFactura->setidFactura(filter_input(INPUT_POST, 'idFactura'));
                $myFacturaBo->delete($myFactura);
                echo('M~Registro Fue Eliminado Correctamente');
            }
        }

        if ($action === "showFacturaMes") {//accion de consultar todos los registros
            $resultDB = $myFacturaBo->FacturadoMes();
            $json = json_encode($resultDB->GetArray());
            $resultado = '{"data": ' . $json . '}';
            if ($resultDB->RecordCount() === 0) {
                $resultado = '{"data": []}';
            }
            echo $resultado;
        }

        if ($action === "showReservaciones") {//accion de consultar todos los registros
            $resultDB = $myFacturaBo->Reservaciones();
            $json = json_encode($resultDB->GetArray());
            $resultado = '{"data": ' . $json . '}';
            if ($resultDB->RecordCount() === 0) {
                $resultado = '{"data": []}';
            }
            echo $resultado;
        }

        if ($action === "ShowLista") {
            $resultDB = $myFacturaBo->ListaClientes();
            $json = json_encode($resultDB->GetArray());
            $resultado = '{"data": ' . $json . '}';
            if ($resultDB->RecordCount() === 0) {
                $resultado = '{"data": []}';
            }
            echo $resultado;
        }

        if ($action === "showHistorico") {//accion de consultar todos los registros
            $resultDB = $myFacturaBo->Historico();
            $json = json_encode($resultDB->GetArray());
            $resultado = '{"data": ' . $json . '}';
            if ($resultDB->RecordCount() === 0) {
                $resultado = '{"data": []}';
            }
            echo $resultado;
        }
        //se captura cualquier error generado
        //----------------------------------------------------------------------------------
    } catch (Exception $e) { //exception generated in the business object..
        echo("E~" . $e->getMessage());
    }
} else {
    echo('M~Parametros no enviados desde el formulario'); //se codifica un mensaje para enviar
}
?>

