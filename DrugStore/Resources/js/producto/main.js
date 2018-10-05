/* global parseFloat, swal */

$(function () {
    const PROJECT_NAME = "DrugStore JAAC";
    $(document).on("click", "a[data-minusProducto]", function (e) {
        e.preventDefault();
        var cantidad = $(this).parent().children("p").text().trim();
        var precio = parseFloat($(this).parent().parent().parent().find("div:eq(3)").children("div:nth-child(2)").children("p:nth-child(2)").html().replace("S/.", "")).toFixed(2);
        if (cantidad > 1) {
            cantidad--;
            $(this).parent().children("p").text(cantidad);
            precio = (parseFloat(precio * cantidad).toFixed(2)).replace(".", ",");
            $(this).parent().parent().parent().find("div:eq(3)").children("div:nth-child(1)").children("p:nth-child(2)").html("S/." + precio);
        } else {
            swal(PROJECT_NAME + " dice:", "La unidad minima es 1", "warning");
        }
    });

    $(document).on("click", "a[data-plusProducto]", function (e) {
        e.preventDefault();
        var stock_actual = $(this).parent().parent().parent().attr("data-CurrentStock");
        var cantidad = $(this).parent().children("p").text().trim();
        var precio = parseFloat($(this).parent().parent().parent().find("div:eq(3)").children("div:nth-child(2)").children("p:nth-child(2)").html().replace("S/.", "")).toFixed(2);
        cantidad++;
        if (cantidad > stock_actual) {
            swal(PROJECT_NAME + " dice:", "Parece que ha llegado al stock maximo del producto.", "warning");
        } else {
            $(this).parent().children("p").text(cantidad);
            precio = (parseFloat(precio * cantidad).toFixed(2)).replace(".", ",");
            $(this).parent().parent().parent().find("div:eq(3)").children("div:nth-child(1)").children("p:nth-child(2)").html("S/." + precio);
        }
    });

    $(document).on("click", "a[data-addProducto]", function (e) {
        e.preventDefault();
        var cod_referencia = $(this).parent().parent().parent().find("div:eq(1)").text().trim();
        var cantidad = $(this).parent().parent().find("div:eq(0)").children("p").text().trim();
        alert("Sin implementar aún. Código de referencia del producto: " + cod_referencia + ". Cantidad solicitda: " + cantidad);
    });


    // -- CRUD 


    $("#frm_nuevoproducto").on("submit", function (e) {
        e.preventDefault();
        $.ajax({
            type: 'POST',
            contentType: false,
            processData: false,
            data: new FormData(this),
            url: "NuevoProducto",
            beforeSend: function () {
                beforesend("cargando datos");
            },
            success: function (data) {
                $("#beforesend").html("");
                switch (data.trim()) {
                    case "Registro completo con exito.":
                        swal(PROJECT_NAME + " dice:", data, "success").then(() => {
                            $("#frm_nuevoproducto")[0].reset();
                            $("#frm_nuevoproducto").find("input:first-child").focus();
                            swal(PROJECT_NAME + " dice:", "Desea ver la cartelera de productos con el nuevo producto ?", "warning", {
                                buttons: ["Cancelar", true]
                            }).then((aceptar) => {
                                if (aceptar) {
                                    var slash = location.href.lastIndexOf("/");
                                    var url = location.href.substring(0, slash) + "/cartelera";
                                    location.href = url;
                                } else {
                                    $("#frm_nuevoproducto input[name='cod_referencia']").focus();
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
    $(document).on("click", "a[data-editar-producto]", function (e) {
        e.preventDefault();
        var cod_producto = $(this).parent().parent().parent().find("td:first-child").text().trim();
        $.ajax({
            type: 'POST',
            data: {cod_producto: cod_producto},
            url: "EditarProductoView",
            beforeSend: function () {
                beforesend("cargando datos");
            },
            success: function (data) {
                $("#beforesend").html("");
                $("#success").html(data);
                $("#frm_editarproducto_modal").modal();
            }
        });
    });
    // editar cliente
    $(document).on("submit", "#frm_editarproducto", function (e) {
        e.preventDefault();
        $.ajax({
            type: 'POST',
            contentType: false,
            processData: false,
            data: new FormData(this),
            url: "EditarProducto",
            beforeSend: function () {
                beforesend("cargando datos");
            },
            success: function (data) {
                $("#beforesend").html("");
                switch (data.trim()) {
                    case "Registro editado con exito.":
                        swal(PROJECT_NAME + " dice:", data, "success").then(() => {
                            $("#frm_editarproducto_modal").modal("hide");
                            CargarProductos();
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
    $("#frm_filtrarproducto").on("submit", function (e) {
        e.preventDefault();
        $.ajax({
            type: 'POST',
            data: $(this).serializeArray(),
            url: "FiltrarProductos",
            beforeSend: function () {
                beforesend("cargando datos");
            },
            success: function (data) {
                $("#beforesend").html("");
                try {
                    converJsonToTable(data, "data-tabla-cartelera-productos");
                } catch (e) {
                    // posible entradas
                    // No hemos encontrado ningún registro con dato ingresado. Por favor intente con otro dato diferente al actual.
                    // otros
                    swal(PROJECT_NAME + " dice:", data, "warning");
                }
            }
        });
    });

    function CargarProductos() {
        $.ajax({
            type: 'POST',
            data: $(this),
            url: "CargarProductos",
            beforeSend: function () {
                beforesend("cargando datos");
            },
            success: function (data) {
                $("#beforesend").html("");
                converJsonToTable(data, "data-tabla-cartelera-productos");
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
                    + '<td hidden>' + json[i].cod_producto + '</td>'
                    + '<td class="text-center">'
                    + '<img src="/DrugStore/Resources/img/productos/' + json[i].rutaImagen + '" class="img-thumbnail" width="100" draggable="false">'
                    + '</td>'
                    + '<td class="text-center">' + json[i].cod_referencia + '</td>'
                    + '<td class="text-center">' + json[i].nombre_producto + '</td>'
                    + '<td class="text-center">' + json[i].descripcion + '</td>'
                    + '<td class="text-center">' + json[i].stock + '</td>'
                    + '<td class="text-center">' + json[i].estado + '</td>'
                    + '<td>'
                    + '<span>'
                    + '<a href="#" data-editar-producto data-tooltip="Editar"><i class="fa fa-edit"></i></a>'
                    + ' </span>'
                    + '</td>'
                    + '</tr>';
        }
        $(".tabla[" + data_tabla + "] tbody").append(html);
        Paginacion_tabla(data_tabla);
    }


    $(document).on("change", "input[name='rutaImagen']", function (event) {
        var current = $(this);
        try {
            current.parent().children("img").attr({"src": '/DrugStore/Resources/img/no-img.png'});
            var file, reader;
            for (var i = 0; i < event.target.files.length; i++) {
                if (i <= 3) {
                    if (event.target.files[i].type === "image/jpeg" || event.target.files[i].type === "image/png" || event.target.files[i].type === "image/gif" || event.target.files[i].type === "image/jpg") {
                        file = event.target.files[i];
                        reader = new FileReader();
                        reader.onload = function (event) {
                            current.parent().children("img").attr({"src": event.target.result});
                        };
                    } else {
                        var control = current;
                        control.replaceWith(control = control.val("").clone(true));
                        swal(PROJECT_NAME + " dice:", "Parece que ha intentado colocar un archivo que no es imagen. Por favor solo suba archivos con las siguientes extensiones validas : .png | .jpg | .jpeg | .gif", "warning");
                        return false;
                    }
                } else {
                    var control = current;
                    control.replaceWith(control = control.val("").clone(true));
                    current.parent().children("img").attr({"src": event.target.result});
                    swal(PROJECT_NAME + " dice:", "Por favor solo 4 imagenes por producto.", "warning");
                    return false;
                }
                reader.readAsDataURL(file);
            }
        } catch (e) {
            current.parent().children("img").attr({"src": '/DrugStore/Resources/img/no-img.png'});
        }
    });

});