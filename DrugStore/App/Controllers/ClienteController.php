<?php

class ClienteController extends Controller {

    public static function CREAR_CLIENTE(Cliente $cliente) {
        echo ClienteActions::CREAR_CLIENTE($cliente);
    }

    public static function LISTAR_CLIENTES($option = "normal") {
        switch ($option) {
            case "json":
                echo json_encode(ClienteActions::LISTAR_CLIENTES());
                break;
            default:
                return ClienteActions::LISTAR_CLIENTES();
        }
    }

    public static function BUSCAR_CLIENTE($cod_cliente) {
        $obj = ClienteActions::BUSCAR_CLIENTE($cod_cliente);
        if (trim($obj->mensaje) == "existe") {
            require_once './App/Views/Dashboard/Cliente/modal/editar.php';
        } else {
            echo trim($obj->mensaje);
        }
    }

    public static function EDITAR_CLIENTE(Cliente $cliente) {
        echo ClienteActions::EDITAR_CLIENTE($cliente);
    }

    public static function FILTRAR_CLIENTES($nombre) {
        $lista = ClienteActions::FILTRAR_CLIENTES($nombre);
        if ($lista[0]["mensaje"] == "existe") {
            echo json_encode($lista);
        } else {
            echo $lista[0]["mensaje"];
        }
    }

}
