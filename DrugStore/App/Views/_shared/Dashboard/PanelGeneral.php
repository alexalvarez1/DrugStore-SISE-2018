<?php
session_start();
if (count($_SESSION) <= 0) {
    header("location: /" . PROJECT_NAME . "/IniciarSesion");
}
// Recordar que necesitamos de nuestra variable $option:Array para indicar en que nivel estamos
// sobre nuestras opciones del Dashboard
?>
<nav class="navbar navbar-custom navbar-fixed-top" style="box-shadow: #002752 0 0 10px;">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#sidebar-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/<?php echo PROJECT_NAME; ?>/Dashboard/principal">
                <span><?php echo PROJECT_NAME ?></span> Panel
            </a>
            <ul class="nav navbar-top-links navbar-right">
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <em class="fa fa-info-circle"></em>
                    </a>
                    <ul class="dropdown-menu dropdown-messages">
                        <li>
                            <div >
                                <a href="profile.html" class="pull-left">
                                    <img class="img-circle" src="/<?php echo PROJECT_NAME ?>/Resources/img/general/arrow-point-to-right.png" width="20">
                                </a>
                                <div class="message-body">
                                    <small class="pull-right">JAAC</small>
                                    <a href="#">
                                        <strong><i class="fa fa-pencil"></i></strong>
                                        Mi información
                                    </a>
                                </div>
                            </div>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <div >
                                <a href="profile.html" class="pull-left">
                                    <img class="img-circle" src="/<?php echo PROJECT_NAME ?>/Resources/img/general/arrow-point-to-right.png" width="20">
                                </a>
                                <div class="message-body">
                                    <small class="pull-right">JAAC</small>
                                    <a href="#">
                                        <strong><i class="fa fa-key"></i></strong>
                                        Cambiar mi clave de acceso
                                    </a>
                                </div>
                            </div>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <div class="all-button">
                                <a href="#CerrarSesion_Modal" data-toggle="modal">
                                    <em class="fa fa-power-off"></em>
                                    <strong>Cerrar Sesión</strong>
                                </a>
                            </div>
                        </li>
                    </ul>
                </li>

            </ul>
        </div>
    </div>
</nav>

<div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
    <div class="profile-sidebar">
        <div class="profile-usertitle-name text-center">
            <span class="indicator label-success"></span>
            <?php echo $_SESSION["nombre"] ?>
        </div>
    </div>
    <ul class="nav menu">
        <li class="<?php echo $option["principal"] ?>">
            <a href="/<?php echo PROJECT_NAME; ?>/Dashboard/principal">
                <em class="fa fa-dashboard">&nbsp;</em> Principal
            </a>
        </li>
        <!--#client => Clientes-->
        <?php if ($_SESSION["nivel_usuario"] == "admin") { ?>
            <li class="parent">
                <a data-toggle="collapse" href="#client" class="<?php echo $option["clientes"] ?>"> 
                    <i class="fa fa-user">&nbsp;</i> Clientes <span class="icon pull-right"><em class="fa fa-plus"></em></span>
                </a>

                <ul class="children collapse" id="client">
                    <li>
                        <a href="/<?php echo PROJECT_NAME; ?>/Dashboard/Cliente/nuevo" title="Nuevo cliente">
                            <span class="fa fa-arrow-right">&nbsp;</span> Nuevo cliente
                        </a>
                    </li>
                    <li>
                        <a href="/<?php echo PROJECT_NAME; ?>/Dashboard/Cliente/cartelera" title="Cartelera de clientes">
                            <span class="fa fa-arrow-right">&nbsp;</span> Cartelera de clientes
                        </a>
                    </li>
                </ul>
            </li>
            <!-- employee => empleado -->
            <li class="parent">
                <a data-toggle="collapse" href="#employee" class="<?php echo $option["empleados"] ?>"> 
                    <i class="fa fa-users">&nbsp;</i> Empleados <span class="icon pull-right"><em class="fa fa-plus"></em></span>
                </a>
                <ul class="children collapse" id="employee">
                    <li>
                        <a href="/<?php echo PROJECT_NAME; ?>/Dashboard/Empleado/nuevo" title="Nuevo empleado">
                            <span class="fa fa-arrow-right">&nbsp;</span> Nuevo empleado
                        </a>
                    </li>
                    <li>
                        <a href="/<?php echo PROJECT_NAME; ?>/Dashboard/Empleado/cartelera" title="Cartelera de empleados">
                            <span class="fa fa-arrow-right">&nbsp;</span> Cartelera de empleados
                        </a>
                    </li>
                </ul>
            </li>
            <!-- provider => proveedor-->
            <li class="parent">
                <a data-toggle="collapse" href="#provider" class="<?php echo $option["proveedores"] ?>">
                    <i class="fa fa-address-book-o">&nbsp;</i> Proveedores <span class="icon pull-right"><em class="fa fa-plus"></em></span>
                </a>
                <ul class="children collapse" id="provider">
                    <li>
                        <a href="/<?php echo PROJECT_NAME; ?>/Dashboard/Proveedor/nuevo" title="Nuevo proveedor">
                            <span class="fa fa-arrow-right">&nbsp;</span> Nuevo proveedor
                        </a>
                    </li>
                    <li>
                        <a href="/<?php echo PROJECT_NAME; ?>/Dashboard/Proveedor/cartelera" title="Cartelera de proveedores">
                            <span class="fa fa-arrow-right">&nbsp;</span> Cartelera de proveedores
                        </a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="#" class="<?php echo $option["tipopago"] ?>" id="btn_tipo_pago">
                    <em class="fa fa-clone">&nbsp;</em> Tipo de Pago
                </a>
            </li>
            <!-- product => producto -->
            <li class="parent">
                <a data-toggle="collapse" href="#product" class="<?php echo $option["productos"] ?>">
                    <em class="fa fa-product-hunt">&nbsp;</em> Productos <span class="icon pull-right"><em class="fa fa-plus"></em></span>
                </a>
                <ul class="children collapse" id="product">
                    <li>
                        <a href="/<?php echo PROJECT_NAME; ?>/Dashboard/Producto/nuevo" title="Nuevo producto">
                            <span class="fa fa-arrow-right">&nbsp;</span> Nuevo producto
                        </a>
                    </li>
                    <li>
                        <a href="/<?php echo PROJECT_NAME; ?>/Dashboard/Producto/cartelera" title="Cartelera de productos">
                            <span class="fa fa-arrow-right">&nbsp;</span> Cartelera de productos
                        </a>
                    </li>
                </ul>
            </li>
        <?php } ?>
        <!-- pdv => Punto de venta -->
        <li class="parent">
            <a data-toggle="collapse" href="#pdv" class="<?php echo $option["puntoventa"] ?>"> 
                <em class="fa fa-shopping-cart">&nbsp;</em> Punto de venta <span class="icon pull-right"><em class="fa fa-plus"></em></span>
            </a>
            <ul class="children collapse" id="pdv">
                <li>
                    <a href="/<?php echo PROJECT_NAME; ?>/Dashboard/PuntoVenta/nuevo" title="Nueva venta">
                        <span class="fa fa-arrow-right">&nbsp;</span> Nueva venta
                    </a>
                </li>
                <li>
                    <a href="/<?php echo PROJECT_NAME; ?>/Dashboard/PuntoVenta/cartelera" title="Cartelera de ventas">
                        <span class="fa fa-arrow-right">&nbsp;</span> Cartelera de ventas
                    </a>
                </li>
            </ul>
        </li>
        <li>
            <a href="#CerrarSesion_Modal" data-toggle="modal">
                <em class="fa fa-power-off">&nbsp;</em> Cerrar sesión
            </a>
        </li>
    </ul>
</div>

<!--  FORMULARIO MODAL CERRAR SESION  -->
<div class="modal fade" id="CerrarSesion_Modal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" style="float: left;">Listo para salir ?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Selecciona "Salir" si estas seguro de términar tu sesión actual</div>
            <div class="modal-footer">
                <button class="btn btn-secondary btn-sm" type="button" data-dismiss="modal">Cancel</button>
                <a class="btn btn-danger btn-sm" id="btn_cerrar_sesion" href="#">Salir</a>
            </div>
        </div>
    </div>
</div>

<div id="beforesend"></div>
<div id="success"></div>

<!-- El contenido que venga más abajo lo módularisamos y personalizamos a la necesidad de nuestro negocio -->
