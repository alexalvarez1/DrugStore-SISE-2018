<?php
session_start();
if (count($_SESSION) > 0) {
    header("location: Dashboard");
}
?>
<!doctype html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
        <link href="/<?php echo PROJECT_NAME; ?>/Resources/img/general/pharmacy.png" rel="shortcut icon" type="image/x-icon"/>
        <link href="/<?php echo PROJECT_NAME; ?>/Resources/bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css"/>
        <link href="/<?php echo PROJECT_NAME; ?>/Resources/fontawesome/css/all.css" rel="stylesheet" type="text/css"/>
        <link href="/<?php echo PROJECT_NAME; ?>/Resources/css/animated.css" rel="stylesheet" type="text/css"/>
        <link href="/<?php echo PROJECT_NAME; ?>/Resources/login/css/main.css" rel="stylesheet" type="text/css"/>
        <link href="/<?php echo PROJECT_NAME; ?>/Resources/login/css/util.css" rel="stylesheet" type="text/css"/>
        <link href="/<?php echo PROJECT_NAME; ?>/Resources/css/_main.css" rel="stylesheet" type="text/css"/>
        <title>DrugStore JAAC | <?php echo getdate()["year"]; ?></title>
    </head>
    <body>
        <div class="limiter">
            <div class="container-login100">
                <div class="wrap-login100  p-b-20">
                    <form class="login100-form validate-form" autocomplete="off" spellcheck="false">
                        <span class="login100-form-title p-b-70">
                            Bienvenido
                        </span>
                        <span class="login100-form-avatar">
                            <img src="/<?php echo PROJECT_NAME; ?>/Resources/img/general/pharmacy.png" draggable="false">
                        </span>

                        <div class="wrap-input100 validate-input m-t-85 m-b-35" data-validate = "No puede dejar el campo DNI vacio">
                            <input class="input100" type="tel" name="dni" data-numero>
                            <span class="focus-input100" data-placeholder="Ingrese su DNI"></span>
                        </div>

                        <div class="wrap-input100 validate-input m-b-50" data-validate="No puede dejar el campo Clave vacio">
                            <input class="input100" type="password" name="clave">
                            <span class="focus-input100" data-placeholder="Ingrse su clave"></span>
                        </div>

                        <div class="container-login100-form-btn">
                            <button class="login100-form-btn">
                                Ingresar
                            </button>
                        </div>                        
                    </form>
                </div>
            </div>
        </div>
        <div id="beforesend"></div>
        <div id="success"></div>
        <script src="/<?php echo PROJECT_NAME; ?>/Resources/js/jquery.js" type="text/javascript"></script>
        <script src="/<?php echo PROJECT_NAME; ?>/Resources/bootstrap/js/bootstrap.bundle.js" type="text/javascript"></script>
        <script src="/<?php echo PROJECT_NAME; ?>/Resources/js/swal.js" type="text/javascript"></script>
        <script src="/<?php echo PROJECT_NAME; ?>/Resources/login/js/main.js" type="text/javascript"></script>
        <script src="/<?php echo PROJECT_NAME; ?>/Resources/js/forms/inputs.js" type="text/javascript"></script>
    </body>
</html>
