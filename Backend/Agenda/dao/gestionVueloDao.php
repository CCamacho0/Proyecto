<?php

require_once ("../dao/adodb5/adodb.inc.php");
require_once ("../domain/gestionVuelo.php");

class gestionVueloDao {

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
    //agrega a una gestion de vuelo a la base de datos
    //***********************************************************


    public function add(gestionVuelo $gestionVuelo) {

        try {

            $sql = sprintf("insert into gestionVuelo(idgestionVuelo, FK_tipoAvion, FK_IdRutas, lastUser, lastModification)
                                        values (%s, %s, %s, %s, CURDATE())",
                    $this->labAdodb->Param("idgestionVuelo"),
                    $this->labAdodb->Param("FK_tipoAvion"),
                    $this->labAdodb->Param("FK_IdRutas"),
                    $this->labAdodb->Param("LASTUSER"));

            $sqlParam = $this->labAdodb->Prepare($sql);

            $valores = array();

            $valores["idgestionVuelo"] = $gestionVuelo->getidgestionVuelo();
            $valores["FK_tipoAvion"] = $gestionVuelo->getFK_tipoAvion();
            $valores["FK_IdRutas"] = $gestionVuelo->getFK_IdRutas();
            $valores["LASTUSER"] = $gestionVuelo->getLastUser();
            $this->labAdodb->Execute($sqlParam, $valores) or die($this->labAdodb->ErrorMsg());
        } catch (Exception $e) {
            throw new Exception('No se pudo insertar el registro (Error generado en el metodo add de la clase gestionVueloDao), error:' . $e->getMessage());
        }
    }

    //***********************************************************
    //verifica si una gestion de vuelo existe en la base de datos por ID
    //***********************************************************

    public function exist(gestionVuelo $gestionVuelo) {


        $exist = false;
        try {
            $sql = sprintf("select * from gestionVuelo where idgestionVuelo = %s ",
                    $this->labAdodb->Param("idgestionVuelo"));
            $sqlParam = $this->labAdodb->Prepare($sql);

            $valores = array();
            $valores["idgestionVuelo"] = $gestionVuelo->getidgestionVuelo();

            $resultSql = $this->labAdodb->Execute($sqlParam, $valores) or die($this->labAdodb->ErrorMsg());
            if ($resultSql->RecordCount() > 0) {
                $exist = false;
            }
            return $exist;
        } catch (Exception $e) {
            throw new Exception('No se pudo obtener el registro (Error generado en el metodo exist de la clase gestionVueloDao), error:' . $e->getMessage());
        }
    }

    //***********************************************************
    //Modifica una gestion de vuelo en la base de datos
    //***********************************************************

    public function update(gestionVuelo $gestionVuelo) {


        try {
            $sql = sprintf("update gestionVuelo set LASTUSER = %s, 
                                                LASTMODIFICATION = CURDATE() 
                                                FK_tipoAvion = %s,
                                                FK_IdRutas = %s,

                            where idgestionVuelo = %s",
                    $this->labAdodb->Param("LASTUSER"),
                    $this->labAdodb->Param("FK_tipoAvion"),
                    $this->labAdodb->Param("FK_IdRutas"));

            $sqlParam = $this->labAdodb->Prepare($sql);

            $valores = array();

            $valores["LASTUSER"] = $gestionVuelo->getLastUser();
            $valores["FK_tipoAvion"] = $gestionVuelo->getFK_tipoAvion();
            $valores["FK_IdRutas"] = $gestionVuelo->getFK_IdRutas();

            $this->labAdodb->Execute($sqlParam, $valores) or die($this->labAdodb->ErrorMsg());
        } catch (Exception $e) {
            throw new Exception('No se pudo actualizar el registro (Error generado en el metodo update de la clase gestionVueloDao), error:' . $e->getMessage());
        }
    }

    //***********************************************************
    //elimina una gestion de avión en la base de datos
    //***********************************************************


    public function delete(gestionVuelo $gestionVuelo) {


        try {
            $sql = sprintf("delete from gestionVuelo where idgestion_Vuelo = %s",
                    $this->labAdodb->Param("idgestion_Vuelo"));
            $sqlParam = $this->labAdodb->Prepare($sql);

            $valores = array();

            $valores["idgestion_Vuelo"] = $gestionVuelo->getidgestion_Vuelo();

            $this->labAdodb->Execute($sqlParam, $valores) or die($this->labAdodb->ErrorMsg());
        } catch (Exception $e) {
            throw new Exception('No se pudo eliminar el registro (Error generado en el metodo delete de la clase gestionVueloDao), error:' . $e->getMessage());
        }
    }

    //***********************************************************
    //busca una gestion de vuelo en la base de datos
    //***********************************************************

    public function searchById(gestionVuelo $gestionVuelo) {


        $returngestionVuelo = null;
        try {
            $sql = sprintf("select * from gestionVuelo where idgestionVuelo = %s",
                    $this->labAdodb->Param("idgestionVuelo"));
            $sqlParam = $this->labAdodb->Prepare($sql);

            $valores = array();

            $valores["idgestionVuelo"] = $gestionVuelo->getidgestionVuelo();

            $resultSql = $this->labAdodb->Execute($sqlParam, $valores) or die($this->labAdodb->ErrorMsg());

            if ($resultSql->RecordCount() > 0) {
                $returngestionVuelo = gestionVuelo::createNullgestionVuelo();
                $returngestionVuelo->setidgestionVuelo($resultSql->Fields("idgestionVuelo"));
                $returngestionVuelo->setFK_tipoAvion($resultSql->Fields("FK_tipoAvion"));
                $returngestionVuelo->setFK_IdRutas($resultSql->Fields("FK_IdRutas"));
            }
        } catch (Exception $e) {
            throw new Exception('No se pudo consultar el registro (Error generado en el metodo searchById de la clase gestionVueloDao), error:' . $e->getMessage());
        }
        return $returnDirecciones;
    }

    public function ListaClientes() {
        try {
            $sql = sprintf("SELECT P.PK_cedula, P.nombre, P.apellido1, P.apellido2, Gv.FK_tipoAvion
                            FROM Factura F
                            JOIN Personas P ON F.FK_cedula = P.PK_cedula
                            JOIN gestionVuelo Gv ON F.FK_idgestionVuelo = Gv.idgestionVuelo");

            $resultSql = $this->labAdodb->Execute($sql);
            return $resultSql;
        } catch (Exception $e) {
            throw new Exception('No se pudo obtener los registros (Error generado en el metodo ListaClientes de la clase gestionVueloDao), error:' . $e->getMessage());
        }
    }
    
    public function RutasPop() {
        try {
            $sql = sprintf("SELECT gR.PK_IdRutas, gR.ruta, SUM(gR.Precio) Total
                            FROM mydb.gestionVuelo gV
                            JOIN mydb.Factura F ON gV.idgestionVuelo = F.FK_idgestionVuelo
                            JOIN mydb.gestion_rutas gR ON gV.PK_IdRutas = gR.PK_IdRutas
                            WHERE F.idFactura IS NOT null
                            GROUP BY gR.PK_IdRutas, gR.ruta
                            ORDER BY Total DESC
                            LIMIT 5");

            $resultSql = $this->labAdodb->Execute($sql);
            return $resultSql;
        } catch (Exception $e) {
            throw new Exception('No se pudo obtener los registros (Error generado en el metodo RutasPop de la clase gestionVueloDao), error:' . $e->getMessage());
        }
    }

    public function getAll() {

        try {
            $sql = sprintf("select * from gestionVuelo");
            $resultSql = $this->labAdodb->Execute($sql);
            return $resultSql;
        } catch (Exception $e) {
            throw new Exception('No se pudo obtener los registros (Error generado en el metodo getAll de la clase gestionVueloDao), error:' . $e->getMessage());
        }
    }

}
