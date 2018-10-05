<?php

class Tipo_pago extends Tipo_pagoActions {

    private $cod_tipo_pago;
    private $tipo;
    private $descripcion;

    public function __construct() {
        
    }

    public function getCod_tipo_pago() {
        return $this->cod_tipo_pago;
    }

    public function getTipo() {
        return $this->tipo;
    }

    public function getDescripcion() {
        return $this->descripcion;
    }

    public function setCod_tipo_pago($cod_tipo_pago) {
        $this->cod_tipo_pago = $cod_tipo_pago;
        return $this;
    }

    public function setTipo($tipo) {
        $this->tipo = $tipo;
        return $this;
    }

    public function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
        return $this;
    }

}
