<?php

require_once("../dao/adodb5/adodb.inc.php");
require_once("../domain/Personas.php");

class PersonasDao {

    private $labAdodb;

    public function __construct() {
        $driver = 'mysqli';
        $this->labAdodb = newAdoConnection($driver);
        //$this->labAdodb->setCharset('utf8');
        //$this->labAdodb->setConnectionParameter('CharacterSet', 'WE8ISO8859P15');
        $this->labAdodb->Connect("localhost", "root2", "Camacho2", "mydb");

        $this->labAdodb->debug = false;
    }

    //agrega a una persona a la base de datos
    //----------------------------------------------------------------------------------

    public function add(Personas $personas) {
        try {
            $sql = sprintf("insert into Personas (PK_cedula, nombre, apellido1, apellido2, fecNacimiento, sexo, 
                celular, correo, direccion, nombreUsuario, contrasena, tipoUsuario, LASTUSER, LASTMODIFICATION) 
                                          values (%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,CURDATE())",
                    $this->labAdodb->Param("PK_cedula"),
                    $this->labAdodb->Param("nombre"),
                    $this->labAdodb->Param("apellido1"),
                    $this->labAdodb->Param("apellido2"),
                    $this->labAdodb->Param("fecNacimiento"),
                    $this->labAdodb->Param("sexo"),
                    $this->labAdodb->Param("celular"),
                    $this->labAdodb->Param("correo"),
                    $this->labAdodb->Param("direccion"),
                    $this->labAdodb->Param("nombreUsuario"),
                    $this->labAdodb->Param("contrasena"),
                    $this->labAdodb->Param("tipoUsuario"),
                    $this->labAdodb->Param("LASTUSER"));
            $sqlParam = $this->labAdodb->Prepare($sql);

            $valores = array();

            $valores["PK_cedula"] = $personas->getPK_cedula();
            $valores["nombre"] = $personas->getnombre();
            $valores["apellido1"] = $personas->getapellido1();
            $valores["apellido2"] = $personas->getapellido2();
            $valores["fecNacimiento"] = $personas->getfecNacimiento();
            $valores["sexo"] = $personas->getsexo();
            $valores["celular"] = $personas->getCelular();
            $valores["correo"] = $personas->getCorreo();
            $valores["direccion"] = $personas->getDireccion();
            $valores["nombreUsuario"] = $personas->getnombreUsuario();
            $valores["contrasena"] = $personas->getcontrasena();
            $valores["tipoUsuario"] = $personas->gettipoUsuario();
            $valores["LASTUSER"] = $personas->getLastUser();

            $this->labAdodb->Execute($sqlParam, $valores) or die($this->labAdodb->ErrorMsg());
        } catch (Exception $e) {
            throw new Exception('No se pudo insertar el registro (Error generado en el metodo add de la clase PersonasDao), error:' . $e->getMessage());
        }
    }

    //verifica si una persona existe en la base de datos por ID
    //----------------------------------------------------------------------------------

    public function exist(Personas $personas) {
        $exist = false;
        try {
            $sql = sprintf("select * from mydb.Personas where  PK_cedula = %s ",
                    $this->labAdodb->Param("PK_cedula"));
            $sqlParam = $this->labAdodb->Prepare($sql);

            $valores = array();
            $valores["PK_cedula"] = $personas->getPK_cedula();

            $resultSql = $this->labAdodb->Execute($sqlParam, $valores) or die($this->labAdodb->ErrorMsg());
            if ($resultSql->RecordCount() > 0) {
                $exist = true;
            }
            return $exist;
        } catch (Exception $e) {
            throw new Exception('No se pudo obtener el registro (Error generado en el metodo exist de la clase PersonasDao), error:' . $e->getMessage());
        }
    }

    //modifica una persona en la base de datos
    //----------------------------------------------------------------------------------

    public function update(Personas $personas) {

        try {
            $sql = sprintf("update Personas set nombre = %s, 
                                                apellido1 = %s, 
                                                apellido2 = %s, 
                                                fecNacimiento = %s, 
                                                sexo = %s, 
                                                celular = %s,
                                                correo = %s,
                                                direccion = %s,
                                                nombreUsuario = %s, 
                                                contrasena = %s, 
                                                tipoUsuario = %s, 
                                                LASTUSER = %s, 
                                                LASTMODIFICATION = CURDATE() 
                            where PK_cedula = %s",
                    $this->labAdodb->Param("nombre"),
                    $this->labAdodb->Param("apellido1"),
                    $this->labAdodb->Param("apellido2"),
                    $this->labAdodb->Param("fecNacimiento"),
                    $this->labAdodb->Param("sexo"),
                    $this->labAdodb->Param("celular"),
                    $this->labAdodb->Param("correo"),
                    $this->labAdodb->Param("direccion"),
                    $this->labAdodb->Param("nombreUsuario"),
                    $this->labAdodb->Param("contrasena"),
                    $this->labAdodb->Param("tipoUsuario"),
                    $this->labAdodb->Param("LASTUSER"),
                    $this->labAdodb->Param("PK_cedula"));
            $sqlParam = $this->labAdodb->Prepare($sql);

            $valores = array();

            $valores["nombre"] = $personas->getnombre();
            $valores["apellido1"] = $personas->getapellido1();
            $valores["apellido2"] = $personas->getapellido2();
            $valores["fecNacimiento"] = $personas->getfecNacimiento();
            $valores["sexo"] = $personas->getsexo();
            $valores["celular"] = $personas->getCelular();
            $valores["correo"] = $personas->getCorreo();
            $valores["direccion"] = $personas->getDireccion();
            $valores["nombreUsuario"] = $personas->getnombreUsuario();
            $valores["contrasena"] = $personas->getcontrasena();
            $valores["tipoUsuario"] = $personas->gettipoUsuario();
            $valores["LASTUSER"] = $personas->getLastUser();
            $valores["PK_cedula"] = $personas->getPK_cedula();
            $this->labAdodb->Execute($sqlParam, $valores) or die($this->labAdodb->ErrorMsg());
        } catch (Exception $e) {
            throw new Exception('No se pudo actualizar el registro (Error generado en el metodo update de la clase PersonasDao), error:' . $e->getMessage());
        }
    }

    //elimina una persona en la base de datos
    //----------------------------------------------------------------------------------

    public function delete(Personas $personas) {


        try {
            $sql = sprintf("delete from Personas where  PK_cedula = %s",
                    $this->labAdodb->Param("PK_cedula"));
            $sqlParam = $this->labAdodb->Prepare($sql);

            $valores = array();

            $valores["PK_cedula"] = $personas->getPK_cedula();

            $this->labAdodb->Execute($sqlParam, $valores) or die($this->labAdodb->ErrorMsg());
        } catch (Exception $e) {
            throw new Exception('No se pudo eliminar el registro (Error generado en el metodo delete de la clase PersonasDao), error:' . $e->getMessage());
        }
    }

    //busca a una persona en la base de datos
    //----------------------------------------------------------------------------------

    public function searchById(Personas $personas) {

        $returnPersonas = null;
        try {
            $sql = sprintf("select * from Personas where  PK_cedula = %s",
                    $this->labAdodb->Param("PK_cedula"));
            $sqlParam = $this->labAdodb->Prepare($sql);

            $valores = array();

            $valores["PK_cedula"] = $personas->getPK_cedula();

            $resultSql = $this->labAdodb->Execute($sqlParam, $valores) or die($this->labAdodb->ErrorMsg());

            if ($resultSql->RecordCount() > 0) {
                $returnPersonas = Personas::createNullPersonas();
                $returnPersonas->setPK_cedula($resultSql->Fields("PK_cedula"));
                $returnPersonas->setnombre($resultSql->Fields("nombre"));
                $returnPersonas->setapellido1($resultSql->Fields("apellido1"));
                $returnPersonas->setapellido2($resultSql->Fields("apellido2"));
                $returnPersonas->setfecNacimiento($resultSql->Fields("fecNacimiento"));
                $returnPersonas->setsexo($resultSql->Fields("sexo"));
                $returnPersonas->setCelular($resultSql->Fields("celular"));
                $returnPersonas->setCorreo($resultSql->Fields("correo"));
                $returnPersonas->setDireccion($resultSql->Fields("direccion"));
                $returnPersonas->setnombreUsuario($resultSql->Fields("nombreUsuario"));
                $returnPersonas->setcontrasena($resultSql->Fields("contrasena"));
                $returnPersonas->settipoUsuario($resultSql->Fields("tipoUsuario"));
            }
        } catch (Exception $e) {
            throw new Exception('No se pudo consultar el registro (Error generado en el metodo searchById de la clase PersonasDao), error:' . $e->getMessage());
        }
        return $returnPersonas;
    }

    //obtiene la información de las personas en la base de datos
    //----------------------------------------------------------------------------------

    public function getAll() {

        try {
            $sql = sprintf("select * from Personas");
            $resultSql = $this->labAdodb->Execute($sql);
            return $resultSql;
        } catch (Exception $e) {
            throw new Exception('No se pudo obtener los registros (Error generado en el metodo getAll de la clase PersonasDao), error:' . $e->getMessage());
        }
    }

    public function IniciarSesion(Personas $personas) {

        $returnPersonas = null;
        try {
            $sql = sprintf("SELECT P.PK_cedula, P.nombreUsuario, P.tipoUsuario
                            FROM mydb.personas P 
                            WHERE  P.correo = %s 
                            AND P.contrasena = %s",
                    $this->labAdodb->Param("correo"),
                    $this->labAdodb->Param("contrasena"));
            $sqlParam = $this->labAdodb->Prepare($sql);

            $valores = array();
            $valores["correo"] = $personas->getCorreo();
            $valores["contrasena"] = $personas->getcontrasena();

            $resultSql = $this->labAdodb->Execute($sqlParam, $valores) or die($this->labAdodb->ErrorMsg());

            if ($resultSql->RecordCount() > 0) {
                $returnPersonas = Personas::createNullPersonas();
                $returnPersonas->setnombreUsuario($resultSql->Fields("nombreUsuario"));
                $returnPersonas->setPK_cedula($resultSql->Fields("PK_cedula"));
                $returnPersonas->settipoUsuario($resultSql->Fields("tipoUsuario"));
            }
        } catch (Exception $e) {
            throw new Exception('No se pudo consultar el registro (Error generado en el metodo IniciarSesion de la clase PersonasDao), error:' . $e->getMessage());
        }
        return $returnPersonas;
    }

    public function CrearSesion(Personas $personas) {

        session_name('Aerolinea');
        session_start();

        if (!(isset($_SESSION['ArregloVal']))) {
            $arreglo = array();
            $arreglo[] = $personas->getnombreUsuario();
            $arreglo[] = $personas->getPK_cedula();
            $arreglo[] = $personas->gettipoUsuario();

            $_SESSION['ArregloVal'] = $arreglo;
        } else {
            echo("E~Ya se ha iniciado sesion");
        }
    }

    public function Verificar() {

        session_name('Aerolinea');
        session_start();

        if (isset($_SESSION['ArregloVal'])) {
            echo ("E~Ya se ha iniciado sesion");
        }
    }

    public function Destruir() {

        session_name('Aerolinea');
        session_start();

        session_destroy();
        echo("M~La sesión fue destruida correctamente");
    }

    public function InfoUsuario() {

        session_name('Aerolinea');
        session_start();

        if (!(isset($_SESSION['ArregloVal']))) {
            echo ("   ");
        } else {
            $arreglo = $_SESSION['ArregloVal']; // obtiene el dato de la sesión
            echo ($arreglo[0]);
        }
    }

}
