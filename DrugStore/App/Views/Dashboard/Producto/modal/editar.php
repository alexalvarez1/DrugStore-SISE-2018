<?php
// esta vista no puede ser presentada al usuario desde la URL
if (filter_input(INPUT_GET, "url") == "Dashboard/Producto/modal/editar") {
    header("location: /" . PROJECT_NAME . "/Dashboard/Producto/cartelera");
}
$lista_proveedores = ProveedorController::LISTAR_PROVEEDORES();
?>
<div class="modal fade" id="frm_editarproducto_modal" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" style="float: left; display: flex;align-items: center;">
                    <i class="fa fa-edit fa-3x text-info"></i>&nbsp;
                    Editar Producto
                </h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="frm_editarproducto" class="row" autocomplete="off" spellcheck="false" style="max-width: 600px;margin: 0 auto;">
                    <input name="cod_producto" type="hidden" value="<?php echo $obj->cod_producto; ?>">
                    <div class="col-sm-12">
                        <label class="col-form-label-sm">Código de referencia</label>
                        <input name="cod_referencia" type="text" class="form-control" placeholder="Ingrese el código de referencia por ejemplo: PROD-0001" value="<?php echo $obj->cod_referencia; ?>" autofocus required>
                    </div>
                    <div class="col-sm-12" style="margin-top: 1.8rem;">
                        <label class="col-form-label-sm">Nombre</label>
                        <input name="nombre_producto" type="text" class="form-control" data-letra placeholder="Ingrese el nombre del producto" value="<?php echo $obj->nombre_producto; ?>" required>
                    </div>
                    <div class="col-sm-12" style="margin-top: 1.8rem;">
                        <label class="col-form-label-sm">Descripción</label>
                        <textarea name="descripcion" class="form-control" placeholder="Ingrese la descripción del producto" required><?php echo $obj->descripcion; ?></textarea>
                    </div>
                    <div class="col-sm-6" style="margin-top: 1.8rem;">
                        <label class="col-form-label-sm">Stock</label>
                        <input name="stock" type="number" data-numero class="form-control" placeholder="Ingrese la cantidad de stock actual del producto" value="<?php echo $obj->stock; ?>" required>
                    </div>
                    <div class="col-sm-6" style="margin-top: 1.8rem;">
                        <?php $mes = getdate()["mon"] > 9 ? "0" . getdate()["mon"] : "0" . getdate()["mon"]; ?>
                        <label class="col-form-label-sm">Fecha de vencimiento</label>
                        <input name="fecha_vencimiento" type="date" class="form-control"  required>
                    </div>
                    <div class="col-sm-12" style="margin-top: 1.8rem;">
                        <label class="col-form-label-sm">Subir imagen</label>
                        <div class="text-center">
                            <img src="<?php echo "/" . PROJECT_NAME . "/Resources/img/productos/" . $obj->rutaImagen; ?>" class="img-thumbnail" style="max-width: 186px">
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
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(function () {
        $("#frm_editarproducto select[name='cod_proveedor']").val('<?php echo $obj->cod_proveedor; ?>');
        var fecha = new moment(new Date('<?php echo $obj->fecha_vencimiento; ?>')).format("YYYY-MM-DD");
        $("#frm_editarproducto input[name='fecha_vencimiento']").val(fecha);
    });
</script>