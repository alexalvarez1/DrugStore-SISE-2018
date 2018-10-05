<?php

class ProductoActions {

    public static function CREAR_PRODUCTO(Producto $producto) {
        $sql = "CALL CREAR_PRODUCTO(?,?,?,?,?,?,?)";
        $parametros = array(
            $producto->getCod_referencia(),
            $producto->getNombre_producto(),
            $producto->getDescripcion(),
            $producto->getStock(),
            $producto->getFecha_vencimiento(),
            $producto->getRutaImagen(),
            $producto->getCod_proveedor()
        );
        return ProductoController::query($sql, $parametros, "SELECT")[0]["mensaje"];
    }

    public static function LISTAR_PRODUCTOS() {
        $sql = "CALL LISTAR_PRODUCTOS()";
        return ProductoController::query($sql);
    }

    public static function BUSCAR_PRODUCTO($cod_producto) {
        $sql = "CALL BUSCAR_PRODUCTO(?)";
        $parametros = array($cod_producto);
        return ProductoController::query($sql, $parametros, "OBJECT")[0];
    }

    public static function EDITAR_PRODUCTO(Producto $producto) {
        $sql = "CALL EDITAR_PRODUCTO(?,?,?,?,?,?,?,?)";
        $parametros = array(
            $producto->getCod_producto(),
            $producto->getCod_referencia(),
            $producto->getNombre_producto(),
            $producto->getDescripcion(),
            $producto->getStock(),
            $producto->getFecha_vencimiento(),
            $producto->getRutaImagen(),
            $producto->getCod_proveedor()
        );
        return ProductoController::query($sql, $parametros, "SELECT")[0]["mensaje"];
    }

    public static function FILTRAR_PRODUCTOS($cod_referencia, $nombre_producto) {
        $sql = "CALL FILTRAR_PRODUCTOS(?,?)";
        $parametros = array(
            $cod_referencia,
            $nombre_producto
        );
        return ProductoController::query($sql, $parametros, "SELECT");
    }

}
