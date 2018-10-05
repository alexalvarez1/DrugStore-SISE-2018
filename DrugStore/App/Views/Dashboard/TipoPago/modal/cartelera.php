<?php
// esta vista no puede ser presentada al usuario desde la URL
if (filter_input(INPUT_GET, "url") == "Dashboard/TipoPago/modal/cartelera") {
    header("location: /" . PROJECT_NAME . "/Dashboard");
}
$lista_tipo_pagos = Tipo_pagoController::LISTA_TIPO_PAGO();
?>

<div class="modal fade" id="carteleratipopago_modal" data-backdrop="static">
    <div class="modal-dialog" style="width: 90%; max-width: 1180px">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" style="float: left;">Tipos de pago actuales</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="tabla-contenedor">
                    <table class="tabla" data-tabla-cartelera-tipopago style="max-width: 800px;min-width: 900px">
                        <tr>
                            <th hidden>cod_tipo_pago</th>
                            <th class="text-center">Tipo</th>
                            <th class="text-center">Descripción</th>
                        </tr>
                        <?php foreach ($lista_tipo_pagos as $fila) { ?>
                            <tr>
                                <td hidden><?php echo $fila[""]; ?></td>
                                <td class="text-center"><?php echo $fila["tipo"]; ?></td>
                                <td class="text-center"><?php echo $fila["descripcion"]; ?></td>
                            </tr>
                        <?php } ?>
                        <tfoot><tr><td colspan="3"><ul></ul></td></tr></tfoot>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
<!-- Controlar filas y columnas que se muestran en la tabla -->
<script type="text/javascript">
    window.onload = () => {
        Paginacion_tabla("data-tabla-cartelera-tipopago");
    };
</script>