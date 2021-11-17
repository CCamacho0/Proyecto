<?php

require_once("baseDomain.php");

class Factura extends BaseDomain implements \JsonSerializable {

    //atributos
    private $idFactura;
    private $Detalle;
    private $FK_cedula;
    private $FK_idgestionVuelo;

    //constructores
    public function __construct() {
        parent::__construct();
    }

    public static function createNullTelefonos() {
        $instance = new self();
        return $instance;
    }

    public static function createTelefonos($idFactura, $FK_cedula, $FK_idgestionVuelo, $Detalle) {
        $instance = new self();
        $instance->idFactura = $idFactura;
        $instance->Detalle = $Detalle;
        $instance->FK_cedula = $FK_cedula;
        $instance->FK_idgestionVuelo = $FK_idgestionVuelo;
        return $instance;
    }

    //propieades
    public function getidFactura() {
        return $this->idFactura;
    }

    public function setidFactura($idFactura) {
        $this->idFactura = $idFactura;
    }

    //----------------------------------------------------------------------------------

    public function getFK_cedula() {
        return $this->FK_cedula;
    }

    public function setFK_cedula($FK_cedula) {
        $this->FK_cedula = $FK_cedula;
    }

    //----------------------------------------------------------------------------------

    public function getFK_idgestionVuelo() {
        return $this->FK_idgestionVuelo;
    }

    public function setFK_idgestionVuelo($FK_idgestionVuelo) {
        $this->FK_idgestionVuelo = $FK_idgestionVuelo;
    }

    //----------------------------------------------------------------------------------

    public function getDetalle() {
        return $this->Detalle;
    }

    public function setDetalle($Detalle) {
        $this->Detalle = $Detalle;
    }

    //----------------------------------------------------------------------------------
    //Convertir el obj a JSON

    public function jsonSerialize() {
        return get_object_vars($this);
    }

}
