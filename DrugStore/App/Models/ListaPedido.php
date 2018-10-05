<?php

class ListaPedido extends ListaPedidoActions {

    private $cod_lista_pedido;
    private $cod_cliente;
    private $cod_empleado;
    private $cod_tipo_pago;

    public function __construct() {
        
    }

    public function getCod_lista_pedido() {
        return $this->cod_lista_pedido;
    }

    public function getCod_cliente() {
        return $this->cod_cliente;
    }

    public function getCod_empleado() {
        return $this->cod_empleado;
    }

    public function getCod_tipo_pago() {
        return $this->cod_tipo_pago;
    }

    public function setCod_lista_pedido($cod_lista_pedido) {
        $this->cod_lista_pedido = $cod_lista_pedido;
        return $this;
    }

    public function setCod_cliente($cod_cliente) {
        $this->cod_cliente = $cod_cliente;
        return $this;
    }

    public function setCod_empleado($cod_empleado) {
        $this->cod_empleado = $cod_empleado;
        return $this;
    }

    public function setCod_tipo_pago($cod_tipo_pago) {
        $this->cod_tipo_pago = $cod_tipo_pago;
        return $this;
    }

}
