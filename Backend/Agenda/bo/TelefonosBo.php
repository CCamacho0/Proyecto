<?php

require_once("../domain/Telefonos.php");
require_once("../dao/TelefonosDao.php");

class TelefonosBo {

    private $telefonosDao;

    public function __construct() {
        $this->telefonosDao = new TelefonosDao();
    }

    public function getPersonasDao() {
        return $this->telefonosDao;
    }

    public function setPersonasDao(TelefonosDao $telefonosDao) {
        $this->telefonosDao = $telefonosDao;
    }

    //agrega a un telefono a la base de datos
    //----------------------------------------------------------------------------------

    public function add(Telefono $telefono) {
        try {
            if (!$this->telefonosDao->exist($telefono)) {
                $this->telefonosDao->add($telefono);
            } else {
                throw new Exception("El telefono ya existe en la base de datos!!");
            }
        } catch (Exception $e) {
            throw $e;
        }
    }

    //modifica a un telefono a la base de datos
    //----------------------------------------------------------------------------------

    public function update(Telefono $telefono) {
        try {
            $this->telefonosDao->update($telefono);
        } catch (Exception $e) {
            throw $e;
        }
    }

    //eliminar a un telefono a la base de datos
    //----------------------------------------------------------------------------------

    public function delete(Telefono $telefono) {
        try {
            $this->telefonosDao->delete($telefono);
        } catch (Exception $e) {
            throw $e;
        }
    }

    //consulta a una persona a la base de datos
    //----------------------------------------------------------------------------------

    public function searchById(Telefono $telefono) {
        try {
            return $this->telefonosDao->searchById($telefono);
        } catch (Exception $e) {
            throw $e;
        }
    }

    //consultar todas los telefonos de la base de datos
    //----------------------------------------------------------------------------------

    public function getAll() {
        try {
            return $this->telefonosDao->getAll();
        } catch (Exception $e) {
            throw $e;
        }
    }

}

//end of the class TelefonosBo
?>

