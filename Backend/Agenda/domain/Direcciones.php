<?php

require_once("baseDomain.php");

class Personas extends BaseDomain implements \JsonSerializable {

    //atributos
    private $PKA_IdDirecion;
    private $FK_cedula;
    private $nomLugar;
    private $direccion;

    //constructores
    public function __construct() {
        parent::__construct();
    }

    public static function createNullTelefonos() {
        $instance = new self();
        return $instance;
    }

    public static function createTelefonos($PKA_IdDireccion, $FK_cedula, $nomLugar, $direccion, $lastUser, $lastModification) {
        $instance = new self();
        $instance->PKA_IdDirecion = $PKA_IdDireccion;
        $instance->FK_cedula = $FK_cedula;
        $instance->nomLugar = $nomLugar;
        $instance->direccion = $direccion;
        $instance->setLastUser($lastUser);
        $instance->setLastModification($lastModification);
        return $instance;
    }

    //propieades
    public function getPKA_IdDireccion() {
        return $this->PKA_IdDirecion;
    }

    public function setPKA_IdDireccion($PKA_IdDireccion) {
        $this->PKA_IdDirecion = $PKA_IdDireccion;
    }

    //----------------------------------------------------------------------------------

    public function getFK_cedula() {
        return $this->FK_cedula;
    }

    public function setFK_cedula($FK_cedula) {
        $this->FK_cedula = $FK_cedula;
    }

    //----------------------------------------------------------------------------------

    public function getnomLugar() {
        return $this->nomLugar;
    }

    public function setnumLugar($nomLugar) {
        $this->nomLugar = $nomLugar;
    }

    //----------------------------------------------------------------------------------

    public function getdireccion() {
        return $this->direccion;
    }

    public function setdireccion($direccion) {
        $this->direccion = $direccion;
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
