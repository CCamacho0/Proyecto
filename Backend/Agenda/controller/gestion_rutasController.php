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
            if ((filter_input(INPUT_POST, 'idgestion_rutas') != null) && (filter_input(INPUT_POST, 'dia_semana_hora') != null) 
                && (filter_input(INPUT_POST, 'ruta') != null) && (filter_input(INPUT_POST, 'duracion') != null)) {

                $mygestion_rutas->setidgestion_rutas(filter_input(INPUT_POST, 'idgestion_rutas'));
                $mygestion_rutas->setruta(filter_input(INPUT_POST, 'ruta'));
                $mygestion_rutas->setduracion(filter_input(INPUT_POST, 'duracion'));
                $mygestion_rutas->setdia_semana_hora(filter_input(INPUT_POST, 'dia_semana_hora'));
                
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
            if (filter_input(INPUT_POST, 'idgestion_rutas') != null) {
                $mygestion_rutas->setidgestion_rutas(filter_input(INPUT_POST, 'idgestion_rutas'));
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
            if (filter_input(INPUT_POST, 'idgestion_rutas') != null) {
                $mygestion_rutas->setidgestion_rutas(filter_input(INPUT_POST, 'idgestion_rutas'));
                $mygestion_rutasBo->delete($mygestion_rutas);
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

