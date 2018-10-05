<?php

// Insertamos las nuevas url de una sola definición
Route::$urls = array(
    "", "Home", "IniciarSesion",
    "Dashboard",
);
// Aqui, validamos las nuesvas url disponibles de una sola definición
Route::SET_URL(function ($path) {
    switch ($path) {
        case "":
        case "Home":
        case "IniciarSesion":
            Controller::createView("Home", "IniciarSesion", 1);
            break;
        case "Dashboard":
            Controller::createView("Dashboard", "principal");
            break;
        default:
            Routes::validar_rutas($path);
            break;
    }
});

class Routes {

    public static function validar_rutas($path) {
        // PREGUNTAMOS QUE: si hay un caracter / en la ultima posicion de $path
        // SI HAY, la eliminamos y recargamos la pagina
        // SI NO HAY, solo creamos las sub vista
        if (strrpos($path, "/", strlen($path) - 1)) {
            $_path = substr($path, 0, strlen($path) - 1);
            $scheme = filter_input(INPUT_SERVER, "REQUEST_SCHEME");
            $host = filter_input(INPUT_SERVER, "HTTP_HOST");
            $uri = dirname(filter_input(INPUT_SERVER, "PHP_SELF"));
            header("Location: $scheme://$host$uri/$_path");
        } else {
            self::crear_sub_vistas($path);
        }
    }

    private static function crear_sub_vistas($_path) {
        $folder = explode("/", $_path);
        $count_folder = count($folder);
        $concat = "";
        if ($count_folder >= 3) {
            $count_folder--;
            foreach ($folder as $key => $value) {
                if ($key != $count_folder) {
                    $concat .= $value . "/";
                }
            }
            $concat = substr($concat, 0, strlen($concat) - 1);
            Controller::createView($concat, $folder[$count_folder]);
        } else {
            Controller::createView($folder[0], $folder[1]);
        }
    }

}
