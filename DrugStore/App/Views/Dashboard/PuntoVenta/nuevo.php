<?php
require_once './App/Views/_shared/Dashboard/PanelOptionActive.php';
$option["puntoventa"] = "active";
require_once './App/Views/_shared/Dashboard/PanelGeneral.php';

$lista_clientes = ClienteController::LISTAR_CLIENTES();
$lista_tipo_pagos = Tipo_pagoController::LISTA_TIPO_PAGO();
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
            <li class="active">Dashboard/PuntoVenta/nuevo</li>
        </ol>
    </div> 
    <br>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading text-center">
                    Paso 1 | Seleccionar cliente
                    <span class="pull-right clickable panel-toggle panel-button-tab-left">
                        <em class="fa fa-toggle-up"></em>
                    </span>
                </div>
                <div class="panel-body">
                    <form class="form-row" autocomplete="off" spellcheck="false" style="max-width: 600px;margin: 0 auto;">
                        <div class="col-sm-12">
                            <label class="col-form-label-sm">Cliente</label>
                            <select name="cod_cliente" class="form-control" style="cursor: pointer;" autofocus>
                                <?php foreach ($lista_clientes as $fila) { ?>
                                    <option value="<?php echo $fila["cod_cliente"]; ?>"><?php echo $fila["nombre"]; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="col-sm-12" style="margin-top: 1.8rem;">
                            <label class="col-form-label-sm">Tipo de pago</label>
                            <select name="cod_tipo_pago" class="form-control" style="cursor: pointer;">
                                <?php foreach ($lista_tipo_pagos as $fila) { ?>
                                    <option value="<?php echo $fila["cod_tipo_pago"]; ?>"><?php echo $fila["tipo"]; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="col-sm-12 text-center" style="margin-top: 1.8rem;">
                            <button class="btn btn-warning" type="submit">Continuar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading text-center">
                    Paso 2 | Seleccionar productos
                    <span class="pull-right clickable panel-toggle panel-button-tab-left">
                        <em class="fa fa-toggle-up"></em>
                    </span>
                </div>
                <div class="panel-body">
                    <form class="form-row" autocomplete="off" spellcheck="false" style="max-width: 600px;margin: 0 auto;">                        
                        <h3 class="h5 text-center">Filtrar productos por : </h3>
                        <div class="col-sm-6">
                            <label class="col-form-label-sm">Código de referencia</label>
                            <input name="cod_referencia" type="text" class="form-control" placeholder="Ingrese el código de referencia por ejemplo: PROD-0001">
                        </div>
                        <div class="col-sm-6">
                            <label class="col-form-label-sm">Nombre</label>
                            <input name="nombre_producto" type="text" class="form-control" data-letra placeholder="Ingrese el nombre del producto">
                        </div>
                        <div class="col-sm-12 text-center" style="margin-top: 1.8rem;">
                            <button type="submit" class="btn btn-info">Buscar producto</button>
                        </div>
                    </form>
                    <!-- Contenido de la venta -->
                    <div class="ropa-top animated bounceIn">
                        <?php foreach ($lista_productos as $fila) { ?>
                            <div class="contenido-venta" data-CurrentStock="10">
                                <div class="venta-configurar">
                                    <img src="/<?php echo PROJECT_NAME . "/Resources/img/productos/". $fila["rutaImagen"] ?>"  draggable="false">
                                </div>
                                <div class="text-center">
                                    <u><?php echo $fila["cod_referencia"] ?></u>
                                </div>
                                <div class="venta-descripcion">
                                    <p><?php echo $fila["nombre_producto"] ?></p>           
                                    <p><?php echo $fila["descripcion"] ?></p>
                                </div>
                                <div class="venta-importe-precio">
                                    <div>
                                        <p>Monto&nbsp;:&nbsp;</p>
                                        <p>S/.<?php echo $fila["precio"] ?></p>
                                    </div>
                                    <div>
                                        <p>Costo&nbsp;:&nbsp;</p>
                                        <p>S/.<?php echo $fila["precio"] ?></p>
                                    </div>
                                </div>
                                <div class="venta-añadir-carrito" draggable="true">
                                    <div>
                                        <a href="#" data-minusProducto><i class="fa fa-minus-square"></i></a>
                                        <p>1</p>
                                        <a href="#" data-plusProducto><i class="fa fa-plus-square"></i></a>
                                    </div>
                                    <div>
                                        <a href="#" data-addProducto>Añadir <i class="fa fa-cart-plus"></i></a> 
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-12">
        <p class="back-link">&COPY; Todos los derechos reservados para <?php echo PROJECT_NAME . " " . getdate()["year"]; ?> | <b>JAAC</b></p>
    </div>
</div>
</div>
