
#SET FOREIGN_KEY_CHECKS=0;

## delete fk

#SET FOREIGN_KEY_CHECKS=1;


#clientes
ALTER TABLE clientes ADD CONSTRAINT fk_vendedor FOREIGN KEY (usu_codigo) REFERENCES usuarios(usu_codigo);

# entrada de produtos
ALTER TABLE entrada_produtos ADD CONSTRAINT fk_vendedor FOREIGN KEY (usu_codigo) REFERENCES usuarios(usu_codigo);
ALTER TABLE entrada_produtos ADD CONSTRAINT fk_fornecedor FOREIGN KEY (for_codigo) REFERENCES fornecedores(for_codigo);

#  produtos
ALTER TABLE produtos ADD CONSTRAINT fk_categorias FOREIGN KEY (cat_codigo) REFERENCES categorias(cat_codigo);
ALTER TABLE produtos ADD CONSTRAINT fk_fornecedores FOREIGN KEY (for_codigo) REFERENCES fornecedores(for_codigo);

# receber
ALTER TABLE receber ADD CONSTRAINT fk_cliente_rec FOREIGN KEY (rec_cli_codigo) REFERENCES clientes(cli_codigo);
# vendac
ALTER TABLE vendac ADD CONSTRAINT fk_clientes_vendac FOREIGN KEY (vendac_cli_codigo) REFERENCES clientes(cli_codigo);
ALTER TABLE vendac ADD CONSTRAINT fk_vendedor_vendac FOREIGN KEY (vendac_usu_codigo) REFERENCES usuarios(usu_codigo);
# cheques
ALTER TABLE cheques ADD CONSTRAINT fk_cliente FOREIGN KEY (chq_cli_codigo) REFERENCES clientes(cli_codigo);

# vendad
ALTER TABLE vendad ADD CONSTRAINT fk_produto_vendad FOREIGN KEY (vendad_codigo_produto) REFERENCES produtos(prd_codigo);

# entrada produtos D
ALTER TABLE entrada_produtos_d ADD CONSTRAINT fk_produto FOREIGN KEY (entd_prd_codigo) REFERENCES produtos(prd_codigo);


# entrada produtos
ALTER TABLE entrada_produtos ADD CONSTRAINT fk_fornec FOREIGN KEY (for_codigo) REFERENCES fornecedores(for_codigo);
ALTER TABLE entrada_produtos ADD CONSTRAINT fk_usuario_vendedor FOREIGN KEY (usu_codigo) REFERENCES usuarios(usu_codigo);

# imagem de produto
ALTER TABLE imagensprd ADD CONSTRAINT fk_produtoimg FOREIGN KEY (prd_codigo) REFERENCES produtos(prd_codigo);