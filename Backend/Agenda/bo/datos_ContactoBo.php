<?php

require_once("../domain/datos_Contacto.php");
require_once("../dao/datos_ContactoDao.php");

class datos_ContactoBo {

    private $datos_ContactoDao;

    public function __construct() {
        $this->datos_ContactoDao = new datos_ContactoDao();
    }

    public function getdatos_ContactoDao() {
        return $this->datos_ContactoDao;
    }

    public function setdatos_ContactoDao(datos_Contacto $datos_Contacto) {
        $this->datos_ContactoDao = $datos_Contacto;
    }

    //agrega a un Contacto a la base de datos
    //----------------------------------------------------------------------------------

    public function add(datos_Contacto $datos_Contacto) {
        try {
            if (!$this->datos_ContactoDao->exist($datos_Contacto)) {
                $this->datos_ContactoDao->add($datos_Contacto);
            } else {
                throw new Exception("El contacto ya existe en la base de datos!!");
            }
        } catch (Exception $e) {
            throw $e;
        }
    }

    //modifica a un contacto a la base de datos
    //----------------------------------------------------------------------------------

    public function update(datos_Contacto $datos_Contacto) {
        try {
            $this->datos_ContactoDao->update($datos_Contacto);
        } catch (Exception $e) {
            throw $e;
        }
    }

    //eliminar a un contacto a la base de datos
    //----------------------------------------------------------------------------------

    public function delete(datos_Contacto $datos_Contacto) {
        try {
            $this->datos_ContactoDao->delete($datos_Contacto);
        } catch (Exception $e) {
            throw $e;
        }
    }

    //consulta a un contacto a la base de datos
    //----------------------------------------------------------------------------------

    public function searchById(datos_Contacto $datos_Contacto) {
        try {
            return $this->datos_ContactoDao->searchById($datos_Contacto);
        } catch (Exception $e) {
            throw $e;
        }
    }

    //consultar todos los contectos de la base de datos
    //----------------------------------------------------------------------------------

    public function getAll() {
        try {
            return $this->datos_ContactoDao->getAll();
        } catch (Exception $e) {
            throw $e;
        }
    }

}
?>

