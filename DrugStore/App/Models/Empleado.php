<?php

class Empleado extends EmpleadoActions {

    private $cod_empleado;
    private $nombre;
    private $dni;
    private $clave;
    private $nivel_usuario;
    private $direccion;
    private $telefono;
    private $fecha_entrada;
    private $sueldo_base;

    public function __construct() {
        
    }

    public function getCod_empleado() {
        return $this->cod_empleado;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function getDni() {
        return $this->dni;
    }

    public function getClave() {
        return $this->clave;
    }

    public function getNivel_usuario() {
        return $this->nivel_usuario;
    }

    public function getDireccion() {
        return $this->direccion;
    }

    public function getTelefono() {
        return $this->telefono;
    }

    public function getFecha_entrada() {
        return $this->fecha_entrada;
    }

    public function getSueldo_base() {
        return $this->sueldo_base;
    }

    public function setCod_empleado($cod_empleado) {
        $this->cod_empleado = $cod_empleado;
        return $this;
    }

    public function setNombre($nombre) {
        $this->nombre = $nombre;
        return $this;
    }

    public function setDni($dni) {
        $this->dni = $dni;
        return $this;
    }

    public function setClave($clave) {
        $this->clave = $clave;
        return $this;
    }

    public function setNivel_usuario($nivel_usuario) {
        $this->nivel_usuario = $nivel_usuario;
        return $this;
    }

    public function setDireccion($direccion) {
        $this->direccion = $direccion;
        return $this;
    }

    public function setTelefono($telefono) {
        $this->telefono = $telefono;
        return $this;
    }

    public function setFecha_entrada($fecha_entrada) {
        $this->fecha_entrada = $fecha_entrada;
        return $this;
    }

    public function setSueldo_base($sueldo_base) {
        $this->sueldo_base = $sueldo_base;
        return $this;
    }

}
