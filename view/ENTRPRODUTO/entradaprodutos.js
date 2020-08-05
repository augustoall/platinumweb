$(document).ready(function () {

    $('#mensagem').hide();
    $('#msg_sem_item').hide();
    $('#itens_da_entrada').hide();
    $('#itens_adicionados').hide();

    $('#for_codigo').change(function () {
        $('#mensagem').hide().slideUp("slow");
    });

    $('#busca_produto').keyup(function () {
        $('#msg_sem_item').slideUp("slow");
    });

    $('#ent_numeronota').keyup(function () {
        $('#mensagem').slideUp("slow");
    });


    // submetendo o formulario e gerando nota de entrada 
    $('form[name="frm_entradaprodutos"]').submit(function () {
        var form_a = $(this);
        var botao = $(this).find(':button');
        var for_codigo = $('#for_codigo').val();
        var ent_numeronota = $('#ent_numeronota').val();
        var ent_valor_nota = $('#ent_valor_nota').val();

        console.log(ent_valor_nota);

        if (for_codigo == 0) {
            $('#mensagem').html('escolha um fornecedor').slideDown("slow");
            return false;
        }

        if (ent_numeronota == "") {
            $('#mensagem').html('informe o numero da nota').slideDown("slow");
            return false;
        }

        if (ent_valor_nota == "") {
            $('#mensagem').html('informe o valor da nota').slideDown("slow");
            return false;
        }

        $.ajax({
            url: "../ENTRPRODUTO/ajax-entrada-produto.php",
            type: "POST",
            data: "acao=GERAR_NOTA_DE_ENTRADA&" + form_a.serialize(),
            beforeSend: function () {
                botao.html('<i class="fa fa-spinner fa-spin"></i> Gerando nota de entrada').attr('disabled', true);
            },
            success: function (result) {
                var retorno = $.trim(result);

                console.log(retorno)

                if (retorno === 'NOTAEXISTENTE') {
                    $('#mensagem').html('nota já adicionada. Altere-a ').slideDown("slow");
                    botao.html('<i class="fa fa-floppy-o" aria-hidden="true"></i> Gerar Nota de Entrada').attr('disabled', false);
                }

                if (retorno > 0) {
                    $('#itens_da_entrada').slideDown("slow");
                    ;
                    $('#id').val(retorno);
                    $('#ent_id').val(retorno);

                    $('#ent_numeronota').attr('disabled', true);
                    $('#ent_valor_nota').attr('disabled', true);
                    $('#for_codigo').attr('disabled', true);

                    botao.html('<i class="fa fa-floppy-o" aria-hidden="true"></i> Gerar Nota de Entrada').attr('disabled', true);
                } else {
                    botao.html('<i class="fa fa-floppy-o" aria-hidden="true"></i> Gerar Nota de Entrada').attr('disabled', false);
                }
            },
            error: function (request, status, erro) {
                alert("Problema ocorrido: " + status + "\n Descrição: " + erro);
                alert("Informações da requisição: \n" + request.getAllResponseHeaders());
            }
        });

        return false;
    });


    //submetendo o formulado para adicionar items 
    $('form[name="frm_itens"]').submit(function () {
        var frm_itens = $(this);
        var botao = $(this).find(':button');
        var ID_CPF_EMPRESA = $('#ID_CPF_EMPRESA').val();
        var ent_id = $('#id').val();
        var entd_ean = $('#entd_ean').val();
        var entd_prd_codigo = $('#entd_prd_codigo').val();
        var entd_descricaoprd = $('#entd_descricaoprd').val();
        var entd_custo = $('#entd_custo').val();
        var entd_qtd = $('#entd_qtd').val();
        var entd_margem = $('#entd_margem').val();
        var entd_preco = $('#entd_preco').val();

        if (ent_id == '' || ent_id <= 0) {
            $('#msg_sem_item').html('Gerar uma nova nota de entrada de produtos').slideDown("slow");
            return false;
        }

        if (entd_prd_codigo <= 0) {
            $('#msg_sem_item').html('Informe o Produto no campo de busca').slideDown("slow");
            return false;
        }

        if (entd_custo == '' || entd_custo <= 0) {
            $('#msg_sem_item').html('Informe o preço de custo').slideDown("slow");
            return false;
        }

        if (entd_preco == '' || entd_preco <= 0) {
            $('#msg_sem_item').html('Informe o preço de venda').slideDown("slow");
            return false;
        }

        if (entd_qtd == '' || entd_qtd <= 0) {
            $('#msg_sem_item').html('Informe a quantidade').slideDown("slow");
            return false;
        }

        $.ajax({
            url: "../ENTRPRODUTO/ajax-entrada-produto.php",
            type: "POST",
            data: "acao=GRAVAR_ITENS&" + frm_itens.serialize(),
            beforeSend: function () {
                botao.html('<i class="fa fa-spinner fa-spin"></i> adicionando itens').attr('disabled', true);
            },
            success: function (result) {
                var retorno = $.trim(result);
                console.log(retorno)

                if (retorno > 0) {
                    botao.html('<i class="fa fa-plus-circle"></i> Adicionar produto').attr('disabled', false);
                    limpaCampos();
                    $("input:text:eq(11):visible").focus();
                    $('#itens_adicionados').slideDown("slow");
                    mostra_tabela_com_items_adicionados(retorno, ID_CPF_EMPRESA);
                }

                if (retorno === 'ITEM_JA_ADICIONADO') {
                    botao.html('<i class="fa fa-plus-circle"></i> Adicionar produto').attr('disabled', false);
                    limpaCampos();
                    $('#msg_sem_item').html('Este Produto já foi adicionado').slideDown("slow");
                }
                if (retorno === 0) {
                    botao.html('<i class="fa fa-plus-circle"></i> Adicionar produto').attr('disabled', false);
                    $('#msg_sem_item').html('Erro ao adicionar o Produto').slideDown("slow");
                    limpaCampos();
                }
            },
            error: function (request, status, erro) {
                alert("Problema ocorrido: " + status + "\n Descrição: " + erro);
                alert("Informações da requisição: \n" + request.getAllResponseHeaders());
            }
        });
        return false;
    });

    // deletando um item 
    $('.table').on('click', '#btn_excluir', function () {
        var ent_id = $(this).attr('data-ent_id');
        var entd_prd_codigo = $(this).attr('data-entd_prd_codigo');
        var ID_CPF_EMPRESA = $('#ID_CPF_EMPRESA').val();

        $.ajax({
            url: "../ENTRPRODUTO/ajax-entrada-produto.php",
            type: "POST",
            data: 'acao=DELETE_ITEM_NOTA&ent_id=' + ent_id + '&entd_prd_codigo=' + entd_prd_codigo + '&ID_CPF_EMPRESA=' + ID_CPF_EMPRESA,
            success: function (result) {

                var retorno = $.trim(result);
                if (retorno > 0) {
                    console.log(retorno);
                    mostra_tabela_com_items_adicionados(ent_id, ID_CPF_EMPRESA);
                }
            },
            error: function (request, status, erro) {
                alert("Problema ocorrido: " + status + "\n Descrição: " + erro);
                alert("Informações da requisição: \n" + request.getAllResponseHeaders());
            }
        });
        return false;
    });



    //listando os items inseridos 
    function mostra_tabela_com_items_adicionados(ent_id, ID_CPF_EMPRESA) {
        var html = '';
        $('#tabela').empty();
        $('#tabela').html('');
        $.ajax({
            type: 'POST',
            dataType: 'json',
            url: "../ENTRPRODUTO/ajax-entrada-produto.php",
            data: 'acao=BUSCAR_ITENS_DA_NOTA&ent_id=' + ent_id + '&ID_CPF_EMPRESA=' + ID_CPF_EMPRESA,
            success: function (retorno) {
                if (retorno != 0) {
                    $('#itens_adicionados').slideDown("slow");                 
                    for (var i = 0; retorno.length > i; i++) {
                        html += "<tr>";
                        html += "<td>" + retorno[i].entd_descricaoprd + "</td>";
                        html += "<td>" + retorno[i].entd_custo + "</td>";
                        html += "<td>" + retorno[i].entd_preco + "</td>";
                        html += "<td>" + retorno[i].entd_qtd + "</td>";
                        html += "<td><a class='btn btn-danger btn-xs' id='btn_excluir' data-entd_descricaoprd='" + retorno[i].entd_descricaoprd + "'  data-ent_id='" + retorno[i].ent_id + "'  data-entd_prd_codigo='" + retorno[i].entd_prd_codigo + "' href=''>excluir item</a></td>";
                        html += "</tr>";
                        $('#tabela').html(html);
                    }
                } else {
                    $('#itens_adicionados').hide().slideUp("slow");                   
                }
            }
        });
    }

    function limpaCampos() {
        $('#entd_ean').val('');
        $('#entd_prd_codigo').val('');
        $('#entd_descricaoprd').val('')
        $('#entd_qtd').val('');
        $('#entd_custo').val('');
        $('#entd_preco').val('');
        $('#qtd').val('');
        $('#busca_produto').val('');

    }


});