<?php
require_once './App/Views/_shared/Dashboard/PanelOptionActive.php';
$option["empleados"] = "active";
require_once './App/Views/_shared/Dashboard/PanelGeneral.php';
$lista_empleados = EmpleadoController::LISTAR_EMPLEADOS();
?>

<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <div class="row">
        <ol class="breadcrumb">
            <li>
                <a href="/<?php echo PROJECT_NAME; ?>/Dashboard">
                    <em class="fa fa-home"></em>
                </a>
            </li>
            <li class="active">Dashboard/Empleado/cartelera</li>
        </ol>
    </div>
    <br>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading text-center">
                    Cartelera de empleados
                    <span class="pull-right clickable panel-toggle panel-button-tab-left">
                        <em class="fa fa-toggle-up"></em>
                    </span>
                </div>
                <div class="panel-body">
                    <form id="frm_filtrarempleado" class="form-row" autocomplete="off" spellcheck="false" style="max-width: 600px;margin: 0 auto;">                        
                        <h3 class="h5 text-center">Filtrar empleados por : </h3>
                        <div class="col-sm-6">
                            <label class="col-form-label-sm">Nombre</label>
                            <input name="nombre" type="text" class="form-control" data-letra placeholder="Ingrese el nombre del cliente" autofocus>
                        </div>
                        <div class="col-sm-6">
                            <label class="col-form-label-sm">DNI</label>
                            <input name="dni" type="text" class="form-control" data-numero placeholder="Ingrese el DNI del cliente" autofocus>
                        </div>
                        <div class="col-sm-12 text-center" style="margin-top: 1.8rem;">
                            <button type="submit" class="btn btn-info">Buscar empleado</button>
                        </div>
                    </form>
                    <div class="tabla-contenedor">
                        <table class="tabla" data-tabla-cartelera-empleados style="max-width: 1078px;min-width: 900px">
                            <tr>
                                <th hidden>cod_empleado</th>
                                <th class="text-center">Nombre</th>
                                <th class="text-center">DNI</th>
                                <th class="text-center">Nivel&nbsp;de&nbsp;usuario</th>
                                <th class="text-center">Dirección</th>
                                <th class="text-center">Teléfono</th>
                                <th class="text-center">Fecha&nbsp;de&nbsp;entrada</th>
                                <th class="text-center">Sueldo</th>
                                <th class="text-center">Acciones</th>
                            </tr>
                            <?php foreach ($lista_empleados as $fila) { ?>
                                <tr>
                                    <td hidden><?php echo $fila["cod_empleado"]; ?></td>
                                    <td class="text-center"><?php echo $fila["nombre"]; ?></td>
                                    <td class="text-center"><?php echo $fila["dni"]; ?></td>
                                    <td class="text-center"><?php echo $fila["nivel_usuario"]; ?></td>
                                    <td class="text-center"><?php echo $fila["direccion"]; ?></td>
                                    <td class="text-center"><?php echo $fila["telefono"]; ?></td>
                                    <td class="text-center">
                                        <?php
                                        setlocale(LC_ALL, "es_ES");
                                        $fecha = $fila["fecha_entrada"];
                                        $fecha_parseada = strftime("%A %d de %B del %Y", date(strtotime($fecha)));
                                        echo $fecha_parseada;
                                        ?>
                                    </td>
                                    <td class="text-center"><?php echo $fila["sueldo_base"]; ?></td>
                                    <td>
                                        <span>
                                            <a href="#" data-editar-empleado data-tooltip="Editar"><i class="fa fa-edit"></i></a>
                                        </span>
                                    </td>
                                </tr>
                            <?php } ?>
                            <tfoot><tr><td colspan="9"><ul></ul></td></tr></tfoot>
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
        Paginacion_tabla("data-tabla-cartelera-empleados");
    };
</script>