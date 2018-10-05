<?php

class Proveedor extends ProveedorActions {

    private $cod_proveedor;
    private $nombre;
    private $direccion;
    private $pagina_web;
    private $telefono;

    public function __construct() {
        
    }

    public function getCod_proveedor() {
        return $this->cod_proveedor;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function getDireccion() {
        return $this->direccion;
    }

    public function getPagina_web() {
        return $this->pagina_web;
    }

    public function getTelefono() {
        return $this->telefono;
    }

    public function setCod_proveedor($cod_proveedor) {
        $this->cod_proveedor = $cod_proveedor;
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

    public function setPagina_web($pagina_web) {
        $this->pagina_web = $pagina_web;
        return $this;
    }

    public function setTelefono($telefono) {
        $this->telefono = $telefono;
        return $this;
    }

}
