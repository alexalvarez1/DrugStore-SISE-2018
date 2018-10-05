<?php

class Tipo_pagoController extends Controller {

    public static function LISTA_TIPO_PAGO($option = "normal") {
        switch ($option) {
            case "json":
                echo json_encode(Tipo_pagoActions::LISTA_TIPO_PAGO());
                break;
            default:
                return Tipo_pagoActions::LISTA_TIPO_PAGO();
        }
    }

}
