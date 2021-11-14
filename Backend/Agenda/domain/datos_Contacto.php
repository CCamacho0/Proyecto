<?php

require_once("baseDomain.php");

class datos_Contacto extends BaseDomain implements \JsonSerializable {

    //atributos
    private $PK_dato_Contacto;
    private $FK_cedula;
    private $correo;
    private $numeroCelular;
    private $numeroTrabajo;

    //constructores
    public function __construct() {
        parent::__construct();
    }

    public static function createNulldatos_Contactos() {
        $instance = new self();
        return $instance;
    }

    public static function createTelefonos($PK_dato_Contacto, $FK_cedula, $correo, $numeroCelular, $numeroTrabajo, $lastUser, $lastModification) {
        $instance = new self();
        $instance->PK_dato_Contacto = $PK_dato_Contacto;
        $instance->FK_cedula = $FK_cedula;
        $instance->correo = $correo;
        $instance->numeroCelular = $numeroCelular;
        $instance->numeroTrabajo = $numeroTrabajo;
        $instance->setLastUser($lastUser);
        $instance->setLastModification($lastModification);
        return $instance;
    }

    //propieades
    public function getPK_dato_Contacto() {
        return $this->PK_dato_Contacto;
    }

    public function setPK_telefono($PK_dato_Contacto) {
        $this->PK_dato_Contacto = $PK_dato_Contacto;
    }

    //----------------------------------------------------------------------------------

    public function getFK_cedula() {
        return $this->FK_cedula;
    }

    public function setFK_cedula($FK_cedula) {
        $this->FK_cedula = $FK_cedula;
    }

    //----------------------------------------------------------------------------------

    public function getnumeroCelular() {
        return $this->correo;
    }

    public function setnumeroCelular($numeroCelular) {
        $this->correo = $numeroCelular;
    }

    //----------------------------------------------------------------------------------

        public function getnumeroTrabajo() {
        return $this->correo;
    }

    public function setnumeroTrabajo($numeroTrabajo) {
        $this->correo = $numeroTrabajo;
    }

    //----------------------------------------------------------------------------------
    
        public function getcorreo() {
        return $this->correo;
    }

    public function setcorreo($correo) {
        $this->correo = $correo;
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
