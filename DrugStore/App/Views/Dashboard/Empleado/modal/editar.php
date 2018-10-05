<?php
// esta vista no puede ser presentada al usuario desde la URL
if (filter_input(INPUT_GET, "url") == "Dashboard/Empleado/modal/editar") {
    header("location: /" . PROJECT_NAME . "/Dashboard/Empleado/cartelera");
}
?>
<div class="modal fade" id="frm_editarempleado_modal" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" style="float: left; display: flex;align-items: center;">
                    <i class="fa fa-edit fa-3x text-info"></i>&nbsp;
                    Editar cliente
                </h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="frm_editarempleado"  class="row" autocomplete="off" spellcheck="false">
                    <input name="cod_empleado" type="hidden" value="<?php echo $obj->cod_empleado; ?>">
                    <div class="col-sm-12">
                        <label class="col-form-label-sm">Nombre</label>
                        <input name="nombre" type="text" class="form-control" value="<?php echo $obj->nombre; ?>" data-letra placeholder="Ingrese el nombre del empleado" data-letra autofocus required>
                    </div>
                    <div class="col-sm-6" style="margin-top: 1.8rem;">
                        <label class="col-form-label-sm">DNI</label>
                        <input name="dni" type="text" class="form-control" value="<?php echo $obj->dni; ?>" data-numero placeholder="Ingrese el DNI del empleado" data-numero required>
                    </div>
                    <div class="col-sm-6" style="margin-top: 1.8rem;">
                        <label class="col-form-label-sm">Teléfono</label>
                        <input name="telefono" type="tel" class="form-control" value="<?php echo $obj->telefono; ?>" placeholder="Ingrese el # de teléfono del empleado" data-numero required>
                    </div>
                    <div class="col-sm-12" style="margin-top: 1.8rem;">
                        <label class="col-form-label-sm">Dirección</label>
                        <input name="direccion" type="text" class="form-control" value="<?php echo $obj->direccion; ?>" placeholder="Ingrese la dirección del empleado" required>
                    </div>
                    <div class="col-sm-12 text-center" style="margin-top: 1.8rem;">
                        <button class="btn btn-primary" type="submit">Guardar cambios</button>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>