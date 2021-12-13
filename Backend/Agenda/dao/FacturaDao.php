<?php

require_once("../dao/adodb5/adodb.inc.php");
require_once("../domain/Factura.php");

class FacturaDao {

    private $labAdodb;

    public function __construct() {
        $driver = 'mysqli';
        $this->labAdodb = newAdoConnection($driver);
        //$this->labAdodb->setCharset('utf8');
        //$this->labAdodb->setConnectionParameter('CharacterSet', 'WE8ISO8859P15');
        $this->labAdodb->Connect("localhost", "root2", "Camacho2", "mydb");
        $this->labAdodb->debug = false;
    }

    //agrega a una Factura a la base de datos
    //----------------------------------------------------------------------------------

    public function add(Factura $factura) {


        try {
            $sql = sprintf("insert into Factura (idFactura, FechaCompra, CantidadAsientos, FK_cedula, FK_IdRutas) 
                                          values (%s, CURDATE(), %s, %s, %s)",
                    $this->labAdodb->Param("idFactura"),
                    $this->labAdodb->Param("CantidadAsientos"),
                    $this->labAdodb->Param("FK_cedula"),
                    $this->labAdodb->Param("FK_IdRutas"));
            $sqlParam = $this->labAdodb->Prepare($sql);

            $valores = array();

            session_name('Aerolinea');
            session_start();

            if (!(isset($_SESSION['ArregloVal']))) {
                echo ("E~Para relalizar una compra debe inicar sesion");
            } else {
                $arreglo = $_SESSION['ArregloVal']; // obtiene el dato de la sesión
                $valores["idFactura"] = $factura->getidFactura();
                $valores["CantidadAsientos"] = $factura->getCantidadAsiento();
                $valores["FK_cedula"] = $arreglo[1];
                $valores["FK_IdRutas"] = $factura->getFK_IdRutas();
            }
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
            $sql = sprintf("update Factura set CantidadAsientos = %s,
                                                asiento = %s,
                                                FechaCompra = %s,
                                                FK_cedula = %s, 
                                                FK_IdRutas = %s,
                            where idFactura = %s",
                    $this->labAdodb->Param("CantidadAsientos"),
                    $this->labAdodb->Param("asiento"),
                    $this->labAdodb->Param("FechaCompra"),
                    $this->labAdodb->Param("FK_cedula"),
                    $this->labAdodb->Param("FK_IdRutas"),
                    $this->labAdodb->Param("idFactura"));
            $sqlParam = $this->labAdodb->Prepare($sql);

            $valores = array();

            $valores["CantidadAsientos"] = $factura->getCantidadAsiento();
            $valores["asiento"] = $factura->getAsiento();
            $valores["FechaCompra"] = $factura->getFechaCompra();
            $valores["FK_cedula"] = $factura->getFK_cedula();
            $valores["FK_IdRutas"] = $factura->getFK_IdRutas();
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
                $returnfactura->setCantidadAsiento($resultSql->Fields("CantidadAsientos"));
                $returnfactura->setFechaCompra($resultSql->Fields("FechaCompra"));
                $returnfactura->setAsiento($resultSql->Fields("asiento"));
                $returnfactura->setFK_cedula($resultSql->Fields("FK_cedula"));
                $returnfactura->setFK_IdRutas($resultSql->Fields("FK_IdRutas"));
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

    public function FacturadoMes() {

        try {
            $sql = sprintf("SELECT F.FechaCompra, gR.Precio
                            FROM mydb.Factura F
                            JOIN mydb.gestion_rutas gR ON F.FK_IdRutas = gR.PK_IdRutas ");
            $resultSql = $this->labAdodb->Execute($sql);
            return $resultSql;
        } catch (Exception $e) {
            throw new Exception('No se pudo obtener los registros (Error generado en el metodo getAll de la clase FacturaDao), error:' . $e->getMessage());
        }
    }

    public function Reservaciones() {

        try {
            $sql = sprintf("SELECT F.idFactura, F.CantidadAsientos, F.FechaCompra, F.FK_IdRutas, gR.FechaSalida, gR.ruta, gR.Precio
                            FROM mydb.Factura F
                            JOIN mydb.gestion_rutas gR ON F.FK_IdRutas = gR.PK_IdRutas
                            WHERE F.FK_cedula = %s",
                    $this->labAdodb->Param("PK_cedula"));
            $sqlParam = $this->labAdodb->Prepare($sql);

            $valores = array();
            session_name('Aerolinea');
            session_start();
            if (!(isset($_SESSION['ArregloVal']))) {
                echo ("El atributo arregloValores no existe en sesion, por favor ejecutar el archivo php que la crea");
            } else {
                $arreglo = $_SESSION['ArregloVal']; // obtiene el dato de la sesión
                $valores["PK_cedula"] = $arreglo[1];
            }

            $resultSql = $this->labAdodb->Execute($sqlParam, $valores) or die($this->labAdodb->ErrorMsg());
            return $resultSql;
        } catch (Exception $e) {
            throw new Exception('No se pudo obtener los registros (Error generado en el metodo Reservaciones de la clase FacturaDao), error:' . $e->getMessage());
        }
    }

    public function ListaClientes() {//Facturas
        try {
            $sql = sprintf("SELECT P.PK_cedula, P.nombre, P.apellido1, P.apellido2, gR.FK_tipoAvion
                            FROM Factura F
                            JOIN Personas P ON F.FK_cedula = P.PK_cedula
                            JOIN gestion_rutas gR ON F.FK_IdRutas = gR.PK_IdRutas");

            $resultSql = $this->labAdodb->Execute($sql);
            return $resultSql;
        } catch (Exception $e) {
            throw new Exception('No se pudo obtener los registros (Error generado en el metodo ListaClientes de la clase gestionVueloDao), error:' . $e->getMessage());
        }
    }

    public function Historico() {//Facturas
        try {
            $sql = sprintf("SELECT F.idFactura, gR.ruta, F.FechaCompra, gR.Precio
                            FROM Factura F
                            JOIN Personas P ON F.FK_cedula = P.PK_cedula
                            JOIN gestion_rutas gR ON F.FK_IdRutas = gR.PK_IdRutas
                            WHERE F.FK_cedula = %s",
                    $this->labAdodb->Param("PK_cedula"));
            $sqlParam = $this->labAdodb->Prepare($sql);

            $valores = array();
            session_name('Aerolinea');
            session_start();
            if (!(isset($_SESSION['ArregloVal']))) {
                echo ("El atributo arregloValores no existe en sesion, por favor ejecutar el archivo php que la crea");
            } else {
                $arreglo = $_SESSION['ArregloVal']; // obtiene el dato de la sesión
                $valores["PK_cedula"] = $arreglo[1];
            }

            $resultSql = $this->labAdodb->Execute($sqlParam, $valores) or die($this->labAdodb->ErrorMsg());
            return $resultSql;
        } catch (Exception $e) {
            throw new Exception('No se pudo obtener los registros (Error generado en el metodo Historico de la clase FacturaDao), error:' . $e->getMessage());
        }
    }

}
