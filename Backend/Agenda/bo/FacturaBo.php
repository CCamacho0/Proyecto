<?php

require_once("../domain/Factura.php");
require_once("../dao/FacturaDao.php");

class FacturaBo {

    private $facturaDao;

    public function __construct() {
        $this->facturaDao = new FacturaDao();
    }

    public function getFacturaDao() {
        return $this->facturaDao;
    }

    public function setFacturaDao(FacturaDao $facturaDao) {
        $this->facturaDao = $facturaDao;
    }

    //agrega a una factura a la base de datos
    //----------------------------------------------------------------------------------

    public function add(Factura $factura) {
        try {
            if (!$this->facturaDao->exist($factura)) {
                $this->facturaDao->add($factura);
            } else {
                throw new Exception("La factura ya existe en la base de datos!!");
            }
        } catch (Exception $e) {
            throw $e;
        }
    }

    //modifica a una factura a la base de datos
    //----------------------------------------------------------------------------------

    public function update(Factura $factura) {
        try {
            $this->facturaDao->update($factura);
        } catch (Exception $e) {
            throw $e;
        }
    }

    //eliminar a una factura a la base de datos
    //----------------------------------------------------------------------------------

    public function delete(Factura $factura) {
        try {
            $this->facturaDao->delete($factura);
        } catch (Exception $e) {
            throw $e;
        }
    }

    //consulta a una factura a la base de datos
    //----------------------------------------------------------------------------------

    public function searchById(Factura $factura) {
        try {
            return $this->facturaDao->searchById($factura);
        } catch (Exception $e) {
            throw $e;
        }
    }

    //consultar todas las facturas de la base de datos
    //----------------------------------------------------------------------------------

    public function getAll() {
        try {
            return $this->facturaDao->getAll();
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function FacturadoMes() {
        try {
            return $this->facturaDao->FacturadoMes();
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function Reservaciones() {
        try {
            return $this->facturaDao->Reservaciones();
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function ListaClientes() {
        try {
            return $this->facturaDao->ListaClientes();
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function Historico() {
        try {
            return $this->facturaDao->Historico();
        } catch (Exception $e) {
            throw $e;
        }
    }
}

//end of the class FacturaBo
?>

