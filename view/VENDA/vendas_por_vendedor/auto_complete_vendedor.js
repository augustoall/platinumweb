var MIN_LENGTH = 2;
$(document).ready(function () {
    $("#usu_nome").keyup(function () {
        var usu_nome = $("#usu_nome").val();
        var ID_CPF_EMPRESA = $("#ID_CPF_EMPRESA").val();
        if (usu_nome.length >= MIN_LENGTH) {
            $.get("auto_complete_vendedor.php", {usu_nome: usu_nome, ID_CPF_EMPRESA: ID_CPF_EMPRESA})
                    .done(function (data) {
                        $('#resultado').html('');
                        var results = JSON.parse(data);
                        $(results).each(function (key, value) {
                            console.log(value);
                            $('#resultado').append('<div class="item">' + value.usu_nome + '</div>');
                        })
                        $('.item').click(function () {
                            var text = $(this).html();
                            $('#usu_nome').val(text);
                        })
                    });
        } else {
            $('#resultado').html('');
        }
    });
    $('#usu_nome').blur(function () {
        $('#resultado').fadeOut(500);
    }).focus(function () {
        $('#resultado').show();
    });
});