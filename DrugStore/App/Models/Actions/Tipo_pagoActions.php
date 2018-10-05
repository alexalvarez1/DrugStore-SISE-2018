<?php

class Tipo_pagoActions {

    public static function LISTA_TIPO_PAGO() {
        $sql = "CALL LISTA_TIPO_PAGO()";
        return Tipo_pagoController::query($sql);
    }

}
