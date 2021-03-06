<?php

class EmpleadoController extends DataBase {

    public static function INICIAR_SESION($dni, $clave) {
        session_start();
        $obj = EmpleadoActions::INICIAR_SESION($dni, $clave)[0];
        if (trim($obj["mensaje"]) !== "Parece que las credenciales ingresadas no son correctas, por facor ingrese datos validos.") {
            $_SESSION["cod_empleado"] = $obj["cod_empleado"];
            $_SESSION["nombre"] = $obj["nombre"];
            $_SESSION["nivel_usuario"] = $obj["nivel_usuario"];
        } else {
            session_unset();
            session_destroy();
        }
        echo trim($obj["mensaje"]);
    }

    public static function CAMBIAR_CLAVE($clave, $nueva_clave) {
        session_start();
        $obj = self::BUSCAR_EMPLEADO($_SESSION["cod_empleado"], "return");
        if (trim($obj->mensaje) == "existe") {
            echo EmpleadoActions::CAMBIAR_CLAVE($obj->cod_empleado, $obj->dni, $clave, $nueva_clave);
        } else {
            echo trim($obj->mensaje);
        }
    }

    public static function CREAR_EMPLEADO(Empleado $empleado) {
        echo EmpleadoActions::CREAR_EMPLEADO($empleado);
    }

    public static function LISTAR_EMPLEADOS($option = "normal") {
        switch ($option) {
            case "json":
                echo json_encode(EmpleadoActions::LISTAR_EMPLEADOS());
                break;
            default:
                return EmpleadoActions::LISTAR_EMPLEADOS();
        }
    }

    public static function BUSCAR_EMPLEADO($cod_empleado, $option = "normal") {
        $obj = EmpleadoActions::BUSCAR_EMPLEADO($cod_empleado);
        if (trim($obj->mensaje) == "existe") {
            switch ($option) {
                case "return":
                    return $obj;
                default:
                    require_once './App/Views/Dashboard/Empleado/modal/editar.php';
                    break;
            }
        } else {
            echo trim($obj->mensaje);
        }
    }

    public static function EDITAR_EMPLEADO(Empleado $empleado) {
        echo EmpleadoActions::EDITAR_EMPLEADO($empleado);
    }

    public static function FILTRAR_EMPLEADOS($nombre, $dni) {
        $lista = EmpleadoActions::FILTRAR_EMPLEADOS($nombre, $dni);
        if ($lista[0]["mensaje"] == "existe") {
            echo json_encode($lista);
        } else {
            echo $lista[0]["mensaje"];
        }
    }

}
