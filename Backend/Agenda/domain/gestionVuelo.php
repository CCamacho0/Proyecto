<?php

require_once("baseDomain.php");

class gestionVuelo extends BaseDomain implements \JsonSerializable {

    //atributos
    private $idgestionVuelo;
    private $FK_tipoAvion;
    private $FK_IdRutas;

    //constructores
    public function __construct() {
        parent::__construct();
    }

    public static function createNullgestionVuelo() {
        $instance = new self();
        return $instance;
    }

    public static function creategestionVuelo($idgestionVuelo,
            $FK_tipoAvion, $FK_IdRutas, $lastUser, $lastModification) {

        $instance = new self();
        $instance->idgestionVuelo = $idgestionVuelo;
        $instance->FK_tipoAvion = $FK_tipoAvion;
        $instance->FK_IdRutas = $FK_IdRutas;
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

    public function getFK_tipoAvion() {
        return $this->FK_tipoAvion;
    }

    public function setFK_tipoAvion($FK_idgestion_tipoavion) {
        $this->FK_tipoAvion = $FK_idgestion_tipoavion;
    }

    //----------------------------------------------------------------------------------

    public function getFK_IdRutas() {
        return $this->FK_IdRutas;
    }

    public function setFK_IdRutas($FK_idgestion_rutas) {
        $this->FK_IdRutas = $FK_idgestion_rutas;
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
