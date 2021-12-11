<?php

require_once("../bo/PersonasBo.php");
require_once("../domain/Personas.php");

// Personas Controller 
//----------------------------------------------------------------------------------

if (filter_input(INPUT_POST, 'action') != null) {
    $action = filter_input(INPUT_POST, 'action');

    try {
        $myPersonasBo = new PersonasBo();
        $myPersonas = Personas::createNullPersonas();
        //choose the action
        //----------------------------------------------------------------------------------

        if ($action === "add_personas" or $action === "update_personas") {
            //se valida que los parametros hayan sido enviados por post
            if ((filter_input(INPUT_POST, 'PK_cedula') != null) && (filter_input(INPUT_POST, 'nombre') != null) && (
                    filter_input(INPUT_POST, 'apellido1') != null) && (filter_input(INPUT_POST, 'apellido2') != null) && (filter_input(INPUT_POST, 'fecNacimiento') != null) && (filter_input(INPUT_POST, 'sexo') != null) && (filter_input(INPUT_POST, 'celular') != null) && (filter_input(INPUT_POST, 'correo') != null) && (filter_input(INPUT_POST, 'direccion') != null) && (filter_input(INPUT_POST, 'nombreUsuario') != null) && (filter_input(INPUT_POST, 'contrasena') != null) && (filter_input(INPUT_POST, 'tipoUsuario') != null)) {

                $myPersonas->setPK_cedula(filter_input(INPUT_POST, 'PK_cedula'));
                $myPersonas->setnombre(filter_input(INPUT_POST, 'nombre'));
                $myPersonas->setapellido1(filter_input(INPUT_POST, 'apellido1'));
                $myPersonas->setapellido2(filter_input(INPUT_POST, 'apellido2'));
                $myPersonas->setfecNacimiento(filter_input(INPUT_POST, 'fecNacimiento'));
                $myPersonas->setsexo(filter_input(INPUT_POST, 'sexo'));
                $myPersonas->setCelular(filter_input(INPUT_POST, 'celular'));
                $myPersonas->setCorreo(filter_input(INPUT_POST, 'correo'));
                $myPersonas->setDireccion(filter_input(INPUT_POST, 'direccion'));
                $myPersonas->setnombreUsuario(filter_input(INPUT_POST, 'nombreUsuario'));
                $myPersonas->setcontrasena(filter_input(INPUT_POST, 'contrasena'));
                $myPersonas->settipoUsuario(filter_input(INPUT_POST, 'tipoUsuario'));
                $myPersonas->setLastUser(filter_input(INPUT_POST, 'nombreUsuario'));

                if ($action == "add_personas") {
                    $myPersonasBo->add($myPersonas);
                    echo('M~Registro Incluido Correctamente');
                }
                if ($action == "update_personas") {
                    $myPersonasBo->update($myPersonas);
                    echo('M~Registro Modificado Correctamente');
                }
            } else {
                echo('E-Los valores no fueron enviados');
            }
        }

        //----------------------------------------------------------------------------------

        if ($action === "showAll_personas") {//accion de consultar todos los registros
            $resultDB = $myPersonasBo->getAll();
            $json = json_encode($resultDB->GetArray());
            $resultado = '{"data": ' . $json . '}';
            if ($resultDB->RecordCount() === 0) {
                $resultado = '{"data": []}';
            }
            echo $resultado;
        }

        //----------------------------------------------------------------------------------

        if ($action === "show_personas") {//accion de mostrar cliente por ID
            //se valida que los parametros hayan sido enviados por post
            if (filter_input(INPUT_POST, 'PK_cedula') != null) {
                $myPersonas->setPK_cedula(filter_input(INPUT_POST, 'PK_cedula'));
                $myPersonas = $myPersonasBo->searchById($myPersonas);
                if ($myPersonas != null) {
                    echo json_encode(($myPersonas));
                } else {
                    echo('E~NO Existe un cliente con el ID especificado');
                }
            }
        }

        //----------------------------------------------------------------------------------

        if ($action === "delete_personas") {//accion de eliminar cliente por ID
            //se valida que los parametros hayan sido enviados por post
            if (filter_input(INPUT_POST, 'PK_cedula') != null) {
                $myPersonas->setPK_cedula(filter_input(INPUT_POST, 'PK_cedula'));
                $myPersonasBo->delete($myPersonas);
                echo('M~Registro Fue Eliminado Correctamente');
            }
        }

        if ($action === "IniciarSesion") {//accion de mostrar cliente por ID
            //se valida que los parametros hayan sido enviados por post
            if (filter_input(INPUT_POST, 'correo') != null && filter_input(INPUT_POST, 'contrasena') != null) {
                $myPersonas->setCorreo(filter_input(INPUT_POST, 'correo'));
                $myPersonas->setcontrasena(filter_input(INPUT_POST, 'contrasena'));

                $myPersonas = $myPersonasBo->IniciarSesion($myPersonas);
                if ($myPersonas != null) {
                    $myPersonasBo->CrearSesion($myPersonas);
                } else {
                    echo('E~El nombre de usuario o contraseña son incorrectos');
                }
            }
        }

        if ($action === "Verificar") {
            $myPersonasBo->Verificar();
        }
        
        if ($action === "Destruir") {
            $myPersonasBo->Destruir();
        }
        
        if ($action === "InfoUsuario") {
            $result =$myPersonasBo->InfoUsuario();
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

