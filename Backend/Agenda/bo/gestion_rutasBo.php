<?php

require_once("../domain/gestion_rutas.php");
require_once("../dao/gestion_rutasDao.php");

class gestion_rutasBo{

    private $gestion_rutasDao;

    public function __construct() {
        $this->gestion_rutasDao = new GestionRutasDao();
    }

    public function getgestion_rutasDao(){
        return $this->gestion_rutasDao;
    }

    public function setgestion_rutasDao(GestionRutasDao $gestion_rutasDao) {
        $this->gestion_rutasDao = $gestion_rutasDao;
    }

    //agrega a una gestion de  a la base de datos
    //----------------------------------------------------------------------------------

    public function add(GestionVuelo $gestionVuelo) {
        try {
            if (!$this->gestion_rutasDao->exist($gestionVuelo)) {
                $this->gestion_rutasDao->add($gestionVuelo);
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
            $this->gestion_rutasDao->update($gestionVuelo);
        } catch (Exception $e) {
            throw $e;
        }
    }

    //eliminar a una gestion de vuelo de la base de datos
    //----------------------------------------------------------------------------------

    public function delete(GestionVuelo $gestionVuelo) {
        try {
            $this->gestion_rutasDao->delete($gestionVuelo);
        } catch (Exception $e) {
            throw $e;
        }
    }

    //consulta a una gestion de vuelo a la base de datos
    //----------------------------------------------------------------------------------

    public function searchById(GestionVuelo $gestionVuelo) {
        try {
            return $this->gestion_rutasDao->searchById($gestionVuelo);
        } catch (Exception $e) {
            throw $e;
        }
    }

    //consultar todas las gestiones de vuelo de la base de datos
    //----------------------------------------------------------------------------------

    public function getAll() {
        try {
            return $this->gestion_rutasDao->getAll();
        } catch (Exception $e) {
            throw $e;
        }
    }

}

//end of the class gestionVueloBo
?>

 
