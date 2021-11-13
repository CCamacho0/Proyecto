<?php

require_once("baseDomain.php");

class Personas extends BaseDomain implements \JsonSerializable {

    //atributos
    private $PK_telefono;
    private $FK_cedula;
    private $descripcion;

    //constructores
    public function __construct() {
        parent::__construct();
    }

    public static function createNullTelefonos() {
        $instance = new self();
        return $instance;
    }

    public static function createTelefonos($PK_telefono, $FK_cedula, $descripcion,$lastUser, $lastModification) {
        $instance = new self();
        $instance->PK_telefono = $PK_telefono;
        $instance->FK_cedula = $FK_cedula;
        $instance->descripcion = $descripcion;
        $instance->setLastUser($lastUser);
        $instance->setLastModification($lastModification);
        return $instance;
    }

    //propieades
    public function getPK_telefono() {
        return $this->PK_telefono;
    }

    public function setPK_telefono($PK_telefono) {
        $this->PK_telefono = $PK_telefono;
    }

    //----------------------------------------------------------------------------------

    public function getFK_cedula() {
        return $this->FK_cedula;
    }

    public function setFK_cedula($FK_cedula) {
        $this->FK_cedula = $FK_cedula;
    }

    //----------------------------------------------------------------------------------

    public function getdescripcion() {
        return $this->descripcion;
    }

    public function setdescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }

    //----------------------------------------------------------------------------------

    public function getlastUser() {
        return $this->lastUser;
    }

    public function setlastUser($lastUser) {
        $this->lastUser = $lastUser;
    }

    //----------------------------------------------------------------------------------
    //Convertir el obj a JSON

    public function jsonSerialize() {
        return get_object_vars($this);
    }

}
