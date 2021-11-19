<?php

require_once("baseDomain.php");

class gestion_rutas extends BaseDomain implements \JsonSerializable {

    //atributos
    private $idgestion_rutas;
    private $dia_semana_hora;
    private $ruta;
    private $duracion;
    
    
    
    //constructores
    public function __construct() {
        parent::__construct();
    }

    public static function createNullgestion_rutas() {
        $instance = new self();
        return $instance;
    }

    public static function creategestion_rutas($idgestion_rutas, $dia_semana_hora,$ruta,
    $duracion,$lastUser, $lastModification) {
    
        $instance = new self();
        $instance->idgestion_rutas = $idgestion_rutas;
        $instance->dia_semana_hora = $dia_semana_hora;
        $instance->ruta = $ruta;
        $instance->duracion = $duracion;
        $instance->setLastUser($lastUser);
        $instance->setLastModification($lastModification);
        return $instance;
    }

    //propiedades
    public function getidgestion_rutas() {
        return $this->idgestion_rutas;
    }

    public function setidgestion_rutas($idgestion_rutas) {
        $this->idgestion_rutas = $idgestion_rutas;
    }

    //----------------------------------------------------------------------------------

    public function getdia_semana_hora() {
        return $this->dia_semana_hora;
    }

    public function setdia_semana_hora($dia_semana_hora) {
        $this->dia_semana_hora = $dia_semana_hora;
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
