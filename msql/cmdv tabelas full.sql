CREATE TABLE `categorias` (
  `cat_codigo` int(11) NOT NULL AUTO_INCREMENT,
  `cat_descricao` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `ID_CPF_EMPRESA` varchar(11) NOT NULL,
  PRIMARY KEY (`cat_codigo`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

CREATE TABLE `chave_de_licenca` (
  `lic_id` int(11) NOT NULL AUTO_INCREMENT,
  `lic_chave` varchar(50) NOT NULL,
  `lic_dias` int(11) NOT NULL,
  `lic_usada_por` varchar(100) NOT NULL,
  `lic_datahora_uso` datetime NOT NULL,
  `lic_status` char(1) NOT NULL,
  PRIMARY KEY (`lic_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `cheques` (
  `ID_CPF_EMPRESA` varchar(11) DEFAULT NULL,
  `chq_codigo` int(11) NOT NULL AUTO_INCREMENT,
  `chq_cli_codigo` int(11) DEFAULT NULL,
  `chq_numerocheque` varchar(20) DEFAULT NULL,
  `chq_telefone1` varchar(20) DEFAULT NULL,
  `chq_telefone2` varchar(20) DEFAULT NULL,
  `chq_cpf_dono` varchar(50) DEFAULT NULL,
  `chq_nomedono` varchar(50) DEFAULT NULL,
  `chq_nomebanco` varchar(50) DEFAULT NULL,
  `chq_vencimento` date DEFAULT NULL,
  `chq_valorcheque` decimal(10,2) DEFAULT NULL,
  `chq_terceiro` char(1) DEFAULT NULL,
  `vendac_chave` varchar(70) DEFAULT NULL,
  `chq_dataCadastro` date NOT NULL,
  `chq_enviado` char(1) NOT NULL,
  PRIMARY KEY (`chq_codigo`),
  KEY `fk_cliente` (`chq_cli_codigo`),
  CONSTRAINT `fk_cliente` FOREIGN KEY (`chq_cli_codigo`) REFERENCES `clientes` (`cli_codigo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `cidades` (
  `ID_CPF_EMPRESA` varchar(11) NOT NULL,
  `cid_codigo` int(11) NOT NULL,
  `cid_nome` varchar(50) NOT NULL,
  `cid_uf` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `clientes` (
  `ID_CPF_EMPRESA` varchar(11) NOT NULL,
  `cli_codigo` int(11) NOT NULL AUTO_INCREMENT,
  `cli_nome` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `cli_fantasia` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `cli_endereco` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `cli_bairro` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `cli_cep` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `cid_codigo` int(11) NOT NULL,
  `cli_contato1` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `cli_contato2` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `cli_contato3` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `cli_nascimento` date NOT NULL,
  `cli_cpfcnpj` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `cli_rginscricaoest` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `cli_limite` decimal(10,2) NOT NULL,
  `cli_email` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `cli_observacao` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `usu_codigo` int(11) NOT NULL,
  `cli_senha` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `cli_chave` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`cli_codigo`),
  KEY `fk_usuarios` (`usu_codigo`),
  KEY `cli_chave` (`cli_chave`),
  CONSTRAINT `fk_vendedor` FOREIGN KEY (`usu_codigo`) REFERENCES `usuarios` (`usu_codigo`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

CREATE TABLE `conf_pagamento` (
  `pag_id` int(11) NOT NULL AUTO_INCREMENT,
  `ID_CPF_EMPRESA` varchar(11) NOT NULL,
  `vendac_chave` varchar(70) NOT NULL,
  `pag_parcelas_cartao` int(11) NOT NULL,
  `pag_parcelas_normal` int(11) NOT NULL,
  `pag_valor_recebido` decimal(10,2) NOT NULL,
  `pag_recebeucom_din_chq_cart` varchar(20) NOT NULL,
  `pag_tipo_pagamento` varchar(20) NOT NULL,
  `pag_sementrada_comentrada` varchar(10) NOT NULL,
  PRIMARY KEY (`pag_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `empresa` (
  `emp_codigo` int(11) NOT NULL AUTO_INCREMENT,
  `emp_nome` varchar(100) CHARACTER SET latin1 NOT NULL,
  `emp_cpf` varchar(100) CHARACTER SET latin1 NOT NULL,
  `emp_licenca` varchar(100) CHARACTER SET latin1 NOT NULL,
  `emp_inicio` date DEFAULT NULL,
  `emp_fim` date NOT NULL,
  `emp_celularkey` varchar(100) CHARACTER SET latin1 NOT NULL,
  `usu_codigo` int(11) NOT NULL,
  `emp_datapedido` date NOT NULL,
  `emp_totalemdias` int(11) NOT NULL,
  `emp_numerocelular` varchar(50) CHARACTER SET latin1 DEFAULT NULL,
  `emp_email` varchar(50) CHARACTER SET latin1 DEFAULT NULL,
  PRIMARY KEY (`emp_codigo`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

CREATE TABLE `empresa_config` (
  `emp_id` int(11) NOT NULL AUTO_INCREMENT,
  `ID_CPF_EMPRESA` varchar(11) NOT NULL,
  `emp_nome` varchar(100) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `emp_cidade` varchar(100) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `emp_endereco` varchar(100) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `emp_bairro` varchar(100) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `emp_cep` varchar(100) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `emp_cnpj` varchar(100) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `emp_contato1` varchar(100) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `emp_contato2` varchar(100) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `emp_contato3` varchar(100) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `emp_email` varchar(100) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `emp_facebook` varchar(100) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `emp_siteurl` varchar(100) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`emp_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `entrada_produtos` (
  `ID_CPF_EMPRESA` varchar(12) DEFAULT NULL,
  `ent_id` int(20) NOT NULL AUTO_INCREMENT,
  `ent_numeronota` int(20) NOT NULL,
  `ent_data_entrada` datetime NOT NULL,
  `ent_valor_nota` decimal(10,2) NOT NULL,
  `usu_codigo` int(11) NOT NULL,
  `for_codigo` int(11) NOT NULL,
  PRIMARY KEY (`ent_id`),
  KEY `fk_fornec` (`for_codigo`),
  KEY `fk_usuario_vendedor` (`usu_codigo`),
  CONSTRAINT `fk_fornec` FOREIGN KEY (`for_codigo`) REFERENCES `fornecedores` (`for_codigo`),
  CONSTRAINT `fk_usuario_vendedor` FOREIGN KEY (`usu_codigo`) REFERENCES `usuarios` (`usu_codigo`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

CREATE TABLE `entrada_produtos_d` (
  `ID_CPF_EMPRESA` varchar(12) DEFAULT NULL,
  `ent_id` int(20) NOT NULL,
  `entd_ean` varchar(13) DEFAULT NULL,
  `entd_prd_codigo` int(11) NOT NULL,
  `entd_descricaoprd` varchar(100) DEFAULT NULL,
  `entd_custo` decimal(10,2) NOT NULL,
  `entd_qtd` decimal(10,2) NOT NULL,
  `entd_margem` decimal(10,2) NOT NULL,
  `entd_preco` decimal(10,2) NOT NULL,
  KEY `fk_produto` (`entd_prd_codigo`),
  CONSTRAINT `fk_produto` FOREIGN KEY (`entd_prd_codigo`) REFERENCES `produtos` (`prd_codigo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `fornecedores` (
  `ID_CPF_EMPRESA` varchar(11) NOT NULL,
  `for_codigo` int(11) NOT NULL AUTO_INCREMENT,
  `for_razaosocial` varchar(50) NOT NULL,
  `for_fantasia` varchar(50) NOT NULL,
  `for_endereco` varchar(50) NOT NULL,
  `for_cep` varchar(20) NOT NULL,
  `for_bairro` varchar(20) NOT NULL,
  `for_contato1` varchar(30) NOT NULL,
  `for_contato2` varchar(30) NOT NULL,
  `for_representante` varchar(50) NOT NULL,
  `for_email` varchar(50) NOT NULL,
  `for_cnpjcpf` varchar(30) NOT NULL,
  `cid_codigo` int(11) NOT NULL,
  PRIMARY KEY (`for_codigo`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

CREATE TABLE `historico_pagamento` (
  `ID_CPF_EMPRESA` varchar(11) NOT NULL,
  `hist_codigo` int(11) NOT NULL AUTO_INCREMENT,
  `hist_numero_parcela` int(11) DEFAULT NULL,
  `hist_valor_real_parcela` decimal(10,2) DEFAULT NULL,
  `hist_valor_pago_no_dia` decimal(10,2) DEFAULT NULL,
  `hist_restante_a_pagar` decimal(10,2) DEFAULT NULL,
  `hist_datapagamento` date DEFAULT NULL,
  `hist_nomecliente` varchar(60) DEFAULT NULL,
  `hist_pagou_com` varchar(60) DEFAULT NULL,
  `vendac_chave` varchar(60) DEFAULT NULL,
  `hist_enviado` char(1) DEFAULT NULL,
  `usu_celularkey` varchar(20) NOT NULL,
  PRIMARY KEY (`hist_codigo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `imagensprd` (
  `ID_CPF_EMPRESA` varchar(11) NOT NULL,
  `img_codigo` int(11) NOT NULL AUTO_INCREMENT,
  `img_descricao` varchar(200) NOT NULL,
  `prd_codigo` int(11) NOT NULL,
  PRIMARY KEY (`img_codigo`),
  KEY `fk_produtoimg` (`prd_codigo`),
  CONSTRAINT `fk_produtoimg` FOREIGN KEY (`prd_codigo`) REFERENCES `produtos` (`prd_codigo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `log` (
  `log_id` int(11) NOT NULL AUTO_INCREMENT,
  `ID_CPF_EMPRESA` varchar(11) DEFAULT NULL,
  `log_celular_usuario` varchar(20) DEFAULT NULL,
  `log_codigo_usuario` varchar(20) DEFAULT NULL,
  `log_email_usuario` varchar(50) DEFAULT NULL,
  `log_datahora_ocorrencia` datetime DEFAULT NULL,
  `log_tabela` varchar(30) DEFAULT NULL,
  `log_acao` text,
  PRIMARY KEY (`log_id`)
) ENGINE=InnoDB AUTO_INCREMENT=108 DEFAULT CHARSET=utf8;

CREATE TABLE `logomarcas` (
  `ID_CPF_EMPRESA` varchar(11) NOT NULL,
  `lgm_codigo` int(11) NOT NULL AUTO_INCREMENT,
  `lgm_nomelogo` varchar(70) NOT NULL,
  PRIMARY KEY (`lgm_codigo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `permissoes` (
  `ID_CPF_EMPRESA` varchar(11) NOT NULL,
  `per_codigo` int(11) NOT NULL AUTO_INCREMENT,
  `nome_tabela` varchar(50) NOT NULL,
  `log_numerocelular` varchar(20) NOT NULL,
  `usu_celularkey` varchar(50) NOT NULL,
  `per_incluir` char(1) NOT NULL,
  `per_alterar` char(1) NOT NULL,
  `per_visualizar` char(1) NOT NULL,
  `per_excluir` char(1) NOT NULL,
  `per_nivel` varchar(20) NOT NULL,
  PRIMARY KEY (`per_codigo`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;

CREATE TABLE `produtos` (
  `ID_CPF_EMPRESA` varchar(11) NOT NULL,
  `prd_codigo` int(11) NOT NULL AUTO_INCREMENT,
  `prd_ativo` char(1) NOT NULL,
  `prd_EAN` varchar(30) NOT NULL,
  `prd_descricao` varchar(50) NOT NULL,
  `prd_descr_red` varchar(50) NOT NULL,
  `prd_custo` decimal(10,2) NOT NULL,
  `prd_preco` decimal(10,2) NOT NULL,
  `prd_unmed` varchar(10) NOT NULL,
  `prd_quant` decimal(10,2) NOT NULL,
  `prd_obs` varchar(100) NOT NULL,
  `for_codigo` int(11) NOT NULL,
  `cat_codigo` int(11) NOT NULL,
  PRIMARY KEY (`prd_codigo`),
  KEY `fk_categorias` (`cat_codigo`),
  KEY `fk_fornecedores` (`for_codigo`),
  CONSTRAINT `fk_categorias` FOREIGN KEY (`cat_codigo`) REFERENCES `categorias` (`cat_codigo`),
  CONSTRAINT `fk_fornecedores` FOREIGN KEY (`for_codigo`) REFERENCES `fornecedores` (`for_codigo`)
) ENGINE=InnoDB AUTO_INCREMENT=100 DEFAULT CHARSET=utf8;

CREATE TABLE `receber` (
  `ID_CPF_EMPRESA` varchar(11) DEFAULT NULL,
  `rec_codigo` int(11) NOT NULL AUTO_INCREMENT,
  `rec_num_parcela` int(11) DEFAULT NULL,
  `rec_cli_codigo` int(11) DEFAULT NULL,
  `rec_cli_nome` varchar(50) DEFAULT NULL,
  `vendac_chave` varchar(60) DEFAULT NULL,
  `rec_datamovimento` date DEFAULT NULL,
  `rec_valorreceber` decimal(10,2) DEFAULT NULL,
  `rec_datavencimento` date DEFAULT NULL,
  `rec_datavencimento_extenso` varchar(50) DEFAULT NULL,
  `rec_data_que_pagou` date DEFAULT NULL,
  `rec_valor_pago` decimal(10,2) DEFAULT NULL,
  `rec_recebeu_com` varchar(50) DEFAULT NULL,
  `rec_parcelas_cartao` int(11) DEFAULT NULL,
  `rec_enviado` char(1) DEFAULT NULL,
  PRIMARY KEY (`rec_codigo`),
  KEY `fk_cliente_rec` (`rec_cli_codigo`),
  CONSTRAINT `fk_cliente_rec` FOREIGN KEY (`rec_cli_codigo`) REFERENCES `clientes` (`cli_codigo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `TABELAS` (
  `tabela_id` int(11) NOT NULL AUTO_INCREMENT,
  `tabela_nome` varchar(20) NOT NULL,
  PRIMARY KEY (`tabela_id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;

CREATE TABLE `usuarios` (
  `ID_CPF_EMPRESA` varchar(11) NOT NULL,
  `usu_codigo` int(11) NOT NULL AUTO_INCREMENT,
  `usu_nome` varchar(100) NOT NULL,
  `usu_email` varchar(50) NOT NULL,
  `usu_celularkey` varchar(50) NOT NULL,
  `usu_numerocelular` varchar(30) NOT NULL,
  `usu_cpf` varchar(20) NOT NULL,
  `usu_dispositivo` varchar(70) NOT NULL,
  `usu_liberado` char(1) NOT NULL,
  `usu_desconto` decimal(10,0) NOT NULL,
  `usu_comissao` decimal(10,0) NOT NULL,
  PRIMARY KEY (`usu_codigo`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

CREATE TABLE `vendac` (
  `vendac_id` int(11) NOT NULL AUTO_INCREMENT,
  `ID_CPF_EMPRESA` varchar(11) NOT NULL,
  `vendac_chave` varchar(70) DEFAULT NULL,
  `vendac_datahoravenda` datetime DEFAULT NULL,
  `vendac_previsao_entrega` date DEFAULT NULL,
  `vendac_usu_codigo` int(11) DEFAULT NULL,
  `vendac_usu_nome` varchar(50) DEFAULT NULL,
  `vendac_cli_codigo` int(11) DEFAULT NULL,
  `vendac_cli_nome` varchar(50) DEFAULT NULL,
  `vendac_fpgto_codigo` int(11) DEFAULT NULL,
  `vendac_fpgto_tipo` varchar(70) DEFAULT NULL,
  `vendac_valor` decimal(10,2) DEFAULT NULL,
  `vendac_peso_total` decimal(10,2) DEFAULT NULL,
  `vendac_observacao` varchar(50) DEFAULT NULL,
  `vendac_enviada` char(1) DEFAULT NULL,
  `vendac_latitude` varchar(50) DEFAULT NULL,
  `vendac_longitude` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`vendac_id`),
  KEY `fk_clientes_vendac` (`vendac_cli_codigo`),
  KEY `fk_vendedor_vendac` (`vendac_usu_codigo`),
  CONSTRAINT `fk_clientes_vendac` FOREIGN KEY (`vendac_cli_codigo`) REFERENCES `clientes` (`cli_codigo`),
  CONSTRAINT `fk_vendedor_vendac` FOREIGN KEY (`vendac_usu_codigo`) REFERENCES `usuarios` (`usu_codigo`)
) ENGINE=InnoDB AUTO_INCREMENT=6967 DEFAULT CHARSET=utf8;

CREATE TABLE `vendad` (
  `ID_CPF_EMPRESA` varchar(11) DEFAULT NULL,
  `vendac_chave` varchar(70) DEFAULT NULL,
  `vendad_nro_item` int(11) DEFAULT NULL,
  `vendad_ean` varchar(50) DEFAULT NULL,
  `vendad_codigo_produto` int(11) DEFAULT NULL,
  `vendad_descricao_produto` varchar(50) DEFAULT NULL,
  `vendad_quantidade` decimal(10,0) DEFAULT NULL,
  `vendad_precovenda` decimal(10,2) DEFAULT NULL,
  `vendad_total` decimal(10,2) DEFAULT NULL,
  KEY `fk_produto_vendad` (`vendad_codigo_produto`),
  CONSTRAINT `fk_produto_vendad` FOREIGN KEY (`vendad_codigo_produto`) REFERENCES `produtos` (`prd_codigo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
