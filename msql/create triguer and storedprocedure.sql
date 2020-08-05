alter table entrada_produtos_d modify entd_ean varchar(13)

DROP trigger TRG_SaidaVendaD_AD;
DROP trigger TRG_SaidaVendaD_AI;
DROP trigger TRG_SaidaVendaD_AU;

DROP trigger TRG_EntradaProdut_AD;
DROP trigger TRG_EntradaProduto_AI;
DROP trigger TRG_EntradaProduto_AU;



CREATE TABLE entrada_produtos (
  ID_CPF_EMPRESA varchar(12),
  ent_id int(20) NOT NULL AUTO_INCREMENT, 
  ent_numeronota int(20) NOT NULL,
  ent_data_entrada datetime NOT NULL,
  ent_valor_nota decimal(10,2) NOT NULL,
  usu_codigo int(11) NOT NULL,
  for_codigo int(11) NOT NULL ,
  PRIMARY KEY (`ent_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=2017;



CREATE TABLE entrada_produtos_d (
  ID_CPF_EMPRESA varchar(12),
  ent_id int(20) NOT NULL,
  entd_ean varchar(13),
  entd_prd_codigo int(11) NOT NULL,
  entd_descricaoprd varchar(100),
  entd_custo decimal(10,2) NOT NULL,
  entd_qtd decimal(10,2) NOT NULL,
  entd_margem decimal(10,2) NOT NULL,
  entd_preco decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


# TRIGUER PARA ENTRADA DE PRODUTOS / COMPRAS

CREATE TRIGGER TRG_EntradaProdutoD_AF_INS AFTER INSERT ON entrada_produtos_d
 FOR EACH ROW call SP_AtualizarEstoqueENTRADA_PRODUTO(new.entd_prd_codigo,new.entd_qtd,new.entd_custo,new.entd_preco);


CREATE TRIGGER TRG_EntradaProdutoD_AF_UPD AFTER UPDATE ON entrada_produtos_d
 FOR EACH ROW call SP_AtualizarEstoqueENTRADA_PRODUTO(new.entd_prd_codigo,new.entd_qtd-old.entd_qtd,new.entd_custo,new.entd_preco);


CREATE TRIGGER TRG_EntradaProdutoD_AF_DEL AFTER DELETE ON entrada_produtos_d
 FOR EACH ROW call SP_AtualizarEstoqueENTRADA_PRODUTO(old.entd_prd_codigo,old.entd_qtd*-1,old.entd_custo,old.entd_preco);


# TRIGUER PARA VENDAS EXPORTADAS ANDROID


CREATE TRIGGER `TRG_SaidaVendaD_AD` AFTER DELETE ON `vendad`
 FOR EACH ROW call SP_AtualizarEstoqueVENDA_ANDROID(old.vendad_codigo_produto,old.vendad_quantidade);

CREATE TRIGGER `TRG_SaidaVendaD_AI` AFTER INSERT ON `vendad`
 FOR EACH ROW call SP_AtualizarEstoqueVENDA_ANDROID(new.vendad_codigo_produto,new.vendad_quantidade * -1);

CREATE TRIGGER `TRG_SaidaVendaD_AU` AFTER UPDATE ON `vendad`
 FOR EACH ROW call SP_AtualizarEstoqueVENDA_ANDROID(new.vendad_codigo_produto,old.vendad_quantidade - new.vendad_quantidade);





# PROCEDURE PARA ATUALIZAR O ESTOQUE DO PRODUTO  NA EXPORTACAO E NA ENTRADA DEPRODUTOS

CREATE PROCEDURE `SP_AtualizarEstoqueVENDA_ANDROID`(IN `codprd` int, IN `qtde` DECIMAL(10,2))
    NO SQL
update produtos set prd_quant = prd_quant + qtde where prd_codigo = codprd ;



CREATE  PROCEDURE `SP_AtualizarEstoqueENTRADA_PRODUTO`(IN `prdcod` int, IN `qtde` DECIMAL(10,2), IN `custo` DECIMAL(10,2), IN `preco` DECIMAL(10,2))
    NO SQL
update produtos set prd_quant = prd_quant + qtde ,prd_custo = custo ,prd_preco = preco where prd_codigo = prdcod ;










