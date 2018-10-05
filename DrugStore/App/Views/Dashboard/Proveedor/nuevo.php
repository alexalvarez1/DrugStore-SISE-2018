<?php
require_once './App/Views/_shared/Dashboard/PanelOptionActive.php';
$option["proveedores"] = "active";
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
            <li class="active">Dashboard/Proveedor/nuevo</li>
        </ol>
    </div>
    <br>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading text-center">
                    Registrar nuevo proveedor
                    <span class="pull-right clickable panel-toggle panel-button-tab-left">
                        <em class="fa fa-toggle-up"></em>
                    </span>
                </div>
                <div class="panel-body">
                    <form id="frm_nuevoproveedor" class="form-row" autocomplete="off" spellcheck="false" style="max-width: 600px;margin: 0 auto;">
                        <div class="col-sm-12">
                            <label class="col-form-label-sm">Nombre</label>
                            <input name="nombre" type="text" class="form-control" data-letra placeholder="Ingrese el nombre del proveedor" autofocus>
                        </div>
                        <div class="col-sm-12" style="margin-top: 1.8rem;">
                            <label class="col-form-label-sm">Dirección</label>
                            <input name="direccion" type="text" class="form-control" placeholder="Ingrese la dirección del proveedor">
                        </div>
                        <div class="col-sm-12" style="margin-top: 1.8rem;">
                            <label class="col-form-label-sm">Pagina web</label>
                            <input name="pagina_web" type="text" class="form-control" placeholder="Ingrese pagina web del proveedor">
                        </div>
                        <div class="col-sm-12" style="margin-top: 1.8rem;">
                            <label class="col-form-label-sm">Teléfono</label>
                            <input name="telefono" type="tel" class="form-control" placeholder="Ingrese el # de teléfono del proveedor">
                        </div>
                        <div class="col-sm-12 text-center" style="margin-top: 1.8rem;">
                            <button class="btn btn-primary" type="submit">Grabar proveedor</button>
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