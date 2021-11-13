<?php

require_once("../../utlis/adodb5/adodb.inc.php");
require_once("../domain/Direcciones.php");

class DireccionesDao {

    private $labAdodb;

    public function __construct() {
        $driver = 'mysqli';
        $this->labAdodb = newAdoConnection($driver);
        //$this->labAdodb->setCharset('utf8');
        //$this->labAdodb->setConnectionParameter('CharacterSet', 'WE8ISO8859P15');
        $this->labAdodb->Connect("localhost", "root2", "Camacho2", "mydb");
        $this->labAdodb->debug = true;
    }

    //agrega a una direccion a la base de datos
    //----------------------------------------------------------------------------------

    public function add(Direcciones $direcciones) {


        try {
            $sql = sprintf("insert into Direcciones (PKA_IdDireccion, FK_cedula, nomlugar, direccion, LASTUSER, LASTMODIFICATION) 
                                          values (%s,%s,%s,%s,%s,%s,CURDATE())",
                    $this->labAdodb->Param("PKA_IdDireccion"),
                    $this->labAdodb->Param("FK_cedula"),
                    $this->labAdodb->Param("nomlugar"),
                    $this->labAdodb->Param("direccion"),
                    $this->labAdodb->Param("LASTUSER"));
            $sqlParam = $this->labAdodb->Prepare($sql);

            $valores = array();

            $valores["PKA_IdDireccion"] = $direcciones->getPKA_IdDireccion();
            $valores["FK_cedula"] = $direcciones->getFK_cedula();
            $valores["nomlugar"] = $direcciones->getnomlugar();
            $valores["direccion"] = $direcciones->getdireccion();
            $valores["LASTUSER"] = $direcciones->getLastUser();

            $this->labAdodb->Execute($sqlParam, $valores) or die($this->labAdodb->ErrorMsg());
        } catch (Exception $e) {
            throw new Exception('No se pudo insertar el registro (Error generado en el metodo add de la clase DireccionesDao), error:' . $e->getMessage());
        }
    }

    //verifica si una direccion existe en la base de datos por ID
    //----------------------------------------------------------------------------------

    public function exist(Direcciones $direcciones) {


        $exist = false;
        try {
            $sql = sprintf("select * from Direcciones where  PKA_IdDireccion = %s ",
                    $this->labAdodb->Param("PKA_IdDireccion"));
            $sqlParam = $this->labAdodb->Prepare($sql);

            $valores = array();
            $valores["PKA_IdDireccion"] = $direcciones->getPKA_IdDireccion();

            $resultSql = $this->labAdodb->Execute($sqlParam, $valores) or die($this->labAdodb->ErrorMsg());
            if ($resultSql->RecordCount() > 0) {
                $exist = true;
            }
            return $exist;
        } catch (Exception $e) {
            throw new Exception('No se pudo obtener el registro (Error generado en el metodo exist de la clase DireccionesDao), error:' . $e->getMessage());
        }
    }

    //modifica una direccion en la base de datos
    //----------------------------------------------------------------------------------

    public function update(Direcciones $direcciones) {


        try {
            $sql = sprintf("update Direcciones set FK_cedula = %s, 
                                                nomLugar = %s, 
                                                direccion = %s,
                                                LASTUSER = %s, 
                                                LASTMODIFICATION = CURDATE() 
                            where PKA_IdDireccion = %s",
                    $this->labAdodb->Param("FK_cedula"),
                    $this->labAdodb->Param("nomLugar"),
                    $this->labAdodb->Param("direccion"),
                    $this->labAdodb->Param("LASTUSER"),
                    $this->labAdodb->Param("PKA_IdDireccion"));
            $sqlParam = $this->labAdodb->Prepare($sql);

            $valores = array();

            $valores["FK_cedula"] = $direcciones->getFK_cedula();
            $valores["nomLugar"] = $direcciones->getnomLugar();
            $valores["direccion"] = $direcciones->getdireccion();
            $valores["PKA_IdDireccion"] = $direcciones->getPKA_IdDireccion();
            $this->labAdodb->Execute($sqlParam, $valores) or die($this->labAdodb->ErrorMsg());
        } catch (Exception $e) {
            throw new Exception('No se pudo actualizar el registro (Error generado en el metodo update de la clase DireccionesDao), error:' . $e->getMessage());
        }
    }

    //elimina una direccion en la base de datos
    //----------------------------------------------------------------------------------

    public function delete(Direcciones $direcciones) {


        try {
            $sql = sprintf("delete from Direciones where  PKA_IdDireccion = %s",
                    $this->labAdodb->Param("PKA_IdDireccion"));
            $sqlParam = $this->labAdodb->Prepare($sql);

            $valores = array();

            $valores["PKA_IdDireccion"] = $direcciones->getPKA_IdDireccion();

            $this->labAdodb->Execute($sqlParam, $valores) or die($this->labAdodb->ErrorMsg());
        } catch (Exception $e) {
            throw new Exception('No se pudo eliminar el registro (Error generado en el metodo delete de la clase DireccionesDao), error:' . $e->getMessage());
        }
    }

    //busca a una direccion en la base de datos
    //----------------------------------------------------------------------------------

    public function searchById(Direcciones $direcciones) {


        $returnDirecciones = null;
        try {
            $sql = sprintf("select * from Direcciones where  PKA_IdDireccion = %s",
                    $this->labAdodb->Param("PKA_IdDireccion"));
            $sqlParam = $this->labAdodb->Prepare($sql);

            $valores = array();

            $valores["PKA_IdDireccion"] = $direcciones->getPKA_IdDireccion();

            $resultSql = $this->labAdodb->Execute($sqlParam, $valores) or die($this->labAdodb->ErrorMsg());

            if ($resultSql->RecordCount() > 0) {
                $returnDirecciones = Direcciones::createNullDirecciones();
                $returnDirecciones->setPKA_IdDireccion($resultSql->Fields("PKA_IdDireccion"));
                $returnDirecciones->setFK_cedula($resultSql->Fields("FK_cedula"));
                $returnDirecciones->setnomLugar($resultSql->Fields("nomLugar"));
                $returnDirecciones->setdireccion($resultSql->Fields("direccion"));
            }
        } catch (Exception $e) {
            throw new Exception('No se pudo consultar el registro (Error generado en el metodo searchById de la clase DireccionesDao), error:' . $e->getMessage());
        }
        return $returnDirecciones;
    }

    //obtiene la información de las direcciones en la base de datos
    //----------------------------------------------------------------------------------

    public function getAll() {

        try {
            $sql = sprintf("select * from Direcciones");
            $resultSql = $this->labAdodb->Execute($sql);
            return $resultSql;
        } catch (Exception $e) {
            throw new Exception('No se pudo obtener los registros (Error generado en el metodo getAll de la clase DireccionesDao), error:' . $e->getMessage());
        }
    }

}
