/* global swal */

$(function () {
    var PROJECT_NAME = "DrugStore JAAC";

    $("#frm_nuevoproveedor").on("submit", function (e) {
        e.preventDefault();
        $.ajax({
            type: 'POST',
            data: $(this).serializeArray(),
            url: "NuevoProveedor",
            beforeSend: function () {
                beforesend("cargando datos");
            },
            success: function (data) {
                $("#beforesend").html("");
                switch (data.trim()) {
                    case "Registro completo con exito.":
                        swal(PROJECT_NAME + " dice:", data, "success").then(() => {
                            $("#frm_nuevoproveedor")[0].reset();
                            $("#frm_nuevoproveedor").find("input:first-child").focus();
                            swal(PROJECT_NAME + " dice:", "Desea ver la cartelera de proveedores con el nuevo proveedor ?", "warning", {
                                buttons: ["Cancelar", true]
                            }).then((aceptar) => {
                                if (aceptar) {
                                    var slash = location.href.lastIndexOf("/");
                                    var url = location.href.substring(0, slash) + "/cartelera";
                                    location.href = url;
                                } else {
                                    $("#frm_nuevoempleado input[name='nombre']").focus();
                                }
                            });
                        });
                        break;
                    default:
                        // posible entradas
                        // error | alvertencias
                        swal(PROJECT_NAME + " dice:", data, "warning");
                        break;
                }
            }
        });
    });
    // vista para editar cliente
    $(document).on("click", "a[data-editar-proveedor]", function (e) {
        e.preventDefault();
        var cod_proveedor = $(this).parent().parent().parent().find("td:first-child").text().trim();
        $.ajax({
            type: 'POST',
            data: {cod_proveedor: cod_proveedor},
            url: "EditarProveedorView",
            beforeSend: function () {
                beforesend("cargando datos");
            },
            success: function (data) {
                $("#beforesend").html("");
                $("#success").html(data);
                $("#frm_editarproveedor_modal").modal();
            }
        });
    });
    // editar cliente
    $(document).on("submit", "#frm_editarproveedor", function (e) {
        e.preventDefault();
        $.ajax({
            type: 'POST',
            data: $(this).serializeArray(),
            url: "EditarProveedor",
            beforeSend: function () {
                beforesend("cargando datos");
            },
            success: function (data) {
                $("#beforesend").html("");
                switch (data.trim()) {
                    case "Registro editado con exito.":
                        swal(PROJECT_NAME + " dice:", data, "success").then(() => {
                            $("#frm_editarproveedor_modal").modal("hide");
                            CargarProveedores();
                        });
                        break;
                    default:
                        // posible entradas
                        // Parece que el cliente no existe sobre la cartelera actual.
                        // otros
                        swal(PROJECT_NAME + " dice:", data, "warning");
                        break;
                }
            }
        });
    });
// filtrar empleado
    $("#frm_filtrarproveedor").on("submit", function (e) {
        e.preventDefault();
        $.ajax({
            type: 'POST',
            data: $(this).serializeArray(),
            url: "FiltrarProveedores",
            beforeSend: function () {
                beforesend("cargando datos");
            },
            success: function (data) {
                $("#beforesend").html("");
                try {
                    converJsonToTable(data, "data-tabla-cartelera-proveedores");
                } catch (e) {
                    // posible entradas
                    // No hemos encontrado ningún registro con dato ingresado. Por favor intente con otro dato diferente al actual.
                    // otros
                    swal(PROJECT_NAME + " dice:", data, "warning");
                }
            }
        });
    });

    function CargarProveedores() {
        $.ajax({
            type: 'POST',
            data: $(this),
            url: "CargarProveedores",
            beforeSend: function () {
                beforesend("cargando datos");
            },
            success: function (data) {
                $("#beforesend").html("");
                converJsonToTable(data, "data-tabla-cartelera-proveedores");
            }
        });
    } 

    function converJsonToTable(data, data_tabla) {
        var json = JSON.parse(data);
        var html = "";
        $(".tabla[" + data_tabla + "] tbody tr:not(:first-child)").remove();
        for (var i = 0; i < json.length; i++) {
            html +=
                    '<tr>'
                    + '<td hidden>' + json[i].cod_proveedor + '</td>'
                    + '<td class="text-center">' + json[i].nombre + '</td>'
                    + '<td class="text-center">' + json[i].direccion + '</td>'
                    + '<td class="text-center">' + json[i].pagina_web + '</td>'
                    + '<td class="text-center">' + json[i].telefono + '</td>'
                    + '<td>'
                    + '<span>'
                    + '<a href="#" data-editar-proveedor data-tooltip="Editar"><i class="fa fa-edit"></i></a>'
                    + ' </span>'
                    + '</td>'
                    + '</tr>';
        }
        $(".tabla[" + data_tabla + "] tbody").append(html);
        Paginacion_tabla(data_tabla);
    }

});

