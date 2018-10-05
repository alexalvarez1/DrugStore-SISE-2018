<?php

class ProductoController extends Controller {

    public static function CREAR_PRODUCTO(Producto $producto) {
        return ProductoActions::CREAR_PRODUCTO($producto);
    }

    public static function LISTAR_PRODUCTOS($option = "normal") {
        switch ($option) {
            case "json":
                echo json_encode(ProductoActions::LISTAR_PRODUCTOS());
                break;
            default:
                return ProductoActions::LISTAR_PRODUCTOS();
        }
    }

    public static function BUSCAR_PRODUCTO($cod_producto, $option = "normal") {
        $obj = ProductoActions::BUSCAR_PRODUCTO($cod_producto);
        switch ($option) {
            case "return":
                return $obj;
            default:
                if (trim($obj->mensaje) == "existe") {
                    require_once './App/Views/Dashboard/Producto/modal/editar.php';
                } else {
                    echo trim($obj->mensaje);
                }
                break;
        }
    }

    public static function EDITAR_PRODUCTO(Producto $producto) {
        return ProductoActions::EDITAR_PRODUCTO($producto);
    }

    public static function FILTRAR_PRODUCTOS($cod_referencia, $nombre_producto) {
        $lista = ProductoActions::FILTRAR_PRODUCTOS($cod_referencia, $nombre_producto);
        if ($lista[0]["mensaje"] == "existe") {
            echo json_encode($lista);
        } else {
            echo $lista[0]["mensaje"];
        }
    }

}
