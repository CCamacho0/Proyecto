<?php

require_once("../bo/gestion_rutasBo.php");
require_once("../domain/gestion_rutas.php");

// gestion_rutas Controller 
//----------------------------------------------------------------------------------

if (filter_input(INPUT_POST, 'action') != null) {
    $action = filter_input(INPUT_POST, 'action');

    try {
        $mygestion_rutasBo = new gestion_rutasBo();
        $mygestion_rutas = gestion_rutas::createNullgestion_rutas();

        //choose the action
        //----------------------------------------------------------------------------------

        if ($action === "add_gestion_rutas" or $action === "update_gestion_rutas") {
            //se valida que los parametros hayan sido enviados por post
            if ((filter_input(INPUT_POST, 'PK_IdRutas') != null) && (filter_input(INPUT_POST, 'FechaSalida') != null) && (filter_input(INPUT_POST, 'FechaEntrada') != null) && (filter_input(INPUT_POST, 'ruta') != null) && (filter_input(INPUT_POST, 'duracion') != null) && (filter_input(INPUT_POST, 'Precio') != null) && (filter_input(INPUT_POST, 'Promocion') != null) && (filter_input(INPUT_POST, 'FK_tipoAvion') != null)) {

                $mygestion_rutas->setPK_IdRutas(filter_input(INPUT_POST, 'PK_IdRutas'));
                $mygestion_rutas->setruta(filter_input(INPUT_POST, 'ruta'));
                $mygestion_rutas->setduracion(filter_input(INPUT_POST, 'duracion'));
                $mygestion_rutas->setFechaSalida(filter_input(INPUT_POST, 'FechaSalida'));
                $mygestion_rutas->setFechaEntrada(filter_input(INPUT_POST, 'FechaEntrada'));
                $mygestion_rutas->setPrecio(filter_input(INPUT_POST, 'Precio'));
                $mygestion_rutas->setPromocion(filter_input(INPUT_POST, 'Promocion'));
                $mygestion_rutas->setFK_tipoAvion(filter_input(INPUT_POST, 'FK_tipoAvion'));
                $mygestion_rutas->setlastUser('Cama');

                if ($action == "add_gestion_rutas") {
                    $mygestion_rutasBo->add($mygestion_rutas);
                    echo('M~Registro Incluido Correctamente');
                }
                if ($action == "update_gestion_rutas") {
                    $mygestion_rutasBo->update($mygestion_rutas);
                    echo('M~Registro Modificado Correctamente');
                }
            } else {
                echo('E-Los valores no fueron enviados');
            }
        }

        //----------------------------------------------------------------------------------

        if ($action === "showAll_gestion_rutas") {//accion de consultar todos los registros
            $resultDB = $mygestion_rutasBo->getAll();
            $json = json_encode($resultDB->GetArray());
            $resultado = '{"data": ' . $json . '}';
            if ($resultDB->RecordCount() === 0) {
                $resultado = '{"data": []}';
            }
            echo $resultado;
        }

        //----------------------------------------------------------------------------------

        if ($action === "show_gestion_rutas") {//accion de mostrar cliente por ID
            //se valida que los parametros hayan sido enviados por post
            if (filter_input(INPUT_POST, 'PK_IdRutas') != null) {
                $mygestion_rutas->setPK_IdRutas(filter_input(INPUT_POST, 'PK_IdRutas'));
                $mygestion_rutas = $mygestion_rutasBo->searchById($mygestion_rutas);
                if ($mygestion_rutas != null) {
                    echo json_encode(($mygestion_rutas));
                } else {
                    echo('E~NO Existe un cliente con el ID especificado');
                }
            }
        }

        //----------------------------------------------------------------------------------

        if ($action === "delete_gestion_rutas") {//accion de eliminar cliente por ID
            //se valida que los parametros hayan sido enviados por post
            if (filter_input(INPUT_POST, 'PK_IdRutas') != null) {
                $mygestion_rutas->setPK_IdRutas(filter_input(INPUT_POST, 'PK_IdRutas'));
                $mygestion_rutasBo->delete($mygestion_rutas);
                echo('M~Registro Fue Eliminado Correctamente');
            }
        }

        if ($action === "showPromo") {//accion de consultar todos los registros
            $resultDB = $mygestion_rutasBo->getPromo();
            $json = json_encode($resultDB->GetArray());
            $resultado = '{"data": ' . $json . '}';
            if ($resultDB->RecordCount() === 0) {
                $resultado = '{"data": []}';
            }
            echo $resultado;
        }

        if ($action === "ShowRutasPop") {
            $resultDB = $mygestion_rutasBo->RutasPop();
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

