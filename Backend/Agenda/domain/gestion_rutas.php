<?php

require_once("baseDomain.php");

class gestion_rutas extends BaseDomain implements \JsonSerializable {

    //atributos
    private $PK_IdRutas;
    private $ruta;
    private $duracion;
    private $FechaSalida;
    private $Precio;
    private $FK_tipoAvion;

    //constructores
    public function __construct() {
        parent::__construct();
    }

    public static function createNullgestion_rutas() {
        $instance = new self();
        return $instance;
    }

    public static function creategestion_rutas($PK_IdRutas, $FechaSalida, $ruta,
            $duracion, $precio, $lastUser, $FK_tipoAvion, $lastModification) {

        $instance = new self();
        $instance->PK_IdRutas = $PK_IdRutas;
        $instance->FechaSalida = $FechaSalida;
        $instance->ruta = $ruta;
        $instance->duracion = $duracion;
        $instance->Precio = $precio;
        $instance->FK_tipoAvion = $FK_tipoAvion;
        $instance->setLastUser($lastUser);
        $instance->setLastModification($lastModification);
        return $instance;
    }

    //propiedades
    public function getPK_IdRutas() {
        return $this->PK_IdRutas;
    }

    public function setPK_IdRutas($PK_IdRutas) {
        $this->PK_IdRutas = $PK_IdRutas;
    }

    //----------------------------------------------------------------------------------
    public function getFechaSalida() {
        return $this->FechaSalida;
    }

    public function setFechaSalida($FechaSalida) {
        $this->FechaSalida = $FechaSalida;
    }

    //----------------------------------------------------------------------------------
    public function getruta() {
        return $this->ruta;
    }

    public function setruta($ruta) {
        $this->ruta = $ruta;
    }

    //----------------------------------------------------------------------------------
    public function getduracion() {
        return $this->duracion;
    }

    public function setduracion($duracion) {
        $this->duracion = $duracion;
    }

    //----------------------------------------------------------------------------------
    public function getPrecio() {
        return $this->Precio;
    }

    public function setPrecio($precio) {
        $this->Precio = $precio;
    }

    //---------------------------------------------------------------------------------- 
    public function getFK_tipoAvion() {
        return $this->FK_tipoAvion;
    }

    public function setFK_tipoAvion($FK_tipoAvion) {
        $this->FK_tipoAvion = $FK_tipoAvion;
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
