<?php

require_once("../bo/gestionVueloBo.php");
require_once("../domain/gestionVuelo.php");

// gestionVuelo Controller 
//----------------------------------------------------------------------------------

if (filter_input(INPUT_POST, 'action') != null) {
    $action = filter_input(INPUT_POST, 'action');

    try {
        $mygestionVueloBo = new gestionVuelo();
        $mygestionVuelo = gestionVuelo::createNullgestionVuelo();

        //choose the action
        //----------------------------------------------------------------------------------

        if ($action === "add_gestionVuelo" or $action === "update_gestionVuelo") {
            //se valida que los parametros hayan sido enviados por post
            if ((filter_input(INPUT_POST, 'idgestionVuelo') != null) && (filter_input(INPUT_POST, 'Fecha') != null) 
                && (filter_input(INPUT_POST, 'Precio') != null)&& (filter_input(INPUT_POST, 'FK_idgestion_tipoavion') != null)
                    && (filter_input(INPUT_POST, 'FK_idgestion_rutas') != null)) {

                $mygestionVuelo->setidgestionVuelo(filter_input(INPUT_POST, 'idgestionVuelo'));
                $mygestionVuelo->setFecha(filter_input(INPUT_POST, 'Fecha'));
                $mygestionVuelo->setPrecio(filter_input(INPUT_POST, 'Precio'));
                $mygestionVuelo->setFK_idgestion_tipoavion(filter_input(INPUT_POST, 'FK_idgestion_tipoavion'));
                $mygestionVuelo->setFK_idgestion_rutas(filter_input(INPUT_POST, 'FK_idgestion_rutas'));

                if ($action == "add_gestionVuelo") {
                    $mygestionVueloBo->add($mygestionVuelo);
                    echo('M~Registro Incluido Correctamente');
                }
                if ($action == "update_gestionVuelo") {
                    $mygestionVueloBo->update($mygestionVuelo);
                    echo('M~Registro Modificado Correctamente');
                }
            } else {
                echo('E-Los valores no fueron enviados');
            }
        }

        //----------------------------------------------------------------------------------

        if ($action === "showAll_gestionVuelo") {//accion de consultar todos los registros
            $resultDB = $mygestionVueloBo->getAll();
            $json = json_encode($resultDB->GetArray());
            $resultado = '{"data": ' . $json . '}';
            if ($resultDB->RecordCount() === 0) {
                $resultado = '{"data": []}';
            }
            echo $resultado;
        }

        //----------------------------------------------------------------------------------

        if ($action === "show_gestionVuelo") {//accion de mostrar cliente por ID
            //se valida que los parametros hayan sido enviados por post
            if (filter_input(INPUT_POST, 'idgestionVuelo') != null) {
                $mygestionVuelo->setidgestionVuelo(filter_input(INPUT_POST, 'idgestionVuelo'));
                $mygestionVuelo = $mygestionVueloBo->searchById($mygestionVuelo);
                if ($mygestionVuelo != null) {
                    echo json_encode(($mygestionVuelo));
                } else {
                    echo('E~NO Existe un cliente con el ID especificado');
                }
            }
        }

        //----------------------------------------------------------------------------------

        if ($action === "delete_idgestionVuelo") {//accion de eliminar cliente por ID
            //se valida que los parametros hayan sido enviados por post
            if (filter_input(INPUT_POST, 'idgestionVuelo') != null) {
                $mygestionVuelo->setidgestionVuelo(filter_input(INPUT_POST, 'idgestionVuelo'));
                $mygestionVueloBo->delete($mygestionVuelo);
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

