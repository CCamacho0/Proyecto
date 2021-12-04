<?php

require_once("../domain/gestion_rutas.php");
require_once("../dao/gestion_rutasDao.php");

class gestion_rutasBo{

    private $gestion_rutasDao;

    public function __construct() {
        $this->gestion_rutasDao = new gestion_rutasDao();
    }

    public function getgestion_rutasDao(){
        return $this->gestion_rutasDao;
    }

    public function setgestion_rutasDao(gestion_rutasDao $gestion_rutasDao) {
        $this->gestion_rutasDao = $gestion_rutasDao;
    }

    //agrega a una gestion de ruta a la base de datos
    //----------------------------------------------------------------------------------

    public function add(gestion_rutas $gestion_rutas) {
        try {
            if (!$this->gestion_rutasDao->exist($gestion_rutas)) {
                $this->gestion_rutasDao->add($gestion_rutas);
            } else {
                throw new Exception("La Ruta ya existe en la base de datos!!");
            }
        } catch (Exception $e) {
            throw $e;
        }
    }

    //modifica a una gestion de ruta a la base de datos
    //----------------------------------------------------------------------------------

    public function update(gestion_rutas $gestion_rutas) {
        try {
            $this->gestion_rutasDao->update($gestion_rutas);
        } catch (Exception $e) {
            throw $e;
        }
    }

    //eliminar a una gestion de ruta de la base de datos
    //----------------------------------------------------------------------------------

    public function delete(gestion_rutas $gestion_rutas) {
        try {
            $this->gestion_rutasDao->delete($gestion_rutas);
        } catch (Exception $e) {
            throw $e;
        }
    }

    //consulta una gestion de ruta a la base de datos
    //----------------------------------------------------------------------------------

    public function searchById(gestion_rutas $gestion_rutas) {
        try {
            return $this->gestion_rutasDao->searchById($gestion_rutas);
        } catch (Exception $e) {
            throw $e;
        }
    }

    //consultar todas las gestiones de ruta de la base de datos
    //----------------------------------------------------------------------------------

    public function getAll() {
        try {
            return $this->gestion_rutasDao->getAll();
        } catch (Exception $e) {
            throw $e;
        }
    }

}

//end of the class gestion_rutasBo
?>

 
