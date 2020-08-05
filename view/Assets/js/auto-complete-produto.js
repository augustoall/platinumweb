$(document).ready(function () {

    // Atribui evento e função para limpeza dos campos
    $('#busca_produto').on('input', limpaCampos);

    // Dispara o Autocomplete a partir do segundo caracter
    $("#busca_produto").autocomplete({
        minLength: 2,
        source: function (request, response) {
            $.ajax({
                url: "../ENTRPRODUTO/ajax-entrada-produto.php",
                dataType: "json",
                data: {
                    acao: 'AUTO_COMPLETE',
                    parametro: $('#busca_produto').val()
                },
                success: function (data) {
                    response(data);
                }
            });
        },
        focus: function (event, ui) {
            $("#busca_produto").val(ui.item.prd_descricao);
            carregarDados();
            return false;
        },
        select: function (event, ui) {
            $("#busca_produto").val(ui.item.prd_descricao);
            return false;
        }
    }).autocomplete("instance")._renderItem = function (ul, item) {
        return $("<li>").append("<a><b>Código:</b>" + item.prd_codigo + "<br><b> Descrição:</b>" + item.prd_descricao + "<b> -- Preço:</b>" + item.prd_preco + "<b> -- Estoque :</b> " + item.prd_quant + "</a><br>")
                .appendTo(ul);

    };

    // Função para carregar os dados da consulta nos respectivos campos
    function carregarDados() {
        var busca = $('#busca_produto').val();
        if (busca != "" && busca.length >= 2) {
            $.ajax({
                url: "../ENTRPRODUTO/ajax-entrada-produto.php",
                dataType: "json",
                data: {
                    acao: 'CONSULTA',
                    parametro: $('#busca_produto').val()
                },
                success: function (data) {
                    $('#entd_prd_codigo').val(data[0].prd_codigo);
                    $('#entd_descricaoprd').val(data[0].prd_descricao);
                    $('#qtd').val(data[0].prd_quant);
                    $('#entd_ean').val(data[0].prd_EAN);
                    
                    
                }
            });
        }

    }

    // Função para limpar os campos caso a busca esteja vazia
    function limpaCampos() {
        var busca = $('#busca_produto').val();
        if (busca == "") {
            $('#entd_prd_codigo').val('');
            $('#entd_descricaoprd').val('')
            $('#qtd').val('');
            $('#entd_ean').val('');
        }
    }

});