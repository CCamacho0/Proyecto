<?php

require_once("../../utlis/adodb5/adodb.inc.php");
require_once("../domain/datos_Contacto.php");

class datos_ContactoDao {

    private $labAdodb;

    public function __construct() {
        $driver = 'mysqli';
        $this->labAdodb = newAdoConnection($driver);
        //$this->labAdodb->setCharset('utf8');
        //$this->labAdodb->setConnectionParameter('CharacterSet', 'WE8ISO8859P15');
        $this->labAdodb->Connect("localhost", "root2", "Camacho2", "mydb");
        $this->labAdodb->debug = true;
    }

    //agrega a un Contacto a la base de datos
    //----------------------------------------------------------------------------------

    public function add(datos_Contacto $datos_contacto) {


        try {
            $sql = sprintf("insert into datos_Contacto (PK_datos_Contacto, FK_cedula, correo, numeroCelular, numeroTrabajo, LASTUSER, LASTMODIFICATION) 
                                          values (%s,%s,%s,%s,%s,%s,%s,CURDATE())",
                    $this->labAdodb->Param("PK_datos_Contacto"),
                    $this->labAdodb->Param("FK_cedula"),
                    $this->labAdodb->Param("correo"),
                    $this->labAdodb->Param("numeroCelular"),
                    $this->labAdodb->Param("numeroTrabajo"),
                    $this->labAdodb->Param("LASTUSER"));
            $sqlParam = $this->labAdodb->Prepare($sql);

            $valores = array();

            $valores["PK_datos_Contacto"] = $datos_contacto->getPK_datos_Contacto();
            $valores["FK_cedula"] = $datos_contacto->getFK_cedula();
            $valores["correo"] = $datos_contacto->getcorreo();
            $valores["numeroCelular"] = $datos_contacto->getnumeroCelular();
            $valores["numeroTrabajo"] = $datos_contacto->getnumeroTrabajo();
            $valores["LASTUSER"] = $datos_contacto->getLastUser();

            $this->labAdodb->Execute($sqlParam, $valores) or die($this->labAdodb->ErrorMsg());
        } catch (Exception $e) {
            throw new Exception('No se pudo insertar el registro (Error generado en el metodo add de la clase datos_ContactoDao), error:' . $e->getMessage());
        }
    }

    //verifica si un Contacto existe en la base de datos por ID
    //----------------------------------------------------------------------------------

    public function exist(datos_Contacto $datos_contacto) {


        $exist = false;
        try {
            $sql = sprintf("select * from datos_Contacto where  PK_datos_Contacto = %s ",
                    $this->labAdodb->Param("PK_datos_Contacto"));
            $sqlParam = $this->labAdodb->Prepare($sql);

            $valores = array();
            $valores["PK_datos_Contacto"] = $datos_contacto->getPK_datos_Contacto();

            $resultSql = $this->labAdodb->Execute($sqlParam, $valores) or die($this->labAdodb->ErrorMsg());
            if ($resultSql->RecordCount() > 0) {
                $exist = true;
            }
            return $exist;
        } catch (Exception $e) {
            throw new Exception('No se pudo obtener el registro (Error generado en el metodo exist de la clase datos_ContactoDao), error:' . $e->getMessage());
        }
    }

    //modifica un Contacto en la base de datos
    //----------------------------------------------------------------------------------

    public function update(datos_Contacto $datos_contacto) {


        try {
            $sql = sprintf("update datos_Contacto set FK_cedula = %s, 
                                                correo = %s, 
                                                numeroCelular = %s, 
                                                numeroTrabajo = %s, 
                                                LASTUSER = %s, 
                                                LASTMODIFICATION = CURDATE() 
                            where PK_datos_Contacto = %s",
                    $this->labAdodb->Param("FK_cedula"),
                    $this->labAdodb->Param("correo"),
                    $this->labAdodb->Param("numeroCelular"),
                    $this->labAdodb->Param("numeroTrabajo"),
                    $this->labAdodb->Param("LASTUSER"),
                    $this->labAdodb->Param("PK_datos_Contacto"));
            $sqlParam = $this->labAdodb->Prepare($sql);

            $valores = array();

            $valores["FK_cedula"] = $datos_contacto->getFK_cedula();
            $valores["correo"] = $datos_contacto->getcorreo();
            $valores["numeroCelular"] = $datos_contacto->getnumeroCelular();
            $valores["numeroTrabajo"] = $datos_contacto->getnumeroTrabajo();
            $valores["PK_datos_Contacto"] = $datos_contacto->getPK_datos_Contacto();
            $this->labAdodb->Execute($sqlParam, $valores) or die($this->labAdodb->ErrorMsg());
        } catch (Exception $e) {
            throw new Exception('No se pudo actualizar el registro (Error generado en el metodo update de la clase datos_ContactoDao), error:' . $e->getMessage());
        }
    }

    //elimina una Contacto en la base de datos
    //----------------------------------------------------------------------------------

    public function delete(datos_Contacto $datos_contacto) {


        try {
            $sql = sprintf("delete from datos_Contacto where  PK_datos_Contacto = %s",
                    $this->labAdodb->Param("PK_datos_Contacto"));
            $sqlParam = $this->labAdodb->Prepare($sql);

            $valores = array();

            $valores["PK_datos_Contacto"] = $datos_contacto->getPK_datos_Contacto();

            $this->labAdodb->Execute($sqlParam, $valores) or die($this->labAdodb->ErrorMsg());
        } catch (Exception $e) {
            throw new Exception('No se pudo eliminar el registro (Error generado en el metodo delete de la clase datos_ContactoDao), error:' . $e->getMessage());
        }
    }

    //busca a un Contacto en la base de datos
    //----------------------------------------------------------------------------------

    public function searchById(datos_Contacto $datos_contacto) {


        $returnDatos_Contacto = null;
        try {
            $sql = sprintf("select * from datos_Contacto where  PK_datos_Contacto = %s",
                    $this->labAdodb->Param("PK_datos_Contacto"));
            $sqlParam = $this->labAdodb->Prepare($sql);

            $valores = array();

            $valores["PK_datos_Contacto"] = $datos_contacto->getPK_datos_Contacto();

            $resultSql = $this->labAdodb->Execute($sqlParam, $valores) or die($this->labAdodb->ErrorMsg());

            if ($resultSql->RecordCount() > 0) {
                $returnDatos_Contacto = datos_Contacto::createNulldatos_Contacto();
                $returnDatos_Contacto->setPK_datos_Contacto($resultSql->Fields("PK_datos_Contacto"));
                $returnDatos_Contacto->setFK_cedula($resultSql->Fields("FK_cedula"));
                $returnDatos_Contacto->setcorreo($resultSql->Fields("correo"));
                $returnDatos_Contacto->setnumeroCelular($resultSql->Fields("numeroCelular"));
                $returnDatos_Contacto->setnumeroTrabajo($resultSql->Fields("numeroTrabajo"));
                
            }
        } catch (Exception $e) {
            throw new Exception('No se pudo consultar el registro (Error generado en el metodo searchById de la clase datos_ContactoDao), error:' . $e->getMessage());
        }
        return $returnDatos_Contacto;
    }

    //obtiene la información de los telefonos en la base de datos
    //----------------------------------------------------------------------------------

    public function getAll() {

        try {
            $sql = sprintf("select * from datos_Contacto");
            $resultSql = $this->labAdodb->Execute($sql);
            return $resultSql;
        } catch (Exception $e) {
            throw new Exception('No se pudo obtener los registros (Error generado en el metodo getAll de la clase datos_ContactoDao), error:' . $e->getMessage());
        }
    }

}
