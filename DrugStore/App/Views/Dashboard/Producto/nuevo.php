<?php
require_once './App/Views/_shared/Dashboard/PanelOptionActive.php';
$option["productos"] = "active";
require_once './App/Views/_shared/Dashboard/PanelGeneral.php';

$lista_proveedores = ProveedorController::LISTAR_PROVEEDORES();
?>

<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <div class="row">
        <ol class="breadcrumb">
            <li>
                <a href="/<?php echo PROJECT_NAME; ?>/Dashboard">
                    <em class="fa fa-home"></em>
                </a>
            </li>
            <li class="active">Dashboard/Producto/nuevo</li>
        </ol
    </div>
    <br>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading text-center">
                    Registrar nuevo producto
                    <span class="pull-right clickable panel-toggle panel-button-tab-left">
                        <em class="fa fa-toggle-up"></em>
                    </span>
                </div>
                <div class="panel-body">
                    <form id="frm_nuevoproducto" class="form-row" autocomplete="off" spellcheck="false" style="max-width: 600px;margin: 0 auto;">
                        <div class="col-sm-12">
                            <label class="col-form-label-sm">Código de referencia</label>
                            <input name="cod_referencia" type="text" class="form-control" placeholder="Ingrese el código de referencia por ejemplo: PROD-0001" autofocus required>
                        </div>
                        <div class="col-sm-12" style="margin-top: 1.8rem;">
                            <label class="col-form-label-sm">Nombre</label>
                            <input name="nombre_producto" type="text" class="form-control" data-letra placeholder="Ingrese el nombre del producto" required>
                        </div>
                        <div class="col-sm-12" style="margin-top: 1.8rem;">
                            <label class="col-form-label-sm">Descripción</label>
                            <textarea name="descripcion" class="form-control" placeholder="Ingrese la descripción del producto" required></textarea>
                        </div>
                        <div class="col-sm-6" style="margin-top: 1.8rem;">
                            <label class="col-form-label-sm">Stock</label>
                            <input name="stock" type="number" data-numero class="form-control" placeholder="Ingrese la cantidad de stock actual del producto" required>
                        </div>
                        <div class="col-sm-6" style="margin-top: 1.8rem;">
                            <?php $mes = getdate()["mon"] > 9 ? "0" . getdate()["mon"] : "0" . getdate()["mon"]; ?>
                            <label class="col-form-label-sm">Fecha de vencimiento</label>
                            <input name="fecha_vencimiento" type="date" value="<?php echo (getdate()["year"] - 1) . "-" . $mes . "-" . getdate()["mday"] ?>" class="form-control" required>
                        </div>
                        <div class="col-sm-12" style="margin-top: 1.8rem;">
                            <label class="col-form-label-sm">Subir imagen</label>
                            <div class="text-center">
                                <img src="<?php echo "/" . PROJECT_NAME . "/Resources/img/no-img.png" ?>" class="img-thumbnail" style="max-width: 186px">
                                <input name="rutaImagen" type="file" style="margin: 1.8rem auto;" required>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <label class="col-form-label-sm">Proveedor</label>
                            <select name="cod_proveedor" class="form-control" style="cursor: pointer;">
                                <?php foreach ($lista_proveedores as $fila) { ?>
                                    <option value="<?php echo $fila["cod_proveedor"]; ?>"><?php echo $fila["nombre"]; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="col-sm-12 text-center" style="margin-top: 1.8rem;">
                            <button class="btn btn-primary" type="submit">Grabar producto</button>
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