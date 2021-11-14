<?php

require_once("../../utlis/adodb5/adodb.inc.php");
require_once("../domain/Factura.php");

class FacturaDao {

    private $labAdodb;

    public function __construct() {
        $driver = 'mysqli';
        $this->labAdodb = newAdoConnection($driver);
        //$this->labAdodb->setCharset('utf8');
        //$this->labAdodb->setConnectionParameter('CharacterSet', 'WE8ISO8859P15');
        $this->labAdodb->Connect("localhost", "root2", "Camacho2", "mydb");
        $this->labAdodb->debug = true;
    }

    //agrega a una Factura a la base de datos
    //----------------------------------------------------------------------------------

    public function add(Factura $factura) {


        try {
            $sql = sprintf("insert into Factura (idFactura, Detalle, FK_cedula, FK_idgestionVuelo) 
                                          values (%s,%s,%s,%s,CURDATE())",
                    $this->labAdodb->Param("idFactura"),
                    $this->labAdodb->Param("Detalle"),
                    $this->labAdodb->Param("FK_cedula"),
                    $this->labAdodb->Param("FK_idgestionVuelo"));
            $sqlParam = $this->labAdodb->Prepare($sql);

            $valores = array();

            $valores["idFactura"] = $factura->getidFactura();
            $valores["Detalle"] = $factura->getDetalle();
            $valores["FK_cedula"] = $factura->getFK_cedula();
            $valores["FK_idgestionVuelo"] = $factura->getFK_idgestionVuelo();

            $this->labAdodb->Execute($sqlParam, $valores) or die($this->labAdodb->ErrorMsg());
        } catch (Exception $e) {
            throw new Exception('No se pudo insertar el registro (Error generado en el metodo add de la clase FacturaDao), error:' . $e->getMessage());
        }
    }

    //verifica si una factura existe en la base de datos por ID
    //----------------------------------------------------------------------------------

    public function exist(Factura $factura) {


        $exist = false;
        try {
            $sql = sprintf("select * from Factura where  idFactura = %s ",
                    $this->labAdodb->Param("idFactura"));
            $sqlParam = $this->labAdodb->Prepare($sql);

            $valores = array();
            $valores["idFactura"] = $factura->getidFactura();

            $resultSql = $this->labAdodb->Execute($sqlParam, $valores) or die($this->labAdodb->ErrorMsg());
            if ($resultSql->RecordCount() > 0) {
                $exist = true;
            }
            return $exist;
        } catch (Exception $e) {
            throw new Exception('No se pudo obtener el registro (Error generado en el metodo exist de la clase FacturaDao), error:' . $e->getMessage());
        }
    }

    //modifica una factura en la base de datos
    //----------------------------------------------------------------------------------

    public function update(Factura $factura) {


        try {
            $sql = sprintf("update Factura set Detalle = %s, 
                                                FK_cedula = %s, 
                                                FK_idgestionVuelo = %s,
                            where idFactura = %s",
                    $this->labAdodb->Param("Detalle"),
                    $this->labAdodb->Param("FK_cedula"),
                    $this->labAdodb->Param("FK_idgestionVuelo"));
            $sqlParam = $this->labAdodb->Prepare($sql);

            $valores = array();
            
            $valores["Detalle"] = $factura->getDetalle();
            $valores["FK_cedula"] = $factura->getFK_cedula();
            $valores["FK_idgestionVuelo"] = $factura->getFK_idgestionVuelo();
            $valores["idFactura"] = $factura->getidFactura();
            $this->labAdodb->Execute($sqlParam, $valores) or die($this->labAdodb->ErrorMsg());
        } catch (Exception $e) {
            throw new Exception('No se pudo actualizar el registro (Error generado en el metodo update de la clase FacturaDao), error:' . $e->getMessage());
        }
    }

    //elimina una direccion en la base de datos
    //----------------------------------------------------------------------------------

    public function delete(Factura $factura) {


        try {
            $sql = sprintf("delete from Factura where  idFactura = %s",
                    $this->labAdodb->Param("idFactura"));
            $sqlParam = $this->labAdodb->Prepare($sql);

            $valores = array();

            $valores["idFactura"] = $factura->getidFactura();

            $this->labAdodb->Execute($sqlParam, $valores) or die($this->labAdodb->ErrorMsg());
        } catch (Exception $e) {
            throw new Exception('No se pudo eliminar el registro (Error generado en el metodo delete de la clase FacturaDao), error:' . $e->getMessage());
        }
    }

    //busca a una direccion en la base de datos
    //----------------------------------------------------------------------------------

    public function searchById(Factura $factura) {


        $returnfactura = null;
        try {
            $sql = sprintf("select * from Factura where  idFactura = %s",
                    $this->labAdodb->Param("idFactura"));
            $sqlParam = $this->labAdodb->Prepare($sql);

            $valores = array();

            $valores["idFactura"] = $factura->getidFactura();

            $resultSql = $this->labAdodb->Execute($sqlParam, $valores) or die($this->labAdodb->ErrorMsg());

            if ($resultSql->RecordCount() > 0) {
                $returnfactura = Factura::createNullFactura();
                $returnfactura->setidFactura($resultSql->Fields("idFactura"));
                $returnfactura->setDetalle($resultSql->Fields("Detalle"));
                $returnfactura->setFK_cedula($resultSql->Fields("FK_cedula"));
                $returnfactura->setFK_idgestionVuelo($resultSql->Fields("FK_idgestionVuelo"));
            }
        } catch (Exception $e) {
            throw new Exception('No se pudo consultar el registro (Error generado en el metodo searchById de la clase FacturaDao), error:' . $e->getMessage());
        }
        return $returnfactura;
    }

    //obtiene la información de las direcciones en la base de datos
    //----------------------------------------------------------------------------------

    public function getAll() {

        try {
            $sql = sprintf("select * from Factura");
            $resultSql = $this->labAdodb->Execute($sql);
            return $resultSql;
        } catch (Exception $e) {
            throw new Exception('No se pudo obtener los registros (Error generado en el metodo getAll de la clase FacturaDao), error:' . $e->getMessage());
        }
    }

}

