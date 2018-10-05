// FUNCION PARA CUALQUIER TABLA
function Paginacion_tabla(atributo_data) {
// SI DESEAS VER MAS FILAS SOLO CAMBIALE AL VALOR A LA VARIABLE mostrarFilas, 
// ACTUALMENTE EN CINCO. SI CAMBIAS AQUI TAMBIEN CAMBIALO CUANDO HACE FILTRADO EL ADMINISTRADOR EL SCRIPT ESTA ABAJO.
    let totalPestañaspaginacion = parseInt(0);
    const mostrarFilas = parseInt(7);
    var filas = parseInt($('.tabla[' + atributo_data + '] tbody').find('tr').not(':first-child').length);
    var divisiones = Math.ceil(filas / mostrarFilas);
    $('.tabla[' + atributo_data + '] tbody').find('tr:not(:first-child)').each(function (index) {
        if (index > mostrarFilas - 1)
            $(this).hide();
    });
    $('.tabla[' + atributo_data + '] tfoot tr td').find('ul').html("");
    if (divisiones !== 1)
        $('.tabla[' + atributo_data + '] tfoot tr td').find('ul').html('<li><span data-paginacion-anterior' + atributo_data + ' data-paginacion="true"><i class="fa fa-caret-square-o-left"></i></span></li>');
    for (var x = 1; x <= divisiones; x++) {
        totalPestañaspaginacion = x;
        if (x === 1)
            $('.tabla[' + atributo_data + '] tfoot tr td').find('ul').append('<li><span class="indice-paginacion">' + x + '</span></li>');
        else
            $('.tabla[' + atributo_data + '] tfoot tr td').find('ul').append('<li><span>' + x + '</span></li>');
    }
    if (divisiones !== 1)
        $('.tabla[' + atributo_data + '] tfoot tr td').find('ul').append('<li><span data-paginacion-siguiente' + atributo_data + ' data-paginacion="true"><i class="fa fa-caret-square-o-right"></i></span></li>');
    $('.tabla[' + atributo_data + '] tfoot tr td ul li').find('span').click(function () {
        if ($(this).hasClass('indice-paginacion') || $(this).attr('data-paginacion')) {
            return false;
        } else {
            $('.tabla[' + atributo_data + '] tfoot tr td ul li').find('span').removeClass('indice-paginacion');
            $(this).addClass('indice-paginacion');
            var numPaginaactual = parseInt($(this).text());
            var desdeDonde = (mostrarFilas * numPaginaactual) - mostrarFilas;
            var haciaDonde = (mostrarFilas * numPaginaactual);
            $('.tabla[' + atributo_data + '] tbody').find('tr:not(:first-child)').each(function (index) {
                if (index <= (desdeDonde - 1) || index > (haciaDonde - 1))
                    $(this).hide();
                else
                    $(this).show();
            });
        }
    });
    setTimeout(function () {
        $('.tabla[' + atributo_data + '] tfoot tr td ul').find('li').not(':first-child').not(':last-child').each(function (index) {
            if (index <= (mostrarPestañascada - 1))
                $(this).show();
            else
                $(this).hide();
        });
    }, 10);
    const mostrarPestañascada = parseInt(5);
    var actualBloque = parseInt(1);
    $('span[data-paginacion-anterior' + atributo_data + ']').click(function () {
        var divisionesPestañas = Math.ceil(totalPestañaspaginacion / mostrarPestañascada);
        if (actualBloque <= divisionesPestañas && actualBloque >= 1) {
            var haciaDonde = ((actualBloque * mostrarPestañascada) - mostrarPestañascada);
            var desdeDonde = (actualBloque * mostrarPestañascada);
            if (totalPestañaspaginacion > mostrarPestañascada) {
                $(this).parent().parent().find('li').not(':first-child').not(':last-child').each(function (index) {
                    if (index <= (haciaDonde - 1) || index > (desdeDonde - 1))
                        $(this).hide();
                    else
                        $(this).show();

                    if (index === desdeDonde - mostrarPestañascada)
                        $(this).children('span').addClass('indice-paginacion');
                    else
                        $(this).children('span').removeClass('indice-paginacion');
                });
                var numPaginaactual = parseInt((desdeDonde - mostrarPestañascada) + 1);
                var desdeDonde_tabla = (mostrarFilas * numPaginaactual) - mostrarFilas;
                var haciaDonde_tabla = (mostrarFilas * numPaginaactual);
                $('.tabla[' + atributo_data + '] tbody').find('tr:not(:first-child)').each(function (index) {
                    if (index <= (desdeDonde_tabla - 1) || index > (haciaDonde_tabla - 1))
                        $(this).hide();
                    else
                        $(this).show();
                });
            }
            actualBloque--;
        } else {
            actualBloque = divisionesPestañas;
        }
    });
    $('span[data-paginacion-siguiente' + atributo_data + ']').click(function () {
        var divisionesPestañas = Math.ceil(totalPestañaspaginacion / mostrarPestañascada);
        if (actualBloque < divisionesPestañas) {
            var desdeDonde = (actualBloque * mostrarPestañascada);
            var haciaDonde = ((actualBloque * mostrarPestañascada) + mostrarPestañascada);

            if (totalPestañaspaginacion > mostrarPestañascada) {
                $(this).parent().parent().find('li').not(':first-child').not(':last-child').each(function (index) {
                    if (index <= (desdeDonde - 1) || index > (haciaDonde - 1))
                        $(this).hide();
                    else
                        $(this).show();

                    if (index === desdeDonde)
                        $(this).children('span').addClass('indice-paginacion');
                    else
                        $(this).children('span').removeClass('indice-paginacion');
                });
                var numPaginaactual = parseInt(desdeDonde + 1);
                var desdeDonde_tabla = (mostrarFilas * numPaginaactual) - mostrarFilas;
                var haciaDonde_tabla = (mostrarFilas * numPaginaactual);
                $('.tabla[' + atributo_data + '] tbody').find('tr:not(:first-child)').each(function (index) {
                    if (index <= (desdeDonde_tabla - 1) || index > (haciaDonde_tabla - 1))
                        $(this).hide();
                    else
                        $(this).show();
                });
            }
            actualBloque++;
        } else {
            actualBloque = 0;
        }
    });
}