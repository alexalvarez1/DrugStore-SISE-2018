<?php

class ProveedorActions {

    public static function CREAR_PROVEEDOR(Proveedor $proveedor) {
        $sql = "CALL CREAR_PROVEEDOR(?,?,?,?)";
        $parametros = array(
            $proveedor->getNombre(),
            $proveedor->getDireccion(),
            $proveedor->getPagina_web(),
            $proveedor->getTelefono()
        );
        return ProveedorController::query($sql, $parametros, "SELECT")[0]["mensaje"];
    }

    public static function LISTAR_PROVEEDORES() {
        $sql = "CALL LISTAR_PROVEEDORES()";
        return ProveedorController::query($sql);
    }

    public static function BUSCAR_PROVEEDOR($cod_proveedor) {
        $sql = "CALL BUSCAR_PROVEEDOR(?)";
        $parametros = array($cod_proveedor);
        return ProveedorController::query($sql, $parametros, "OBJECT")[0];
    }

    public static function EDITAR_PROVEEDOR(Proveedor $proveedor) {
        $sql = "CALL EDITAR_PROVEEDOR(?,?,?,?,?)";
         $parametros = array(
            $proveedor->getCod_proveedor(),
            $proveedor->getNombre(),
            $proveedor->getDireccion(),
            $proveedor->getPagina_web(),
            $proveedor->getTelefono()
        );
        return ProveedorController::query($sql, $parametros, "SELECT")[0]["mensaje"];
    }

    public static function FILTRAR_PROVEEDORES($nombre) {
        $sql = "CALL FILTRAR_PROVEEDORES(?)";
        $parametros = array($nombre);
        return ProveedorController::query($sql, $parametros, "SELECT");
    }

}
