<?php

require_once("../../utlis/adodb5/adodb.inc.php");
require_once("../domain/Telefonos.php");

class TelefonosDao {

    private $labAdodb;

    public function __construct() {
        $driver = 'mysqli';
        $this->labAdodb = newAdoConnection($driver);
        //$this->labAdodb->setCharset('utf8');
        //$this->labAdodb->setConnectionParameter('CharacterSet', 'WE8ISO8859P15');
        $this->labAdodb->Connect("localhost", "root2", "Camacho2", "mydb");
        $this->labAdodb->debug = true;
    }

    //agrega a un telefono a la base de datos
    //----------------------------------------------------------------------------------

    public function add(Telefonos $telefonos) {


        try {
            $sql = sprintf("insert into Direcciones (PK_telefono, FK_cedula, descripcion, LASTUSER, LASTMODIFICATION) 
                                          values (%s,%s,%s,%s,%s,CURDATE())",
                    $this->labAdodb->Param("PK_telefono"),
                    $this->labAdodb->Param("FK_cedula"),
                    $this->labAdodb->Param("descripcion"),
                    $this->labAdodb->Param("LASTUSER"));
            $sqlParam = $this->labAdodb->Prepare($sql);

            $valores = array();

            $valores["PK_telefono"] = $telefonos->getPK_telefono();
            $valores["FK_cedula"] = $telefonos->getFK_cedula();
            $valores["descripcion"] = $telefonos->getdescripcion();
            $valores["LASTUSER"] = $telefonos->getLastUser();

            $this->labAdodb->Execute($sqlParam, $valores) or die($this->labAdodb->ErrorMsg());
        } catch (Exception $e) {
            throw new Exception('No se pudo insertar el registro (Error generado en el metodo add de la clase DireccionesDao), error:' . $e->getMessage());
        }
    }

    //verifica si un telefono existe en la base de datos por ID
    //----------------------------------------------------------------------------------

    public function exist(Telefonos $telefonos) {


        $exist = false;
        try {
            $sql = sprintf("select * from Telefonos where  PK_telefono = %s ",
                    $this->labAdodb->Param("PK_telefono"));
            $sqlParam = $this->labAdodb->Prepare($sql);

            $valores = array();
            $valores["PK_telefono"] = $telefonos->getPK_telefono();

            $resultSql = $this->labAdodb->Execute($sqlParam, $valores) or die($this->labAdodb->ErrorMsg());
            if ($resultSql->RecordCount() > 0) {
                $exist = true;
            }
            return $exist;
        } catch (Exception $e) {
            throw new Exception('No se pudo obtener el registro (Error generado en el metodo exist de la clase TelefonosDao), error:' . $e->getMessage());
        }
    }

    //modifica un Telefono en la base de datos
    //----------------------------------------------------------------------------------

    public function update(Telefonos $telefonos) {


        try {
            $sql = sprintf("update Direcciones set FK_cedula = %s, 
                                                descripcion = %s, 
                                                LASTUSER = %s, 
                                                LASTMODIFICATION = CURDATE() 
                            where PK_telefono = %s",
                    $this->labAdodb->Param("FK_cedula"),
                    $this->labAdodb->Param("descripcion"),
                    $this->labAdodb->Param("LASTUSER"),
                    $this->labAdodb->Param("PK_telefono"));
            $sqlParam = $this->labAdodb->Prepare($sql);

            $valores = array();

            $valores["FK_cedula"] = $telefonos->getFK_cedula();
            $valores["descripcion"] = $telefonos->getdescripcion();
            $valores["PK_telefono"] = $telefonos->getPK_telefono();
            $this->labAdodb->Execute($sqlParam, $valores) or die($this->labAdodb->ErrorMsg());
        } catch (Exception $e) {
            throw new Exception('No se pudo actualizar el registro (Error generado en el metodo update de la clase TelefonosDao), error:' . $e->getMessage());
        }
    }

    //elimina una direccion en la base de datos
    //----------------------------------------------------------------------------------

    public function delete(Telefonos $telefonos) {


        try {
            $sql = sprintf("delete from Telefonos where  PK_telefono = %s",
                    $this->labAdodb->Param("PK_telefono"));
            $sqlParam = $this->labAdodb->Prepare($sql);

            $valores = array();

            $valores["PK_telefono"] = $telefonos->getPK_telefono();

            $this->labAdodb->Execute($sqlParam, $valores) or die($this->labAdodb->ErrorMsg());
        } catch (Exception $e) {
            throw new Exception('No se pudo eliminar el registro (Error generado en el metodo delete de la clase TelefonosDao), error:' . $e->getMessage());
        }
    }

    //busca a un telefono en la base de datos
    //----------------------------------------------------------------------------------

    public function searchById(Telefonos $telefonos) {


        $returnTelefonos = null;
        try {
            $sql = sprintf("select * from Telefonos where  PK_telefono = %s",
                    $this->labAdodb->Param("PK_telefono"));
            $sqlParam = $this->labAdodb->Prepare($sql);

            $valores = array();

            $valores["PK_telefono"] = $telefonos->getPK_telefono();

            $resultSql = $this->labAdodb->Execute($sqlParam, $valores) or die($this->labAdodb->ErrorMsg());

            if ($resultSql->RecordCount() > 0) {
                $returnTelefonos = Direcciones::createNullTelefonos();
                $returnTelefonos->setPK_telefono($resultSql->Fields("PK_telefono"));
                $returnTelefonos->setFK_cedula($resultSql->Fields("FK_cedula"));
                $returnTelefonos->setdescripcion($resultSql->Fields("descripcion"));
            }
        } catch (Exception $e) {
            throw new Exception('No se pudo consultar el registro (Error generado en el metodo searchById de la clase TelefonosDao), error:' . $e->getMessage());
        }
        return $returnTelefonos;
    }

    //obtiene la información de los telefonos en la base de datos
    //----------------------------------------------------------------------------------

    public function getAll() {

        try {
            $sql = sprintf("select * from Telefonos");
            $resultSql = $this->labAdodb->Execute($sql);
            return $resultSql;
        } catch (Exception $e) {
            throw new Exception('No se pudo obtener los registros (Error generado en el metodo getAll de la clase TelefonosDao), error:' . $e->getMessage());
        }
    }

}
