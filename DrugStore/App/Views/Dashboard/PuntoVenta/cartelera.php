<?php
require_once './App/Views/_shared/Dashboard/PanelOptionActive.php';
$option["puntoventa"] = "active";
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
            <li class="active">Dashboard/PuntoVenta/cartelera</li>
        </ol>
    </div>
    <br>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading text-center">
                    Cartelera de ventas
                    <span class="pull-right clickable panel-toggle panel-button-tab-left">
                        <em class="fa fa-toggle-up"></em>
                    </span>
                </div>
                <div class="panel-body">
                    <form class="form-row" autocomplete="off" spellcheck="false" style="max-width: 600px;margin: 0 auto;">                        
                        <h3 class="h5 text-center">Filtrar ventas por : </h3>
                        <div class="col-sm-6">
                            <label class="col-form-label-sm">Empleado</label>
                            <select name="cod_empleado" class="form-control" style="cursor: pointer;" autofocus>
                                <option value="">Empleado 1</option>
                                <option value="">Empleado 2</option>
                                <option value="">Empleado 3</option>
                                <option value="">Empleado 4</option>
                                <option value="">Empleado 5</option>
                            </select>
                        </div>
                        <div class="col-sm-6">
                            <label class="col-form-label-sm">Tipo de pago</label>
                            <select name="cod_tipo_pago" class="form-control" style="cursor: pointer;">
                                <option value="">Cash</option>
                                <option value="">Tarjeta</option>
                            </select>
                        </div>
                        <div class="col-sm-12 text-center" style="margin-top: 1.8rem;">
                            <button type="submit" class="btn btn-info">Buscar ventas</button>
                        </div>
                    </form>
                    <div class="tabla-contenedor">
                        <table class="tabla" data-tabla-cartelera-listapedidos style="max-width: 1078px;min-width: 900px">
                            <tr>
                                <th hidden>cod_lista_pedido</th>
                                <th class="text-center">Cliente</th>
                                <th class="text-center">Empleado</th>
                                <th class="text-center">Tipo&nbsp;de&nbsp;pago</th>
                                <th class="text-center">Acciones</th>
                            </tr>
                            <?php for ($i = 0; $i < 100; $i++) { ?>
                                <tr>
                                    <td hidden><?php echo $i + 1 ?></td>
                                    <td class="text-center">test</td>
                                    <td class="text-center">test</td>
                                    <td class="text-center">test</td>
                                    <td>
                                        <span>
                                            <a href="#" data-ListPedido data-tooltip="Detallar&nbsp;orden&nbsp;de&nbsp;productos"><i class="fa fa-eye"></i></a>
                                        </span>
                                    </td>
                                </tr>
                            <?php } ?>
                            <tfoot><tr><td colspan="7"><ul></ul></td></tr></tfoot>
                        </table>
                    </div>         
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-12">
        <p class="back-link">&COPY; Todos los derechos reservados para <?php echo PROJECT_NAME . " " . getdate()["year"]; ?> | <b>JAAC</b></p>
    </div>
</div>
<!-- Controlar filas y columnas que se muestran en la tabla -->
<script type="text/javascript">
    window.onload = () => {
        Paginacion_tabla("data-tabla-cartelera-listapedidos");
    };
</script>