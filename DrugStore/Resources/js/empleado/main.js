/* global swal */

$(function () {
    var PROJECT_NAME = "DrugStore JAAC";

    $("#frm_nuevoempleado").on("submit", function (e) {
        e.preventDefault();
        $.ajax({
            type: 'POST',
            data: $(this).serializeArray(),
            url: "NuevoEmpleado",
            beforeSend: function () {
                beforesend("cargando datos");
            },
            success: function (data) {
                $("#beforesend").html("");
                switch (data.trim()) {
                    case "Registro completo con exito.":
                        swal(PROJECT_NAME + " dice:", data, "success").then(() => {
                            $("#frm_nuevoempleado")[0].reset();
                            $("#frm_nuevoempleado").find("input:first-child").focus();
                            swal(PROJECT_NAME + " dice:", "Desea ver la cartelera de cliente con el nuevo cliente ?", "warning", {
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
                    case "La clave debe ser mayor o igual que 5 caracteres.":
                        swal(PROJECT_NAME + " dice:", data, "warning").then(() => {
                            $("#frm_nuevoempleado input[name='clave']").focus();
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
    // vista para editar empleado
    $(document).on("click", "a[data-editar-empleado]", function (e) {
        e.preventDefault();
        var cod_empleado = $(this).parent().parent().parent().find("td:first-child").text().trim();
        $.ajax({
            type: 'POST',
            data: {cod_empleado: cod_empleado},
            url: "EditarEmpleadoView",
            beforeSend: function () {
                beforesend("cargando datos");
            },
            success: function (data) {
                $("#beforesend").html("");
                $("#success").html(data);
                $("#frm_editarempleado_modal").modal();
            }
        });
    });
    // editar cliente
    $(document).on("submit", "#frm_editarempleado", function (e) {
        e.preventDefault();
        $.ajax({
            type: 'POST',
            data: $(this).serializeArray(),
            url: "EditarEmpleado",
            beforeSend: function () {
                beforesend("cargando datos");
            },
            success: function (data) {
                $("#beforesend").html("");
                switch (data.trim()) {
                    case "Registro editado con exito.":
                        swal(PROJECT_NAME + " dice:", data, "success").then(() => {
                            $("#frm_editarempleado_modal").modal("hide");
                            CargarEmpleados();
                        });
                        break;
                    default:
                        // posible entradas
                        // Parece que el empleado no existe sobre la cartelera actual.
                        // otros
                        swal(PROJECT_NAME + " dice:", data, "warning");
                        break;
                }
            }
        });
    });
// filtrar empleado
    $("#frm_filtrarempleado").on("submit", function (e) {
        e.preventDefault();
        $.ajax({
            type: 'POST',
            data: $(this).serializeArray(),
            url: "FiltrarEmpleados",
            beforeSend: function () {
                beforesend("cargando datos");
            },
            success: function (data) {
                $("#beforesend").html("");
                try {
                    converJsonToTable(data, "data-tabla-cartelera-empleados");
                } catch (e) {
                    // posible entradas
                    // No hemos encontrado ningún registro con dato ingresado. Por favor intente con otro dato diferente al actual.
                    // otros
                    swal(PROJECT_NAME + " dice:", data, "warning");
                }
            }
        });
    });

    function CargarEmpleados() {
        $.ajax({
            type: 'POST',
            data: $(this),
            url: "CargarEmpleados",
            beforeSend: function () {
                beforesend("cargando datos");
            },
            success: function (data) {
                $("#beforesend").html("");
                converJsonToTable(data, "data-tabla-cartelera-empleados");
            }
        });
    }

    function converJsonToTable(data, data_tabla) {
        var json = JSON.parse(data);
        var html = "";
        $(".tabla[" + data_tabla + "] tbody tr:not(:first-child)").remove();
        for (var i = 0; i < json.length; i++) {
            var fecha = new moment(new Date(json[i].fecha_entrada)).format("dddd DD \\d\\e MMMM \\d\\e\\l\\\ YYYY");
            html +=
                    '<tr>'
                    + '<td hidden>' + json[i].cod_empleado + '</td>'
                    + '<td class="text-center">' + json[i].nombre + '</td>'
                    + '<td class="text-center">' + json[i].dni + '</td>'
                    + '<td class="text-center">' + json[i].nivel_usuario + '</td>'
                    + '<td class="text-center">' + json[i].direccion + '</td>'
                    + '<td class="text-center">' + json[i].telefono + '</td>'
                    + '<td class="text-center">' + fecha + '</td>'
                    + '<td class="text-center">' + json[i].sueldo_base + '</td>'
                    + '<td>'
                    + '<span>'
                    + '<a href="#" data-editar-empleado data-tooltip="Editar"><i class="fa fa-edit"></i></a>'
                    + ' </span>'
                    + '</td>'
                    + '</tr>';
        }
        $(".tabla[" + data_tabla + "] tbody").append(html);
        Paginacion_tabla(data_tabla);
    }

    // SOLO EMPLEADOS
    // vista para mi informacion personal
    $("#btn_miinformacion").on("click", function (e) {
        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: "MiInformacionView",
            beforeSend: function () {
                beforesend("cargando datos");
            },
            success: function (data) {
                $("#beforesend").html("");
                $("#success").html(data);
                $("#frm_miinformacion_modal").modal();
            }
        });
    });
    // guardar cambios en mi informacion
    $(document).on("submit", "#frm_miinformacion", function (e) {
        e.preventDefault();
        $.ajax({
            type: 'POST',
            data: $(this).serializeArray(),
            url: "EditarEmpleado",
            beforeSend: function () {
                beforesend("cargando datos");
            },
            success: function (data) {
                $("#beforesend").html("");
                switch (data.trim()) {
                    case "Registro editado con exito.":
                        swal(PROJECT_NAME + " dice:", data, "success").then(() => {
                            $("#frm_miinformacion_modal").modal("hide");
                            // aqui no es necesario, pero si se encuentra dentro de la cartelera, tambien
                            // lo actualizamos.
                            CargarEmpleados();
                        });
                        break;
                    default:
                        // posible entradas
                        // Parece que el empleado no existe sobre la cartelera actual.
                        // otros
                        swal(PROJECT_NAME + " dice:", data, "warning");
                        break;
                }
            }
        });
    });

// vista para cambiar mi clave
    $("#btn_cambiarclave").on("click", function (e) {
        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: "CambiarMiClaveView",
            beforeSend: function () {
                beforesend("cargando datos");
            },
            success: function (data) {
                $("#beforesend").html("");
                $("#success").html(data);
                $("#frm_cambiarclave_modal").modal();
            }
        });
    });

// cambiar mi clave
    $(document).on("submit", "#frm_cambiarclave", function (e) {
        e.preventDefault();
        var bandera = true;
        if ($("#frm_cambiarclave input[name='nueva_clave']").val() !== $("#frm_cambiarclave input[name='confirmar_clave']").val()) {
            swal(PROJECT_NAME + " dice:", "Parece que la constraseñas no coinciden, Por favor revise los campos.", "warning").then(() => {
                $("#frm_cambiarclave input[name='confirmar_clave']").focus();
            });
            return false;
        }
        $(this).find("input").each(function () {
            if ($(this).val().trim() === "") {
                swal(PROJECT_NAME + " dice:", "No puede dejar espacios vacios, por favor completo todo los espacios en blancos.", "warning");
                bandera = false;
                return false;
            }
        });
        if (bandera === true) {
            $.ajax({
                type: 'POST',
                data: $(this).serializeArray(),
                url: "CambiarMiClave",
                beforeSend: function () {
                    beforesend("cargando datos");
                },
                success: function (data) {
                    $("#beforesend").html("");
                    switch (data.trim()) {
                        case "No hemos actualizado tu clave, por que la nueva clave, es igual a la actual.":
                        case "Tu clave ha sido cambiada con exito.":
                            swal(PROJECT_NAME + " dice:", data, "success").then(() => {
                                $("#frm_cambiarclave_modal").modal("hide");
                                // aqui no es necesario, pero si se encuentra dentro de la cartelera, tambien
                                // lo actualizamos.
                                CargarEmpleados();
                            });
                            break;
                        case "Su nueva clave debe ser mayor o igual que 5 caracteres.":
                            swal(PROJECT_NAME + " dice:", data, "warning").then(() => {
                               $("#frm_cambiarclave input[name='nueva_clave']").focus();
                            });
                            break;
                        default:
                            // posible entradas
                            // La clave actual no es correcta. Asegurate que esté bien escrito.
                            // Parece que el empleado no existe.
                            // otros
                            swal(PROJECT_NAME + " dice:", data, "warning");
                            break;
                    }
                }
            });
        }
    });

});

