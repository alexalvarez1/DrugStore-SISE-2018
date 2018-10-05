<?php

class ClienteActions {

    public static function CREAR_CLIENTE(Cliente $cliente) {
        $sql = "CALL CREAR_CLIENTE(?,?,?)";
        $parametros = array(
            $cliente->getNombre(),
            $cliente->getDireccion(),
            $cliente->getTelefono()
        );
        return ClienteController::query($sql, $parametros, "SELECT")[0]["mensaje"];
    }

    public static function LISTAR_CLIENTES() {
        $sql = "CALL LISTAR_CLIENTES()";
        return ClienteController::query($sql);
    }

    public static function BUSCAR_CLIENTE($cod_cliente) {
        $sql = "CALL BUSCAR_CLIENTE(?)";
        $parametros = array($cod_cliente);
        return ClienteController::query($sql, $parametros, "OBJECT")[0];
    }

    public static function EDITAR_CLIENTE(Cliente $cliente) {
        $sql = "CALL EDITAR_CLIENTE(?,?,?,?)";
        $parametros = array(
            $cliente->getCod_cliente(),
            $cliente->getNombre(),
            $cliente->getDireccion(),
            $cliente->getTelefono()
        );
        return ClienteController::query($sql, $parametros, "SELECT")[0]["mensaje"];
    }

    public static function FILTRAR_CLIENTES($nombre) {
        $sql = "CALL FILTRAR_CLIENTES(?)";
        $parametros = array($nombre);
        return ClienteController::query($sql, $parametros, "SELECT");
    }

}
