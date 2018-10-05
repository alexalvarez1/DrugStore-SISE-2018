<?php

class ListaPedidoActions {

    public static function CANT_VENTAS() {
        $sql = "CALL CANT_VENTAS()";
        return ListaPedidoController::query($sql)[0]["cantidad"];
    }

}
