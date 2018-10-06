<?php
// esta vista no puede ser presentada al usuario desde la URL
if (filter_input(INPUT_GET, "url") == "Dashboard/Empleado/modal/cambiarclave") {
    header("location: /" . PROJECT_NAME . "/Dashboard");
}
?>
<div class="modal fade" id="frm_cambiarclave_modal" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" style="float: left; display: flex;align-items: center;">
                    <i class="fa fa-lock fa-3x text-warning"></i>&nbsp;
                    Cambiar mi clave
                </h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="frm_cambiarclave" class="row" autocomplete="off" spellcheck="false">
                    <div class="col-sm-12">
                        <label class="col-form-label-sm">Clave</label>
                        <input name="clave" type="password" class="form-control" placeholder="Ingrese su clave" autofocus required>
                    </div>
                    <div class="col-sm-12" style="margin-top: 1.8rem;">
                        <label class="col-form-label-sm">Nueva clave</label>
                        <input name="nueva_clave" type="password" class="form-control" placeholder="Ingrese su nueva clave" required>
                    </div>
                    <div class="col-sm-12" style="margin-top: 1.8rem;">
                        <label class="col-form-label-sm">Confirmar clave</label>
                        <input name="confirmar_clave" type="password" class="form-control" placeholder="Confirme su nueva clave" required>
                    </div>
                    <div class="col-sm-12 text-center" style="margin-top: 1.8rem;">
                        <button class="btn btn-primary" type="submit">Guardar cambios</button>
                    </div>
                </form>
            </div>
            <div class="modal-footer d-flex">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Cerrar</button>                
            </div>
        </div>
    </div>
</div>