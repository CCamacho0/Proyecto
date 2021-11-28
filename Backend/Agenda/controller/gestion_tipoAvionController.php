<?php

require_once("../bo/gestion_tipoavionBo.php");
require_once("../domain/gestion_tipoavion.php");

// gestion_tipoavion Controller 
//----------------------------------------------------------------------------------

if (filter_input(INPUT_POST, 'action') != null) {
    $action = filter_input(INPUT_POST, 'action');

    try {
        $mygestion_tipoavionBo = new gestion_tipoavionBo();
        $mygestion_tipoavion = gestion_tipoavionBo::createNullgestion_tipoavionBo();

        //choose the action
        //----------------------------------------------------------------------------------

        if ($action === "add_gestion_tipoavion" or $action === "update_gestion_tipoavion") {
            //se valida que los parametros hayan sido enviados por post
            if ((filter_input(INPUT_POST, 'idgestion_tipoavion') != null) && (filter_input(INPUT_POST, 'anno') != null)
                    && (filter_input(INPUT_POST, 'modelo') != null) && (filter_input(INPUT_POST, 'marca') != null) && 
                    (filter_input(INPUT_POST, 'cantidad_pasajeros') != null) && (filter_input(INPUT_POST, 'cantidad_filas') != null) 
                    && (filter_input(INPUT_POST, 'cantidadasientos_fila') != null)) {

                $mygestion_tipoavion->setidgestion_tipoavion(filter_input(INPUT_POST, 'idgestion_tipoavion'));
                $mygestion_tipoavion->setanno(filter_input(INPUT_POST, 'anno'));
                $mygestion_tipoavion->setmodelo(filter_input(INPUT_POST, 'modelo'));
                $mygestion_tipoavion->setmarca(filter_input(INPUT_POST, 'marca'));
                $mygestion_tipoavion->setcantidad_pasajeros(filter_input(INPUT_POST, 'cantidad_pasajeros'));
                $mygestion_tipoavion->setcantidad_filas(filter_input(INPUT_POST, 'cantidad_filas'));
                $mygestion_tipoavion->setcantidadasientos_fila(filter_input(INPUT_POST, 'cantidadasientos_fila'));

                if ($action == "add_gestion_tipoavion") {
                    $mygestion_tipoavionBo->add($mygestion_tipoavion);
                    echo('M~Registro Incluido Correctamente');
                }
                if ($action == "update_gestion_tipoavion") {
                    $mygestion_tipoavionBo->update($mygestion_tipoavion);
                    echo('M~Registro Modificado Correctamente');
                }
            } else {
                echo('E-Los valores no fueron enviados');
            }
        }

        //----------------------------------------------------------------------------------

        if ($action === "showAll_gestion_tipoavion") {//accion de consultar todos los registros
            $resultDB = $mygestion_tipoavionBo->getAll();
            $json = json_encode($resultDB->GetArray());
            $resultado = '{"data": ' . $json . '}';
            if ($resultDB->RecordCount() === 0) {
                $resultado = '{"data": []}';
            }
            echo $resultado;
        }

        //----------------------------------------------------------------------------------

        if ($action === "show_gestion_tipoavion") {//accion de mostrar cliente por ID
            //se valida que los parametros hayan sido enviados por post
            if (filter_input(INPUT_POST, 'idgestion_tipoavion') != null) {
                $mygestion_tipoavion->setidgestion_tipoavion(filter_input(INPUT_POST, 'idgestion_tipoavion'));
                $mygestion_tipoavion = $mygestion_tipoavionBo->searchById($mygestion_tipoavion);
                if ($mygestion_tipoavion != null) {
                    echo json_encode(($mygestion_tipoavion));
                } else {
                    echo('E~NO Existe un cliente con el ID especificado');
                }
            }
        }

        //----------------------------------------------------------------------------------

        if ($action === "delete_gestion_tipoavion") {//accion de eliminar cliente por ID
            //se valida que los parametros hayan sido enviados por post
            if (filter_input(INPUT_POST, 'idgestion_tipoAvion') != null) {
                $mygestion_tipoavion->setidgestion_tipoAvion(filter_input(INPUT_POST, 'idgestion_tipoAvion'));
                $mygestion_tipoavionBo->delete($mygestion_tipoavion);
                echo('M~Registro Fue Eliminado Correctamente');
            }
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


