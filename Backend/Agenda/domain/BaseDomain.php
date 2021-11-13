<?php

class BaseDomain {

    //atriburos
    private $lastUser;
    private $lastModification;

    //construtor
    public function __construct() {
        
    }

    //propiedades
    public function getLastUser() {
        return $this->lastUser;
    }

    public function setLastUser($lastUser) {
        $this->lastUser = $lastUser;
    }

    //----------------------------------------------------------------------------------

    public function getLastModification() {
        return $this->lastModification;
    }

    public function setLastModification($lastModification) {
        $this->lastModification = $lastModification;
    }

    //----------------------------------------------------------------------------------
    //Convertir el obj a JSON

    public function jsonSerialize() {
        return get_object_vars($this);
    }

}

//end of the class
?>

