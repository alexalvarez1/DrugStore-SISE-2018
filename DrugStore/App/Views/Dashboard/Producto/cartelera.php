<?php
require_once './App/Views/_shared/Dashboard/PanelOptionActive.php';
$option["productos"] = "active";
require_once './App/Views/_shared/Dashboard/PanelGeneral.php';
$lista_productos = ProductoController::LISTAR_PRODUCTOS();
?>

<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <div class="row">
        <ol class="breadcrumb">
            <li>
                <a href="/<?php echo PROJECT_NAME; ?>/Dashboard">
                    <em class="fa fa-home"></em>
                </a>
            </li>
            <li class="active">Dashboard/Producto/cartelera</li>
        </ol>
    </div>
    <br>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading text-center">
                    Cartelera de productos
                    <span class="pull-right clickable panel-toggle panel-button-tab-left">
                        <em class="fa fa-toggle-up"></em>
                    </span>
                </div>
                <div class="panel-body">
                    <form id="frm_filtrarproducto" class="form-row" autocomplete="off" spellcheck="false" style="max-width: 600px;margin: 0 auto;">                        
                        <h3 class="h5 text-center">Filtrar productos por : </h3>
                        <div class="col-sm-6">
                            <label class="col-form-label-sm">Código de referencia</label>
                            <input name="cod_referencia" type="text" class="form-control" placeholder="Ingrese el código de referencia por ejemplo: PROD-0001" autofocus>
                        </div>
                        <div class="col-sm-6">
                            <label class="col-form-label-sm">Nombre</label>
                            <input name="nombre_producto" type="text" class="form-control" data-letra placeholder="Ingrese el nombre del producto">
                        </div>
                        <div class="col-sm-12 text-center" style="margin-top: 1.8rem;">
                            <button type="submit" class="btn btn-info">Buscar producto</button>
                        </div>
                    </form>
                    <div class="tabla-contenedor">
                        <table class="tabla" data-tabla-cartelera-productos style="max-width: 1078px;min-width: 900px">
                            <tr>
                                <th hidden>cod_producto</th>
                                <th class="text-center">Imagen</th>
                                <th class="text-center">Código&nbsp;de&nbsp;referencia</th>
                                <th class="text-center">Nombre</th>
                                <th class="text-center">Descripción</th>
                                <th class="text-center">Stock</th>
                                <th class="text-center">estado</th>
                                <th class="text-center">Acciones</th>
                            </tr>
                            <?php foreach ($lista_productos as $fila) { ?>
                                <tr>
                                    <td hidden><?php echo $fila["cod_producto"]; ?></td>
                                    <td class="text-center">
                                        <img src="<?php echo "/" . PROJECT_NAME . "/Resources/img/productos/" . $fila["rutaImagen"] ?>" class="img-thumbnail" width="100" draggable="false">
                                    </td>
                                    <td class="text-center"><?php echo $fila["cod_referencia"]; ?></td>
                                    <td class="text-center"><?php echo $fila["nombre_producto"]; ?></td>
                                    <td class="text-center"><?php echo $fila["descripcion"]; ?></td>
                                    <td class="text-center"><?php echo $fila["stock"]; ?></td>
                                    <td class="text-center"><?php echo $fila["estado"]; ?></td>
                                    <td>
                                        <span>
                                            <!--<a href="#" data-tooltip="Taer&nbsp;al&nbsp;frente"><i class="fa fa-eye"></i></a>-->
                                            <a href="#" data-editar-producto data-tooltip="Editar"><i class="fa fa-edit"></i></a>
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
        Paginacion_tabla("data-tabla-cartelera-productos");
    };
</script>