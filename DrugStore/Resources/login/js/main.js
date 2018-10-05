
/* global swal */

(function ($) {
    var project_name = "DrugStore JAAC";
    $('.input100').each(function () {
        $(this).on('blur', function () {
            if ($(this).val().trim() !== "") {
                $(this).addClass('has-val');
            } else {
                $(this).removeClass('has-val');
            }
        });
    });

    var input = $('.validate-input .input100');
    $('.validate-form').on('submit', function () {
        var check = true;

        for (var i = 0; i < input.length; i++) {
            if (validate(input[i]) === false) {
                showValidate(input[i]);
                check = false;
            }
        }
        if (check === true) {
            $.ajax({
                type: 'POST',
                data: $(this).serializeArray(),
                url: "IniciarSesion",
                beforeSend: function () {
                    var script = '<script type="text/javascript">setInterval(function () {$("p[data-animacion]").removeClass().addClass("cargando rubberBand animated").one("webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend", function () {$(this).removeClass();});}, 500);<' + '/script>';
                    $("#beforesend").html('<div class="espera-pop-up"><i class="fas fa-spinner fa-spin"></i><p class="rubberBand animated" data-animacion>👉 buscando productos 👈</p></div><div class="pop-up"></div>' + script);
                },
                success: function (data) {
                    $("#beforesend").html("");
                    if (data.trim().includes("Bienvenido")) {
                        swal(project_name + " dice:", data, "success").then(() => {
                            var hashtag = location.href.lastIndexOf("#");
                            var url = location.href.substring(0, hashtag);
                            location.href = url;
                        });
                    } else if (data.trim().includes("Parece que las credenciales ingresadas no son correctas")) {
                        swal(project_name + " dice:", data, "warning");
                    } else {
                        swal(project_name + " dice:", "Lo sentimos algo no ha salido bien. " + data, "error");
                    }
                }
            });
        }
        return false;
    });


    $('.validate-form .input100').each(function () {
        $(this).focus(function () {
            hideValidate(this);
        });
    });

    function validate(input) {
        if ($(input).val().trim() === '') {
            return false;
        }
    }

    function showValidate(input) {
        var thisAlert = $(input).parent();

        $(thisAlert).addClass('alert-validate');
    }

    function hideValidate(input) {
        var thisAlert = $(input).parent();

        $(thisAlert).removeClass('alert-validate');
    }


})(jQuery);