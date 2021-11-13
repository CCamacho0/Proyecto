<?php

require_once("../domain/Direcciones.php");
require_once("../dao/DireccionesDao.php");

class DireccionesBo {

    private $direcionesDao;

    public function __construct() {
        $this->direcionesDao = new DireccionesDao();
    }

    public function getPersonasDao() {
        return $this->direcionesDao;
    }

    public function setPersonasDao(DireccionesDao $direcionesDao) {
        $this->direcionesDao = $direcionesDao;
    }

    //agrega a una direcion a la base de datos
    //----------------------------------------------------------------------------------

    public function add(Direccion $direccion) {
        try {
            if (!$this->direcionesDao->exist($direccion)) {
                $this->direcionesDao->add($direccion);
            } else {
                throw new Exception("La direccion ya existe en la base de datos!!");
            }
        } catch (Exception $e) {
            throw $e;
        }
    }

    //modifica a una direccion a la base de datos
    //----------------------------------------------------------------------------------

    public function update(Direccion $direccion) {
        try {
            $this->direcionesDao->update($direccion);
        } catch (Exception $e) {
            throw $e;
        }
    }

    //eliminar a una direccion a la base de datos
    //----------------------------------------------------------------------------------

    public function delete(Direccion $direccion) {
        try {
            $this->direcionesDao->delete($direccion);
        } catch (Exception $e) {
            throw $e;
        }
    }

    //consulta a una direccion a la base de datos
    //----------------------------------------------------------------------------------

    public function searchById(Direccion $direccion) {
        try {
            return $this->direcionesDao->searchById($direccion);
        } catch (Exception $e) {
            throw $e;
        }
    }

    //consultar todas las personas de la base de datos
    //----------------------------------------------------------------------------------

    public function getAll() {
        try {
            return $this->direcionesDao->getAll();
        } catch (Exception $e) {
            throw $e;
        }
    }

}

//end of the class PersonasBo
?>

