<?php

class Producto extends ProductoActions {

    private $cod_producto;
    private $cod_referencia;
    private $nombre_producto;
    private $descripcion;
    private $stock;
    private $precio;
    private $fecha_entrada;
    private $fecha_vencimiento;
    private $estado;
    private $rutaImagen;
    private $cod_proveedor;

    public function __construct() {
        
    }

    public function getCod_producto() {
        return $this->cod_producto;
    }

    public function getCod_referencia() {
        return $this->cod_referencia;
    }

    public function getNombre_producto() {
        return $this->nombre_producto;
    }

    public function getDescripcion() {
        return $this->descripcion;
    }

    public function getStock() {
        return $this->stock;
    }

    public function getPrecio() {
        return $this->precio;
    }

    public function getFecha_entrada() {
        return $this->fecha_entrada;
    }

    public function getFecha_vencimiento() {
        return $this->fecha_vencimiento;
    }

    public function getEstado() {
        return $this->estado;
    }

    public function getRutaImagen() {
        return $this->rutaImagen;
    }

    public function getCod_proveedor() {
        return $this->cod_proveedor;
    }

    public function setCod_producto($cod_producto) {
        $this->cod_producto = $cod_producto;
        return $this;
    }

    public function setCod_referencia($cod_referencia) {
        $this->cod_referencia = $cod_referencia;
        return $this;
    }

    public function setNombre_producto($nombre_producto) {
        $this->nombre_producto = $nombre_producto;
        return $this;
    }

    public function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
        return $this;
    }

    public function setStock($stock) {
        $this->stock = $stock;
        return $this;
    }

    public function setPrecio($precio) {
        $this->precio = $precio;
        return $this;
    }

    public function setFecha_entrada($fecha_entrada) {
        $this->fecha_entrada = $fecha_entrada;
        return $this;
    }

    public function setFecha_vencimiento($fecha_vencimiento) {
        $this->fecha_vencimiento = $fecha_vencimiento;
        return $this;
    }

    public function setEstado($estado) {
        $this->estado = $estado;
        return $this;
    }

    public function setRutaImagen($rutaImagen) {
        $this->rutaImagen = $rutaImagen;
        return $this;
    }

    public function setCod_proveedor($cod_proveedor) {
        $this->cod_proveedor = $cod_proveedor;
        return $this;
    }

}
