<?php

require_once("baseDomain.php");

class gestionVuelo extends BaseDomain implements \JsonSerializable {

    //atributos
    private $idgestionVuelo;
    private $Fecha;
    private $Precio;
    private $FK_idgestion_tipoavion;
    private $FK_idgestion_rutas;

    //constructores
    public function __construct() {
        parent::__construct();
    }

    public static function createNullgestionVuelo() {
        $instance = new self();
        return $instance;
    }

    public static function creategestionVuelo($idgestionVuelo, $Fecha,$Precio,
    $FK_idgestion_tipoavion,$FK_idgestion_rutas,$lastUser, $lastModification) {
    
        $instance = new self();
        $instance->idgestionVuelo = $idgestionVuelo;
        $instance->Fecha = $Fecha;
        $instance->Precio = $Precio;
        $instance->FK_idgestion_tipoavion = $FK_idgestion_tipoavion;
        $instance->FK_idgestion_rutas = $FK_idgestion_rutas;
        $instance->setLastUser($lastUser);
        $instance->setLastModification($lastModification);
        return $instance;
    }

    //propiedades
    public function getidgestionVuelo() {
        return $this->idgestionVuelo;
    }

    public function setidgestionVuelo($idgestionVuelo) {
        $this->idgestionVuelo = $idgestionVuelo;
    }

    //----------------------------------------------------------------------------------

    public function getFecha() {
        return $this->Fecha;
    }

    public function setFecha($Fecha) {
        $this->Fecha = $Fecha;
    }

    //----------------------------------------------------------------------------------

    public function getPrecio() {
        return $this->Precio;
    }

    public function setPrecio($Precio) {
        $this->Precio = $Precio;
    }

    //----------------------------------------------------------------------------------

    public function getFK_idgestion_tipoavion() {
        return $this->FK_idgestion_tipoavion;
    }

    public function setFK_idgestion_tipoavion($FK_idgestion_tipoavion) {
        $this->FK_idgestion_tipoavion = $FK_idgestion_tipoavion;
    }

    //----------------------------------------------------------------------------------

    public function getFK_idgestion_rutas() {
        return $this->FK_idgestion_rutas;
    }

    public function setFK_idgestion_rutas($FK_idgestion_rutas) {
        $this->FK_idgestion_rutas = $FK_idgestion_rutas;
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

