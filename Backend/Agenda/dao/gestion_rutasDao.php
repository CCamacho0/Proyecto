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
    //agrega a una persona a la base de datos
    //----------------------------------------------------------------------------------

    public function add(gestion_rutas $gestion_rutas) {

        try {
            $sql = sprintf("insert into gestion_rutas(PK_IdRutas, ruta, duracion, FechaSalida, Precio, lastUser, lastModification)
                                        values (%s, %s, %s, %s, %s, %s, CURDATE())",
                    $this->labAdodb->Param("PK_IdRutas"),
                    $this->labAdodb->Param("ruta"),
                    $this->labAdodb->Param("duracion"),
                    $this->labAdodb->Param("FechaSalida"),
                    $this->labAdodb->Param("Precio"),
                    $this->labAdodb->Param("lastUser"));
            $sqlParam = $this->labAdodb->Prepare($sql);

            $valores = array();

            $valores["PK_IdRutas"] = $gestion_rutas->getPK_IdRutas();
            $valores["ruta"] = $gestion_rutas->getruta();
            $valores["duracion"] = $gestion_rutas->getduracion();
            $valores["FechaSalida"] = $gestion_rutas->getFechaSalida();
            $valores["Precio"] = $gestion_rutas->getPrecio();
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
            $sql = sprintf("select * from gestion_rutas where PK_IdRutas = %s ",
                    $this->labAdodb->Param("PK_IdRutas"));
            $sqlParam = $this->labAdodb->Prepare($sql);

            $valores = array();
            $valores["PK_IdRutas"] = $gestion_rutas->getPK_IdRutas();

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
                                                    FechaSalida = %s,
                                                    Precio = %s,
                                                    LASTUSER = %s, 
                                                    LASTMODIFICATION = CURDATE(),
                                                    
                            where PK_IdRutas = %s",
                    $this->labAdodb->Param("ruta"),
                    $this->labAdodb->Param("duracion"),
                    $this->labAdodb->Param("FechaSalida"),
                    $this->labAdodb->Param("Precio"),
                    $this->labAdodb->Param("LASTUSER"),
                    $this->labAdodb->Param("PK_IdRutas"));

            $sqlParam = $this->labAdodb->Prepare($sql);

            $valores = array();

            $valores["FechaSalida"] = $gestion_rutas->getFechaSalida();
            $valores["ruta"] = $gestion_rutas->getruta();
            $valores["duracion"] = $gestion_rutas->getduracion();
            $valores["Precio"] = $gestion_rutas->getPrecio();
            $valores["LASTUSER"] = $gestion_rutas->getLastUser();
            $valores["PK_IdRutas"] = $gestion_rutas->getPK_IdRutas();

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
            $sql = sprintf("delete from gestion_rutas where PK_IdRutas = %s",
                    $this->labAdodb->Param("PK_IdRutas"));
            $sqlParam = $this->labAdodb->Prepare($sql);

            $valores = array();

            $valores["PK_IdRutas"] = $gestion_rutas->getPK_IdRutas();

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
            $sql = sprintf("select * from gestion_rutas where PK_IdRutas = %s",
                    $this->labAdodb->Param("PK_IdRutas"));
            $sqlParam = $this->labAdodb->Prepare($sql);

            $valores = array();

            $valores["PK_IdRutas"] = $gestion_rutas->getPK_IdRutas();

            $resultSql = $this->labAdodb->Execute($sqlParam, $valores) or die($this->labAdodb->ErrorMsg());

            if ($resultSql->RecordCount() > 0) {
                $returngestion_rutas = gestion_rutas::createNullgestion_rutas();
                $returngestion_rutas->setPK_IdRutas($resultSql->Fields("PK_IdRutas"));
                $returngestion_rutas->setruta($resultSql->Fields("ruta"));
                $returngestion_rutas->setduracion($resultSql->Fields("duracion"));
                $returngestion_rutas->setFechaSalida($resultSql->Fields("FechaSalida"));
                $returngestion_rutas->setPrecio($resultSql->Fields("Precio"));
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