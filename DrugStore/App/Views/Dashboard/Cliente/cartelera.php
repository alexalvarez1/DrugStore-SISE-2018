<?php
require_once './App/Views/_shared/Dashboard/PanelOptionActive.php';
$option["clientes"] = "active";
require_once './App/Views/_shared/Dashboard/PanelGeneral.php';
$lista_clientes = ClienteActions::LISTAR_CLIENTES();
?>

<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <div class="row">
        <ol class="breadcrumb">
            <li>
                <a href="/<?php echo PROJECT_NAME; ?>/Dashboard">
                    <em class="fa fa-home"></em>
                </a>
            </li>
            <li class="active">Dashboard/Cliente/cartelera</li>
        </ol>
    </div>
    <br>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading text-center">
                    Cartelera de clientes
                    <span class="pull-right clickable panel-toggle panel-button-tab-left">
                        <em class="fa fa-toggle-up"></em>
                    </span>
                </div>
                <div class="panel-body">
                    <form id="frm_filtrarcliente" class="form-row" autocomplete="off" spellcheck="false" style="max-width: 600px;margin: 0 auto;">
                        <h3 class="h5 text-center">Filtrar clientes por : </h3>
                        <div class="col-sm-12">
                            <label class="col-form-label-sm">Nombre</label>
                            <input name="nombre" type="text" class="form-control" data-letra placeholder="Ingrese el nombre del cliente" autofocus>
                        </div>
                        <div class="col-sm-12 text-center" style="margin-top: 1.8rem;">
                            <button type="submit" class="btn btn-info">Buscar cliente</button>
                        </div>
                    </form>
                    <div class="tabla-contenedor">
                        <table class="tabla" data-tabla-cartelera-clientes style="max-width: 1078px;min-width: 900px">
                            <tr>
                                <th hidden>cod_cliente</th>
                                <th class="text-center">Nombre</th>
                                <th class="text-center">Dirección</th>
                                <th class="text-center">Teléfono</th>
                                <th class="text-center">Acciones</th>
                            </tr>
                            <?php foreach ($lista_clientes as $fila) { ?>
                                <tr>
                                    <td hidden><?php echo $fila["cod_cliente"]; ?></td>
                                    <td class="text-center"><?php echo $fila["nombre"]; ?></td>
                                    <td class="text-center"><?php echo $fila["direccion"]; ?></td>
                                    <td class="text-center"><?php echo $fila["telefono"]; ?></td>
                                    <td>
                                        <span>
                                            <a href="#" data-editar-cliente data-tooltip="Editar"><i class="fa fa-edit"></i></a>
                                        </span>
                                    </td>
                                </tr>
                            <?php } ?>
                            <tfoot><tr><td colspan="4"><ul></ul></td></tr></tfoot>
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
        Paginacion_tabla("data-tabla-cartelera-clientes");
    };
</script>