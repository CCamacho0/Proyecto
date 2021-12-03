<?php

require_once ("../dao/adodb5/adodb.inc.php");
require_once ("../domain/gestion_rutas.php");

class gestion_rutasDao {

    private $labAdodb;

    public function __construct() {
        $driver = 'mysqli';
        $this->labAdodb = newAdoConnection($driver);
        //$this->labAdodb->setCharset('utf8');
        //$this->labAdodb->setConnectionParameter('CharacterSet', 'WE8ISO8859P15');
        $this->labAdodb->Connect("localhost", "root2", "Camacho2", "mydb");
        $this->labAdodb->debug = false;
    }

    //***********************************************************
    //agrega a una ruta a la base de datos
    //***********************************************************


    public function add(gestion_rutas $gestion_rutas) {

        try {

            $sql = sprintf("insert into gestion_rutas(idgestion_rutas, ruta, duracion, dia_semana_hora, lastUser, lastModification)
                                        values (%s,%s,%s,%s, %s, CURDATE())",
                    $this->labAdodb->Param("idgestion_rutas"),
                    $this->labAdodb->Param("ruta"),
                    $this->labAdodb->Param("duracion"),
                    $this->labAdodb->Param("dia_semana_hora"),
                    $this->labAdodb->Param("LASTUSER"));

            $sqlParam = $this->labAdodb->Prepare($sql);

            $valores = array();

            $valores["idgestion_rutas"] = $gestion_rutas->getidgestion_rutas();
            $valores["ruta"] = $gestion_rutas->getruta();
            $valores["duracion"] = $gestion_rutas->getduracion();
            $valores["dia_semana_hora"] = $gestion_rutas->getdia_semana_hora();
            $valores["LASTUSER"] = $gestion_rutas->getLastUser();

            $this->labAdodb->Execute($sqlParam, $valores) or die($this->labAdodb->ErrorMsg());
        } catch (Exception $e) {
            throw new Exception('No se pudo insertar el registro (Error generado en el metodo add de la clase gestion_rutasDao), error:' . $e->getMessage());
        }
    }

    //verifica si una persona existe en la base de datos por ID
    //----------------------------------------------------------------------------------

    public function exist(gestion_rutas $gestion_rutas) {

        $exist = false;
        try {
            $sql = sprintf("select * from gestion_rutas where idgestion_rutas = %s ",
                    $this->labAdodb->Param("idgestion_rutas"));
            $sqlParam = $this->labAdodb->Prepare($sql);

            $valores = array();
            $valores["idgestion_rutas"] = $gestion_rutas->getidgestion_rutas();

            $resultSql = $this->labAdodb->Execute($sqlParam, $valores) or die($this->labAdodb->ErrorMsg());
            if ($resultSql->RecordCount() > 0) {
                $exist = true;
            }
            return $exist;
        } catch (Exception $e) {
            throw new Exception('No se pudo obtener el registro (Error generado en el metodo exist de la clase gestion_rutasDao), error:' . $e->getMessage());
        }
    }

    //***********************************************************
    //Modifica una ruta en la base de datos
    //***********************************************************

    public function update(gestion_rutas $gestion_rutas) {


        try {
            $sql = sprintf("update gestion_rutas set ruta = %s,   
                                                    duracion = %s,
                                                    dia_semana_hora = %s,
                                                    LASTUSER = %s, 
                                                    LASTMODIFICATION = CURDATE(),
                                                    
                            where idgestion_rutas = %s",
                    $this->labAdodb->Param("ruta"),
                    $this->labAdodb->Param("duracion"),
                    $this->labAdodb->Param("dia_semana_hora"),
                    $this->labAdodb->Param("LASTUSER"),
                    $this->labAdodb->Param("idgestion_rutas"));

            $sqlParam = $this->labAdodb->Prepare($sql);

            $valores = array();

            $valores["dia_semana_hora"] = $gestion_rutas->getdia_semana_hora();
            $valores["ruta"] = $gestion_rutas->getruta();
            $valores["duracion"] = $gestion_rutas->getduracion();
            $valores["LASTUSER"] = $gestion_rutas->getLastUser();
            $valores["idgestion_rutas"] = $gestion_rutas->getidgestion_rutas();

            $this->labAdodb->Execute($sqlParam, $valores) or die($this->labAdodb->ErrorMsg());
        } catch (Exception $e) {
            throw new Exception('No se pudo actualizar el registro (Error generado en el metodo update de la clase gestion_rutasDao), error:' . $e->getMessage());
        }
    }

    //***********************************************************
    //elimina una ruta en la base de datos
    //***********************************************************


    public function delete(gestion_rutas $gestion_rutas) {


        try {
            $sql = sprintf("delete from gestion_rutas where idgestion_rutas = %s",
                    $this->labAdodb->Param("idgestion_rutas"));
            $sqlParam = $this->labAdodb->Prepare($sql);

            $valores = array();

            $valores["idgestion_rutas"] = $gestion_rutas->getidgestion_rutas();

            $this->labAdodb->Execute($sqlParam, $valores) or die($this->labAdodb->ErrorMsg());
        } catch (Exception $e) {
            throw new Exception('No se pudo eliminar el registro (Error generado en el metodo delete de la clase gestion_rutasDao), error:' . $e->getMessage());
        }
    }

    //***********************************************************
    //busca una gestion de vuelo en la base de datos
    //***********************************************************

    public function searchById(gestion_rutas $gestion_rutas) {

        $returngestion_rutas = null;
        try {
            $sql = sprintf("select * from gestion_rutas where idgestion_rutas = %s",
                    $this->labAdodb->Param("idgestion_rutas"));
            $sqlParam = $this->labAdodb->Prepare($sql);

            $valores = array();

            $valores["idgestion_rutas"] = $gestion_rutas->getidgestion_rutas();

            $resultSql = $this->labAdodb->Execute($sqlParam, $valores) or die($this->labAdodb->ErrorMsg());

            if ($resultSql->RecordCount() > 0) {
                $returngestion_rutas = gestion_rutas::createNullgestion_rutas();
                $returngestion_rutas->setidgestion_rutas($resultSql->Fields("idgestion_rutas"));
                $returngestion_rutas->setruta($resultSql->Fields("ruta"));
                $returngestion_rutas->setduracion($resultSql->Fields("duracion"));
                $returngestion_rutas->setdia_semana_hora($resultSql->Fields("dia_semana_hora"));
            }
        } catch (Exception $e) {
            throw new Exception('No se pudo consultar el registro (Error generado en el metodo searchById de la clase gestion_rutasDao), error:' . $e->getMessage());
        }
        return $returngestion_rutas;
    }
    //obtiene la información de las gestiones de vuelo en la base de datos
    //***********************************************************

    public function getAll() {

        try {
            $sql = sprintf("select * from gestion_rutas");
            $resultSql = $this->labAdodb->Execute($sql);
            return $resultSql;
        } catch (Exception $e) {
            throw new Exception('No se pudo obtener los registros (Error generado en el metodo getAll de la clase gestion_rutasDao), error:' . $e->getMessage());
        }
    }
}
//fin de la clase gestion_rutasDao