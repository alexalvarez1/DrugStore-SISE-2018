<?php
// esta vista no puede ser presentada al usuario desde la URL
if (filter_input(INPUT_GET, "url") == "Dashboard/PuntoVenta/modal/ordenPedido") {
    header("location: /" . PROJECT_NAME . "/Dashboard/PuntoVenta/cartelera");
}
?>

<div class="modal fade" id="ordenPedido_modal" data-backdrop="static">
    <div class="modal-dialog" style="width: 90%; max-width: 1180px">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" style="float: left;">Orden de pedido</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p class="text-center h5">Monto total:
                    <span class="h4">S/.100.00</span>
                </p>
                <div class="tabla-contenedor">
                    <table class="tabla" data-tabla-cartelera-productos style="max-width: 1078px;min-width: 900px">
                        <tr>
                            <th hidden>cod_orden_pedido</th>
                            <th class="text-center">Imagen</th>
                            <th class="text-center">Código&nbsp;de&nbsp;referencia</th>
                            <th class="text-center">Nombre&nbsp;del&nbsp;producto</th>
                            <th class="text-center">Cantidad</th>
                            <th class="text-center">Precio&nbsp;/&nbsp;Unidad</th>
                            <th class="text-center">Monto</th>
                        </tr>
                        <?php for ($i = 0; $i < 4; $i++) { ?>
                            <tr>
                                <td hidden>12</td>
                                <td class="text-center">
                                    <img src="<?php echo "/" . PROJECT_NAME . "/Resources/img/no-img.png" ?>" class="img-thumbnail" width="100" draggable="false">
                                </td>
                                <td class="text-center">PROD-000<?php echo $i + 1 ?></td>
                                <td class="text-center">Nombre&nbsp;del&nbsp;producto<?php echo $i + 1 ?></td>
                                <td class="text-center">1</td>
                                <td class="text-center">S/.25.00</td>
                                <td class="text-center">S/.25.00</td>
                            </tr>
                        <?php } ?>
                        <tfoot><tr><td colspan="7"><ul></ul></td></tr></tfoot>
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
        Paginacion_tabla("data-tabla-cartelera-productos");
    };
</script>