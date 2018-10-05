/* global swal */
function beforesend(msg) {
    var script = '<script type="text/javascript">setInterval(function () {$("p[data-animacion]").removeClass().addClass("cargando rubberBand animated").one("webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend", function () {$(this).removeClass();});}, 700);<' + '/script>';
    $("#beforesend").html('<div class="espera-pop-up"><i class="fa fa-spinner fa-spin"></i><p class="rubberBand animated" data-animacion>👉 ' + msg + ' 👈</p></div><div class="pop-up"></div>' + script);
}
beforesend("Cargando Dashboard");
$(function () {
    setTimeout(() => {
        $("#beforesend").html("");
    }, 500);

    var PROJECT_NAME = "DrugStore JAAC";
    // Cerrar sesión
    $(document).on("click", "#btn_cerrar_sesion", function () {
        beforesend("Cargando datos");
        var http = new XMLHttpRequest();
        http.open("POST", "CerrarSesion", true);
        http.send();
        http.onreadystatechange = () => {
            $("#beforesend").html("");
            if (http.status === 200 && http.readyState === 4) {
                var data = http.responseText;
                switch (data.trim()) {
                    case "Se ha cerrado todas las sesiones disponibles.":
                        swal(PROJECT_NAME + " dice:", data, "success").then(() => {
                            var hashtag = location.href.lastIndexOf("#");
                            var url = location.href.substring(0, hashtag);
                            location.href = url;
                        });
                        break;
                    default:
                        swal(PROJECT_NAME + " dice:", data, "warning");
                        break;
                }
            } else if (http.status === 0) {
                swal(PROJECT_NAME + " dice:", data, "error");
            }
        };
    });

    // PUNTO DE VENTA
    $(document).on("click", "a[data-ListPedido]", function (e) {
        e.preventDefault();
        beforesend("Cargando Orden de pedido");
        var cod_lista_pedido = $(this).parent().parent().parent().find("td:eq(0)").text().trim();
        alert("Sin implementar aún. Codigo de lista de pedido solicitado: " + cod_lista_pedido);
        var http = new XMLHttpRequest();
        http.open("POST", "OrdenPedidoView", true); //
        http.send();
        http.onreadystatechange = () => {
            $("#beforesend").html("");
            var data = http.responseText;
            if (http.status === 200 && http.readyState === 4) {
                $("#success").html(data);
                $("#ordenPedido_modal").modal();
            } else if (http.status === 0) {
                swal(PROJECT_NAME + " dice:", data, "error");
            }
        };
    });

    // tipo de pago
    $("#btn_tipo_pago").on("click", function (e) {
        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: "CarteleraTipoPedido",
            beforeSend: function () {
                beforesend("cargando datos")
            },
            success: function (data) {
                $("#beforesend").html("");
                $("#success").html(data);
                $("#carteleratipopago_modal").modal();
            }
        });
    });
});
