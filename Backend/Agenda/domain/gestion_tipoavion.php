<?php

require_once("baseDomain.php");

class gestion_tipoavion extends BaseDomain implements \JsonSerializable {

    //atributos
    private $PK_tipoAvion;
    private $anno;
    private $modelo;
    private $marca;
    private $cantidad_pasajeros;
    private $cantidad_filas;
    private $cantidadasientos_fila;

    //constructores
    public function __construct() {
        parent::__construct();
    }

    public static function createNullgestion_tipoavion() {
        $instance = new self();
        return $instance;
    }

    public static function creategestion_tipoavion($PK_tipoAvion, $anno, $modelo,
            $cantidad_pasajeros, $cantidad_filas, $cantidadasientos_fila, $lastUser, $lastModification) {

        $instance = new self();
        $instance->PK_tipoAvion = $PK_tipoAvion;
        $instance->anno = $anno;
        $instance->modelo = $modelo;
        $instance->cantidad_pasajeros = $cantidad_pasajeros;
        $instance->cantidad_filas = $cantidad_filas;
        $instance->cantidadasientos_fila = $cantidadasientos_fila;
        $instance->setLastUser($lastUser);
        $instance->setLastModification($lastModification);
        return $instance;
    }

    //propiedades
    public function getPK_tipoAvion() {
        return $this->PK_tipoAvion;
    }

    public function setPK_tipoAvion($PK_tipoAvion) {
        $this->PK_tipoAvion = $PK_tipoAvion;
    }

    //----------------------------------------------------------------------------------

    public function getanno() {
        return $this->anno;
    }

    public function setanno($anno) {
        $this->anno = $anno;
    }

    //----------------------------------------------------------------------------------

    public function getmodelo() {
        return $this->modelo;
    }

    public function setmodelo($modelo) {
        $this->modelo = $modelo;
    }

    //----------------------------------------------------------------------------------

    public function getmarca() {
        return $this->marca;
    }

    public function setmarca($marca) {
        $this->marca = $marca;
    }

    //----------------------------------------------------------------------------------

    public function getcantidad_pasajeros() {
        return $this->cantidad_pasajeros;
    }

    public function setcantidad_pasajeros($cantidad_pasajeros) {
        $this->cantidad_pasajeros = $cantidad_pasajeros;
    }

    //----------------------------------------------------------------------------------

    public function getcantidad_filas() {
        return $this->cantidad_filas;
    }

    public function setcantidad_filas($cantidad_filas) {
        $this->cantidad_filas = $cantidad_filas;
    }

    //----------------------------------------------------------------------------------

    public function getcantidadasientos_fila() {
        return $this->cantidadasientos_fila;
    }

    public function setcantidadasientos_fila($cantidadasientos_fila) {
        $this->cantidadasientos_fila = $cantidadasientos_fila;
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

//fin de la clase gestion_tipoavion