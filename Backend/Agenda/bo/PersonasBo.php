<?php

require_once("../domain/Personas.php");
require_once("../dao/PersonasDao.php");

class PersonasBo {

    private $personasDao;

    public function __construct() {
        $this->personasDao = new PersonasDao();
    }

    public function getPersonasDao() {
        return $this->personasDao;
    }

    public function setPersonasDao(PersonasDao $personasDao) {
        $this->personasDao = $personasDao;
    }

    //agrega a una persona a la base de datos
    //----------------------------------------------------------------------------------

    public function add(Personas $personas) {
        try {
            if (!$this->personasDao->exist($personas)) {
                $this->personasDao->add($personas);
            } else {
                throw new Exception("La persona ya existe en la base de datos!!");
            }
        } catch (Exception $e) {
            throw $e;
        }
    }

    //modifica a una persona a la base de datos
    //----------------------------------------------------------------------------------

    public function update(Personas $personas) {
        try {
            $this->personasDao->update($personas);
        } catch (Exception $e) {
            throw $e;
        }
    }

    //eliminar a una persona a la base de datos
    //----------------------------------------------------------------------------------

    public function delete() {
        try {
            $this->personasDao->delete();
        } catch (Exception $e) {
            throw $e;
        }
    }

    //consulta a una persona a la base de datos
    //----------------------------------------------------------------------------------

    public function searchById() {
        try {
            return $this->personasDao->searchById();
        } catch (Exception $e) {
            throw $e;
        }
    }

    //consultar todas las personas de la base de datos
    //----------------------------------------------------------------------------------

    public function IniciarSesion(Personas $personas) {
        try {
            return $this->personasDao->IniciarSesion($personas);
        } catch (Exception $e) {

            throw $e;
        }
    }

    public function CrearSesion(Personas $personas) {
        try {
            return $this->personasDao->CrearSesion($personas);
        } catch (Exception $e) {

            throw $e;
        }
    }

    public function getAll() {
        try {
            return $this->personasDao->getAll();
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function Verificar() {
        return $this->personasDao->Verificar();
    }

    public function Destruir() {
        return $this->personasDao->Destruir();
    }
    
    public function InfoUsuario() {
        return $this->personasDao->InfoUsuario();
    }

        public function Historico(Personas $personas) {
        try {
            return $this->personasDao->Historico($personas);
        } catch (Exception $e) {
            throw $e;
        }
    }
}

//end of the class PersonasBo
?>

