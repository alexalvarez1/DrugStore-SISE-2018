// Validacion de campos
$(document).on("keydown", "input[data-numero]", function (event) {
    if (!((event.which >= 48 && event.which <= 57) || /*NUMERO 0 - 9*/
            (event.which >= 96 && event.which <= 105) || /*NUMERO PAD*/
            (event.which === 8) || /*ELIMINAR O DELETE O RETROCEDER*/
            (event.which >= 35 && event.which <= 40) || /*FLECHAS - INICIO - FIN*/
            (event.which === 9) /*TABULARDOR*/
            )) {
        return false;
    }
});
$(document).on("keydown", "input[data-precio]", function (event) {
    if (!((event.which >= 48 && event.which <= 57) || /*NUMERO 0 - 9*/
            (event.which >= 96 && event.which <= 105) || /*NUMERO PAD*/
            (event.which === 8) || /*ELIMINAR O DELETE O RETROCEDER*/
            (event.which >= 35 && event.which <= 40) || /*FLECHAS - INICIO - FIN*/
            (event.which === 190 || event.which === 110) || /* PUNTO PARA DECIMAL*/
            (event.which === 9) /*TABULARDOR*/
            )) {
        return false;
    }
});
$(document).on("keydown", "input[data-letra]", function (event) {
    if (((event.which >= 48 && event.which <= 57) || (event.which >= 96 && event.which <= 105))) {
        return false;
    }
});