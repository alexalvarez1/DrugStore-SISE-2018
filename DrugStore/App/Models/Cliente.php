<?php

class Cliente extends ClienteActions {

    private $cod_cliente;
    private $nombre;
    private $direccion;
    private $telefono;

    public function __construct() {
        
    }

    public function getCod_cliente() {
        return $this->cod_cliente;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function getDireccion() {
        return $this->direccion;
    }

    public function getTelefono() {
        return $this->telefono;
    }

    public function setCod_cliente($cod_cliente) {
        $this->cod_cliente = $cod_cliente;
        return $this;
    }

    public function setNombre($nombre) {
        $this->nombre = $nombre;
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

}
