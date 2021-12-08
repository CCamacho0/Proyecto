<?php

require_once("../domain/gestionVuelo.php");
require_once("../dao/gestionVueloDao.php");

class gestionVueloBo {

    private $gestionVueloDao;

    public function __construct() {
        $this->gestionVueloDao = new gestionVueloDao();
    }

    public function getgestionVueloDao() {
        return $this->gestionVueloDao;
    }

    public function setgestionVueloDao(GestionVueloDao $gestionVueloDao) {
        $this->gestionVueloDao = $gestionVueloDao;
    }

    //agrega a una gestion de  a la base de datos
    //----------------------------------------------------------------------------------

    public function add(GestionVuelo $gestionVuelo) {
        try {
            if (!$this->gestionVueloDao->exist($gestionVuelo)) {
                $this->gestionVueloDao->add($gestionVuelo);
            } else {
                throw new Exception("La gestion de vuelo ya existe en la base de datos!!");
            }
        } catch (Exception $e) {
            throw $e;
        }
    }

    //modifica a una gestion de vuelo a la base de datos
    //----------------------------------------------------------------------------------

    public function update(GestionVuelo $gestionVuelo) {
        try {
            $this->gestionVueloDao->update($gestionVuelo);
        } catch (Exception $e) {
            throw $e;
        }
    }

    //eliminar a una gestion de vuelo de la base de datos
    //----------------------------------------------------------------------------------

    public function delete(GestionVuelo $gestionVuelo) {
        try {
            $this->gestionVueloDao->delete($gestionVuelo);
        } catch (Exception $e) {
            throw $e;
        }
    }

    //consulta a una gestion de vuelo a la base de datos
    //----------------------------------------------------------------------------------

    public function searchById(GestionVuelo $gestionVuelo) {
        try {
            return $this->gestionVueloDao->searchById($gestionVuelo);
        } catch (Exception $e) {
            throw $e;
        }
    }

    //consultar todas las gestiones de vuelo de la base de datos
    //----------------------------------------------------------------------------------

    public function getAll() {
        try {
            return $this->gestionVueloDao->getAll();
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function ListaClientes() {
        try {
            return $this->gestionVueloDao->ListaClientes();
        } catch (Exception $e) {
            throw $e;
        }
    }
}

//end of the class gestionVueloBo
?>



