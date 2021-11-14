<?php

require_once("../domain/Factura.php");
require_once("../dao/FacturaDao.php");

class FacturaBo {

    private $facturaDao;

    public function __construct() {
        $this->facturaDao = new FacturaDao();
    }

    public function getPersonasDao() {
        return $this->facturaDao;
    }

    public function setPersonasDao(FacturaDao $facturaDao) {
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

}

//end of the class FacturaBo
?>

