<?php
// esta vista no puede ser presentada al usuario desde la URL
if (filter_input(INPUT_GET, "url") == "Dashboard/PuntoVenta/modal/editar") {
    header("location: /" . PROJECT_NAME . "/Dashboard/");
}
?>
<div class="modal fade" id="frm_editartipopago_modal" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" style="float: left; display: flex;align-items: center;">
                    <i class="fa fa-money-bill-alt fa-3x text-info"></i>&nbsp;
                    Tipo de pago
                </h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="frm_editartipopago" class="form-row" autocomplete="off" spellcheck="false">
                    <input name="cod_tipo_pago" type="hidden" value="<?php echo $obj->cod_tipo_pago; ?>">
                    <div class="col-12">
                        <label class="col-form-label-sm">Nombre</label>
                        <input name="tipo" type="text" value="<?php echo $obj->tipo; ?>" class="form-control" placeholder="Ingrese el tipo de pago" autofocus required>
                    </div>
                    <div class="col-12" style="margin-top: 1.8rem;">
                        <label class="col-form-label-sm">Dirección</label>
                        <input name="descripcion" type="text" value="<?php echo $obj->descripcion; ?>" class="form-control" placeholder="Ingrese una descripcion del tipo de pago" required>
                    </div>
                    <div class="col-12 text-center" style="margin-top: 1.8rem;">
                        <button type="submit" class="btn btn-primary">Guardar cambios</button>
                    </div>
                </form>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>