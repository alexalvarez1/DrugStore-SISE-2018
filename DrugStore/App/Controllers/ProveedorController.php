<?php

class ProveedorController extends Controller {

    public static function CREAR_PROVEEDOR(Proveedor $proveedor) {
        echo ProveedorActions::CREAR_PROVEEDOR($proveedor);
    }

    public static function LISTAR_PROVEEDORES($option = "normal") {
        switch ($option) {
            case "json":
                echo json_encode(ProveedorActions::LISTAR_PROVEEDORES());
                break;
            default:
                return ProveedorActions::LISTAR_PROVEEDORES();
        }
    }

    public static function BUSCAR_PROVEEDOR($cod_proveedor) {
        $obj = ProveedorActions::BUSCAR_PROVEEDOR($cod_proveedor);
        if (trim($obj->mensaje) == "existe") {
            require_once './App/Views/Dashboard/Proveedor/modal/editar.php';
        } else {
            echo trim($obj->mensaje);
        }
    }

    public static function EDITAR_PROVEEDOR(Proveedor $proveedor) {
        echo ProveedorActions::EDITAR_PROVEEDOR($proveedor);
    }

    public static function FILTRAR_PROVEEDORES($nombre) {
        $lista = ProveedorActions::FILTRAR_PROVEEDORES($nombre);
        if ($lista[0]["mensaje"] == "existe") {
            echo json_encode($lista);
        } else {
            echo $lista[0]["mensaje"];
        }
    }

}
