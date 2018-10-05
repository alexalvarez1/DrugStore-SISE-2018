<?php

class EmpleadoActions {

    public static function INICIAR_SESION($dni, $clave) {
        $sql = "CALL INICIAR_SESION(?,?)";
        $parametros = array($dni, $clave);
        return EmpleadoController::query($sql, $parametros, "SELECT");
    }

    public static function CREAR_EMPLEADO(Empleado $empleado) {
        try {
            $sql = "CALL CREAR_EMPLEADO(?,?,?,?,?,?,?)";
            $parametros = array(
                $empleado->getNombre(),
                $empleado->getDni(),
                $empleado->getClave(),
                $empleado->getNivel_usuario(),
                $empleado->getDireccion(),
                $empleado->getTelefono(),
                $empleado->getSueldo_base()
            );
            $msg = EmpleadoController::query($sql, $parametros, "SELECT")[0]["mensaje"];
        } catch (Exception $exc) {
            if ($exc->getCode() == 23000) {
                $msg = "Parece que el DNI ingresado ya existe sobre otro registro en su cartelera actual de empleados. Por favor ingrese otro diferente al actual.";
            }
        }
        return $msg;
    }

    public static function LISTAR_EMPLEADOS() {
        $sql = "CALL LISTAR_EMPLEADOS()";
        return EmpleadoController::query($sql);
    }

    public static function BUSCAR_EMPLEADO($cod_empleado) {
        $sql = "CALL BUSCAR_EMPLEADO(?)";
        $parametros = array($cod_empleado);
        return EmpleadoController::query($sql, $parametros, "OBJECT")[0];
    }

    public static function EDITAR_EMPLEADO(Empleado $empleado) {
        try {
            $sql = "CALL EDITAR_EMPLEADO(?,?,?,?,?)";
            $parametros = array(
                $empleado->getCod_empleado(),
                $empleado->getNombre(),
                $empleado->getDni(),
                $empleado->getDireccion(),
                $empleado->getTelefono()
            );
            $msg = EmpleadoController::query($sql, $parametros, "SELECT")[0]["mensaje"];
        } catch (Exception $exc) {
            if ($exc->getCode() == 23000) {
                $msg = "Parece que el DNI ingresado ya existe sobre otro registro en su cartelera actual de empleados. Por favor ingrese otro diferente al actual.";
            }
        }
        return $msg;
    }

    public static function FILTRAR_EMPLEADOS($nombre, $dni) {
        $sql = "CALL FILTRAR_EMPLEADOS(?,?)";
        $parametros = array($nombre, $dni);
        return EmpleadoController::query($sql, $parametros, "SELECT");
    }

}
