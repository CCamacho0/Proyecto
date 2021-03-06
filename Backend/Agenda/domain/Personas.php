<?php

require_once("baseDomain.php");

class Personas extends BaseDomain implements \JsonSerializable {

    //atributos
    private $PK_cedula;
    private $nombre;
    private $apellido1;
    private $apellido2;
    private $fecNacimiento;
    private $sexo;
    private $celular;
    private $correo;
    private $direccion;
    private $nombreUsuario;
    private $contrasena;
    private $tipoUsuario;
    
    //constructores
    public function __construct() {
        parent::__construct();
    }

    public static function createNullPersonas() {
        $instance = new self();
        return $instance;
    }

    public static function createPersonas($PK_cedula, $nombre, $apellido1, $apellido2, $fecNacimiento, $sexo, $celular, $correo,
            $direccion, $nombreUsuario, $contrasena,  $tipoUsuario, $lastUser, $lastModification) {
        $instance = new self();
        $instance->PK_cedula = $PK_cedula;
        $instance->nombre = $nombre;
        $instance->apellido1 = $apellido1;
        $instance->apellido2 = $apellido2;
        $instance->fecNacimiento = $fecNacimiento;
        $instance->sexo = $sexo;
        $instance->celular = $celular;
        $instance->correo = $correo;
        $instance->direccion = $direccion;
        $instance->nombreUsuario = $nombreUsuario;
        $instance->contrasena = $contrasena;
        $instance->tipoUsuario = $tipoUsuario;
        $instance->setLastUser($lastUser);
        $instance->setLastModification($lastModification);
        return $instance;
    }

    //propiedades
    public function getPK_cedula() {
        return $this->PK_cedula;
    }

    public function setPK_cedula($PK_cedula) {
        $this->PK_cedula = $PK_cedula;
    }

    //----------------------------------------------------------------------------------

    public function getNombre() {
        return $this->nombre;
    }

    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    //----------------------------------------------------------------------------------

    public function getApellido1() {
        return $this->apellido1;
    }

    public function setApellido1($apellido1) {
        $this->apellido1 = $apellido1;
    }

    //----------------------------------------------------------------------------------

    public function getApellido2() {
        return $this->apellido2;
    }

    public function setApellido2($apellido2) {
        $this->apellido2 = $apellido2;
    }

    //----------------------------------------------------------------------------------

    public function getFecNacimiento() {
        return $this->fecNacimiento;
    }

    public function setFecNacimiento($fecNacimiento) {
        $this->fecNacimiento = $fecNacimiento;
    }

    //----------------------------------------------------------------------------------

    public function getSexo() {
        return $this->sexo;
    }

    public function setSexo($sexo) {
        $this->sexo = $sexo;
    }

    //----------------------------------------------------------------------------------

    public function gettipoUsuario() {
        return $this->tipoUsuario;
    }

    public function settipoUsuario($tipoUsuario) {
        $this->tipoUsuario = $tipoUsuario;
    }
    
        //----------------------------------------------------------------------------------

    public function getnombreUsuario() {
        return $this->nombreUsuario;
    }

    public function setnombreUsuario($nombreUsuario) {
        $this->nombreUsuario = $nombreUsuario;
    }
    
        //----------------------------------------------------------------------------------

    public function getcontrasena() {
        return $this->contrasena;
    }

    public function setcontrasena($contrasena) {
        $this->contrasena = $contrasena;
    }

    //----------------------------------------------------------------------------------

        public function getCorreo() {
        return $this->correo;
    }

    public function setCorreo($correo) {
        $this->correo = $correo;
    }

    //----------------------------------------------------------------------------------
    
    public function getCelular() {
        return $this->celular;
    }

    public function setCelular($celular) {
        $this->celular = $celular;
    }

    //----------------------------------------------------------------------------------
    
        public function getDireccion() {
        return $this->direccion;
    }

    public function setDireccion($direccion) {
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
