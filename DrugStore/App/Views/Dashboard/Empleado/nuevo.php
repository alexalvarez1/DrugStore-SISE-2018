<?php
require_once './App/Views/_shared/Dashboard/PanelOptionActive.php';
$option["empleados"] = "active";
require_once './App/Views/_shared/Dashboard/PanelGeneral.php';
?>

<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <div class="row">
        <ol class="breadcrumb">
            <li>
                <a href="/<?php echo PROJECT_NAME; ?>/Dashboard">
                    <em class="fa fa-home"></em>
                </a>
            </li>
            <li class="active">Dashboard/Empleado/nuevo</li>
        </ol>
    </div>
    <br>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading text-center">
                    Registrar nuevo empleado
                    <span class="pull-right clickable panel-toggle panel-button-tab-left">
                        <em class="fa fa-toggle-up"></em>
                    </span>
                </div>
                <div class="panel-body">
                    <form id="frm_nuevoempleado" class="form-row" autocomplete="off" spellcheck="false" style="max-width: 600px;margin: 0 auto;">
                        <div class="col-sm-12">
                            <label class="col-form-label-sm">Nombre</label>
                            <input name="nombre" type="text" class="form-control" data-letra placeholder="Ingrese el nombre del empleado" data-letra autofocus required>
                        </div>
                        <div class="col-sm-6" style="margin-top: 1.8rem;">
                            <label class="col-form-label-sm">DNI</label>
                            <input name="dni" type="text" class="form-control" data-numero placeholder="Ingrese el DNI del empleado" data-numero required>
                        </div>
                        <div class="col-sm-6" style="margin-top: 1.8rem;">
                            <label class="col-form-label-sm">Clave</label>
                            <input name="clave" type="password" class="form-control" placeholder="Ingrese la clave del empleado" required>
                        </div>
                        <div class="col-sm-12" style="margin-top: 1.8rem;">
                            <label class="col-form-label-sm">Nivel de usuario</label>                            
                            <select name="nivel_usuario" class="form-control" style="cursor: pointer;">
                                <option>vendedor</option>
                                <option>admin</option>
                            </select>
                        </div>
                        <div class="col-sm-12" style="margin-top: 1.8rem;">
                            <label class="col-form-label-sm">Dirección</label>
                            <input name="direccion" type="text" class="form-control" placeholder="Ingrese la dirección del empleado" required>
                        </div>
                        <div class="col-sm-12" style="margin-top: 1.8rem;">
                            <label class="col-form-label-sm">Teléfono</label>
                            <input name="telefono" type="tel" class="form-control" placeholder="Ingrese el # de teléfono del empleado" data-numero required>
                        </div>
                        <div class="col-sm-12 text-center" style="margin-top: 1.8rem;">
                            <button class="btn btn-primary" type="submit">Grabar empleado</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-12">
        <p class="back-link">&COPY; Todos los derechos reservados para <?php echo PROJECT_NAME . " " . getdate()["year"]; ?> | <b>JAAC</b></p>
    </div>
</div>

<script type="text/javascript">
    window.onload = function () {
        var html = '<div class="col-sm-12 animated bounceInDown" style="margin-top: 1.8rem;">'
                + '<label class="col-form-label-sm">Sueldo base</label>'
                + '<input name="sueldo_base" type="tel" class="form-control" placeholder="Ingrese el sueldo base" data-precio required>'
                + '</div>';
        $("#frm_nuevoempleado select[name='nivel_usuario']").on("change", function () {
            if ($(this).val().trim() === "admin") {
                $("#frm_nuevoempleado").children("div:eq(5)").after(html);
            } else {
                $("#frm_nuevoempleado").children("div:eq(6)").remove();
            }
        });
    };
</script>