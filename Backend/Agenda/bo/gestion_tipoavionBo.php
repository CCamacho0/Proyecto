<?php

require_once("../domain/gestion_tipoavion.php");
require_once("../dao/gestion_tipoavionDao.php");

class gestion_tipoavionBo{

    private $gestion_tipoavionDao;

    public function __construct() {
        $this->gestion_tipoavionDao = new gestion_tipoavionDao();
    }

    public function getgestion_tipoavionDao(){
        return $this->gestion_tipoavionDao;
    }

    public function setgestion_tipoavionDao(gestion_tipoavionDao $gestion_tipoavionDao) {
        $this->gestion_tipoavionDao = $gestion_tipoavionDao;
    }

    //agrega a un avion a la base de datos
    //----------------------------------------------------------------------------------

    public function add(gestion_tipoavion $gestion_tipoavion) {
        try {
            if (!$this->gestion_tipoavionDao->exist($gestion_tipoavion)) {
                $this->gestion_tipoavionDao->add($gestion_tipoavion);
            } else {
                throw new Exception("El tipo de avión ya existe en la base de datos!!");
            }
        } catch (Exception $e) {
            throw $e;
        }
    }

    //modifica a un avion en la base de datos
    //----------------------------------------------------------------------------------

    public function update(gestion_tipoavion $gestion_tipoavion) {
        try {
            $this->gestion_tipoavionDao->update($gestion_tipoavion);
        } catch (Exception $e) {
            throw $e;
        }
    }

    //elimina a un avion de la base de datos
    //----------------------------------------------------------------------------------

    public function delete(gestion_tipoavion $gestion_tipoavion) {
        try {
            $this->gestion_tipoavionDao->delete($gestion_tipoavion);
        } catch (Exception $e) {
            throw $e;
        }
    }

    //consulta un avion a la base de datos
    //----------------------------------------------------------------------------------

    public function searchById(gestion_tipoavion $gestion_tipoavion) {
        try {
            return $this->gestion_tipoavionDao->searchById($gestion_tipoavion);
        } catch (Exception $e) {
            throw $e;
        }
    }

    //consultar todos aviones de la base de datos
    //----------------------------------------------------------------------------------

    public function getAll() {
        try {
            return $this->gestion_tipoavionDao->getAll();
        } catch (Exception $e) {
            throw $e;
        }
    }

}

//end of the class gestion_tipoavionBo
?>

