var MIN_LENGTH = 2;
$(document).ready(function () {
    $("#cli_nome").keyup(function () {
        var nome_cliente = $("#cli_nome").val();
        var ID_CPF_EMPRESA = $("#ID_CPF_EMPRESA").val();
        if (nome_cliente.length >= MIN_LENGTH) {
            $.get("auto_complete_cliente.php", {cli_nome: nome_cliente, ID_CPF_EMPRESA: ID_CPF_EMPRESA})
                    .done(function (data) {
                        $('#resultado').html('');
                        var results = JSON.parse(data);
                        $(results).each(function (key, value) {
                            console.log(value);
                            $('#resultado').append('<div class="item">' + value.cli_nome + '</div>');
                        })
                        $('.item').click(function () {
                            var text = $(this).html();
                            $('#cli_nome').val(text);
                        })
                    });
        } else {
            $('#resultado').html('');
        }
    });
    $('#cli_nome').blur(function () {
        $('#resultado').fadeOut(500);
    }).focus(function () {
        $('#resultado').show();
    });
});