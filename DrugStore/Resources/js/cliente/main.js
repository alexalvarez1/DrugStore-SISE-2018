/* global swal */

$(function () {
    var PROJECT_NAME = "DrugStore JAAC";
    $("#frm_nuevocliente").on("submit", function (e) {
        e.preventDefault();
        $.ajax({
            type: 'POST',
            data: $(this).serializeArray(),
            url: "NuevoCliente",
            beforeSend: function () {
                beforesend("cargando datos");
            },
            success: function (data) {
                $("#beforesend").html("");
                switch (data.trim()) {
                    case "Registro completo con exito.":
                        swal(PROJECT_NAME + " dice:", data, "success").then(() => {
                            $("#frm_nuevocliente")[0].reset();
                            $("#frm_nuevocliente").find("input:first-child").focus();
                            swal(PROJECT_NAME + " dice:", "Desea ver la cartelera de cliente con el nuevo cliente ?", "warning", {
                                buttons: ["Cancelar", true]
                            }).then((aceptar) => {
                                if (aceptar) {
                                    var slash = location.href.lastIndexOf("/");
                                    var url = location.href.substring(0, slash) + "/cartelera";
                                    location.href = url;
                                } else {
                                    $("#frm_nuevocliente input[name='nombre']").focus();
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
    $(document).on("click", "a[data-editar-cliente]", function (e) {
        e.preventDefault();
        var cod_cliente = $(this).parent().parent().parent().find("td:first-child").text().trim();
        $.ajax({
            type: 'POST',
            data: {cod_cliente: cod_cliente},
            url: "EditarClienteView",
            beforeSend: function () {
                beforesend("cargando datos");
            },
            success: function (data) {
                $("#beforesend").html("");
                $("#success").html(data);
                $("#frm_editarcliente_modal").modal();
            }
        });
    });
    // editar cliente
    $(document).on("submit", "#frm_editarcliente", function (e) {
        e.preventDefault();
        $.ajax({
            type: 'POST',
            data: $(this).serializeArray(),
            url: "EditarCliente",
            beforeSend: function () {
                beforesend("cargando datos");
            },
            success: function (data) {
                $("#beforesend").html("");
                switch (data.trim()) {
                    case "Registro editado con exito.":
                        swal(PROJECT_NAME + " dice:", data, "success").then(() => {
                            $("#frm_editarcliente_modal").modal("hide");
                            CargarClientes();
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
// filtrar cliente
    $("#frm_filtrarcliente").on("submit", function (e) {
        e.preventDefault();
        $.ajax({
            type: 'POST',
            data: $(this).serializeArray(),
            url: "FiltrarClientes",
            beforeSend: function () {
                beforesend("cargando datos");
            },
            success: function (data) {
                $("#beforesend").html("");
                try {
                    converJsonToTable(data, "data-tabla-cartelera-clientes");
                } catch (e) {
                    // posible entradas
                    // No hemos encontrado ningún registro con dato ingresado. Por favor intente con otro dato diferente al actual.
                    // otros
                    swal(PROJECT_NAME + " dice:", data, "warning");
                }
            }
        });
    });

    function CargarClientes() {
        $.ajax({
            type: 'POST',
            data: $(this),
            url: "CargarClientes",
            beforeSend: function () {
                beforesend("cargando datos");
            },
            success: function (data) {
                $("#beforesend").html("");
                converJsonToTable(data, "data-tabla-cartelera-clientes");
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
                    + '<td hidden>' + json[i].cod_cliente + '</td>'
                    + '<td class="text-center">' + json[i].nombre + '</td>'
                    + '<td class="text-center">' + json[i].direccion + '</td>'
                    + '<td class="text-center">' + json[i].telefono + '</td>'
                    + '<td>'
                    + '<span>'
                    + '<a href="#" data-editar-cliente data-tooltip="Editar"><i class="fa fa-edit"></i></a>'
                    + ' </span>'
                    + '</td>'
                    + '</tr>';
        }
        $(".tabla[" + data_tabla + "] tbody").append(html);
        Paginacion_tabla(data_tabla);
    }

});

