<?php
// esta vista no puede ser presentada al usuario desde la URL
if (filter_input(INPUT_GET, "url") == "Dashboard/Proveedor/modal/editar") {
    header("location: /" . PROJECT_NAME . "/Dashboard/Proveedor/cartelera");
}
?>
<div class="modal fade" id="frm_editarproveedor_modal" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" style="float: left; display: flex;align-items: center;">
                    <i class="fa fa-edit fa-3x text-info"></i>&nbsp;
                    Editar Proveedor
                </h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="frm_editarproveedor" class="form-row" autocomplete="off" spellcheck="false">
                    <input name="cod_proveedor" type="hidden" value="<?php echo $obj->cod_proveedor; ?>">
                    <div class="col-12">
                        <label class="col-form-label-sm">Nombre</label>
                        <input name="nombre" type="text" value="<?php echo $obj->nombre; ?>" class="form-control" placeholder="Ingrese el nombre del proveedor" autofocus required>
                    </div>
                    <div class="col-12" style="margin-top: 1.8rem;">
                        <label class="col-form-label-sm">Dirección</label>
                        <input name="direccion" type="text" value="<?php echo $obj->direccion; ?>" class="form-control" placeholder="Ingrese la dirección del proveedor" required>
                    </div>
                    <div class="col-12" style="margin-top: 1.8rem;">
                        <label class="col-form-label-sm">Teléfono</label>
                        <input name="pagina_web" type="tel" value="<?php echo $obj->pagina_web; ?>" class="form-control" placeholder="Ingrese la pagina web del proveedor" required>
                    </div>
                    <div class="col-12" style="margin-top: 1.8rem;">
                        <label class="col-form-label-sm">Teléfono</label>
                        <input name="telefono" type="tel" value="<?php echo $obj->telefono; ?>" class="form-control" placeholder="Ingrese el # de teléfono del proveedor" required>
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