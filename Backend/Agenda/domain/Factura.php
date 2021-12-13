<?php

require_once("baseDomain.php");

class Factura extends BaseDomain implements \JsonSerializable {

    //atributos
    private $idFactura;
    private $FechaCompra;
    private $asiento;
    private $CantidadAsiento;
    private $FK_cedula;
    private $FK_IdRutas;

    //constructores
    public function __construct() {
        parent::__construct();
    }

    public static function createNullFactura() {
        $instance = new self();
        return $instance;
    }

    public static function createFactura($idFactura, $FK_cedula, $asiento, $FK_IdRutas, $CantidadAsiento, $FechaCompra) {
        $instance = new self();
        $instance->idFactura = $idFactura;
        $instance->CantidadAsiento = $$CantidadAsiento;
        $instance->FechaCompra = $FechaCompra;
        $instance->asiento = $asiento;
        $instance->FK_cedula = $FK_cedula;
        $instance->FK_IdRutas = $FK_IdRutas;
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

    public function getFK_IdRutas() {
        return $this->FK_IdRutas;
    }

    public function setFK_IdRutas($FK_IdRutas) {
        $this->FK_IdRutas = $FK_IdRutas;
    }

    //----------------------------------------------------------------------------------

    public function getCantidadAsiento() {
        return $this->CantidadAsiento;
    }

    public function setCantidadAsiento($CantidadAsiento) {
        $this->CantidadAsiento = $CantidadAsiento;
    }
    
    //----------------------------------------------------------------------------------

    public function getAsiento() {
        return $this->asiento;
    }

    public function setAsiento($asiento) {
        $this->asiento = $asiento;
    }

    //----------------------------------------------------------------------------------
    
    public function getFechaCompra() {
        return $this->FechaCompra;
    }

    public function setFechaCompra($FechaCompra) {
        $this->FechaCompra = $FechaCompra;
    }

    //----------------------------------------------------------------------------------
    //Convertir el obj a JSON

    public function jsonSerialize() {
        return get_object_vars($this);
    }

}

