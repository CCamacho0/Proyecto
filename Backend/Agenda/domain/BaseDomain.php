<?php

class BaseDomain {

    //attributes
    private $lastUser;
    private $lastModification;

    //constructors
    public function __construct() {
        
    }

    //properties
    public function getLastUser() {
        return $this->lastUser;
    }

    public function setLastUser($lastUser) {
        $this->lastUser = $lastUser;
    }

    /****************************************************************************/

    public function getLastModification() {
        return $this->lastModification;
    }

    public function setLastModification($lastModification) {
        $this->lastModification = $lastModification;
    }

    /****************************************************************************/
    //Convertir el obj a JSON
    /****************************************************************************/
    

    public function jsonSerialize() {
        return get_object_vars($this);
    }

}

//end of the class
?>