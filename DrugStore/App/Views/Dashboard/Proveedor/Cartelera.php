<?php
require_once './App/Views/_shared/Dashboard/PanelOptionActive.php';
$option["proveedores"] = "active";
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
            <li class="active">Dashboard/Proveedor/cartelera</li>
        </ol>
    </div>
    <br>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading text-center">
                    Cartelera de proveedores
                    <span class="pull-right clickable panel-toggle panel-button-tab-left">
                        <em class="fa fa-toggle-up"></em>
                    </span>
                </div>
                <div class="panel-body">
                    <form id="frm_filtrarproveedor" class="form-row" autocomplete="off" spellcheck="false" style="max-width: 600px;margin: 0 auto;">                        
                        <h3 class="h5 text-center">Filtrar proveedores por : </h3>
                        <div class="col-sm-12">
                            <label class="col-form-label-sm">Nombre</label>
                            <input name="nombre" type="text" class="form-control" data-letra placeholder="Ingrese el nombre del proveedor" autofocus>
                        </div>
                        <div class="col-sm-12 text-center" style="margin-top: 1.8rem;">
                            <button type="submit" class="btn btn-info">Buscar proveedor</button>
                        </div>
                    </form>
                    <div class="tabla-contenedor">
                        <table class="tabla" data-tabla-cartelera-proveedores style="max-width: 1078px;min-width: 900px">
                            <tr>
                                <th hidden>cod_proveedor</th>
                                <th class="text-center">Nombre</th>
                                <th class="text-center">Dirección</th>
                                <th class="text-center">Pagina&nbsp;web</th>
                                <th class="text-center">Teléfono</th>
                                <th class="text-center">Acciones</th>
                            </tr>
                            <?php foreach ($lista_proveedores as $fila) { ?>
                                <tr>
                                    <td hidden><?php echo $fila["cod_proveedor"]; ?></td>
                                    <td class="text-center"><?php echo $fila["nombre"]; ?></td>
                                    <td class="text-center"><?php echo $fila["direccion"]; ?></td>
                                    <td class="text-center"><?php echo $fila["pagina_web"]; ?></td>
                                    <td class="text-center"><?php echo $fila["telefono"]; ?></td>
                                    <td>
                                        <span>
                                            <a href="#" data-editar-proveedor data-tooltip="Editar"><i class="fa fa-edit"></i></a>
                                        </span>
                                    </td>
                                </tr>
                            <?php } ?>
                            <tfoot><tr><td colspan="6"><ul></ul></td></tr></tfoot>
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
        Paginacion_tabla("data-tabla-cartelera-proveedores");
    };
</script>