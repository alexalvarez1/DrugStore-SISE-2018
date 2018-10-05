<?php

class Controller extends DataBase {

    // El parametro $option, nos ayudará a distigir cuando sea una pagina fuera del diseño habitual
    public static function createView($folder, $view, $option = 0) {
        if ($option == 0) {
            require_once './App/Views/_shared/start_html.php';
            self::import_view($folder, $view);
            require_once './App/Views/_shared/end_html.php';
        } else if ($option == 1) {
            self::import_view($folder, $view);
        } else {
            
        }
    }

    private static function import_view($folder, $view) {
        if (file_exists("./App/Views/$folder/$view.php")) {
            require_once "./App/Views/$folder/$view.php";
        } else {
            require_once './App/Views/_shared/_error/404.php';
        }
    }

}
