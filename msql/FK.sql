
--
-- Indexes for table `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`cat_codigo`);

--
-- Indexes for table `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`cli_codigo`);

--
-- Indexes for table `contas`
--
ALTER TABLE `contas`
  ADD PRIMARY KEY (`conta_codigo`);

--
-- Indexes for table `entrada_produtos`
--
ALTER TABLE `entrada_produtos`
  ADD PRIMARY KEY (`ent_id`),
  ADD KEY `FK_entrada_produtos_prd_codigo` (`ent_prd_codigo`);

--
-- Indexes for table `fornecedores`
--
ALTER TABLE `fornecedores`
  ADD PRIMARY KEY (`for_codigo`);

--
-- Indexes for table `orcamento_c`
--
ALTER TABLE `orcamento_c`
  ADD PRIMARY KEY (`orc_id`),
  ADD KEY `FK_orcamentoC_cli_codigo` (`cli_codigo`),
  ADD KEY `FK_orcamentoC_usu_codigo` (`usu_codigo`);

--
-- Indexes for table `orcamento_d`
--
ALTER TABLE `orcamento_d`
  ADD KEY `FK_orcamentoD_prod_codigo` (`prd_codigo`);

--
-- Indexes for table `pagar`
--
ALTER TABLE `pagar`
  ADD PRIMARY KEY (`pag_codigo`),
  ADD KEY `FK_contaid` (`conta_codigo`);

--
-- Indexes for table `permissoes`
--
ALTER TABLE `permissoes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_permissoes_usu_codigo` (`usu_codigo`);

--
-- Indexes for table `produtos`
--
ALTER TABLE `produtos`
  ADD PRIMARY KEY (`prd_codigo`),
  ADD KEY `FK_produtos_cat_codigo` (`cat_codigo`),
  ADD KEY `FK_produtos_for_codigo` (`for_codigo`);

--
-- Indexes for table `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`usu_codigo`);

--
-- Indexes for table `vendac`
--
ALTER TABLE `vendac`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_vendac_cli_codigo` (`vendac_cli_codigo`),
  ADD KEY `FK_vendac_usu_codigo` (`vendac_usu_codigo`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categorias`
--
ALTER TABLE `categorias`
  MODIFY `cat_codigo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `clientes`
--
ALTER TABLE `clientes`
  MODIFY `cli_codigo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;
--
-- AUTO_INCREMENT for table `contas`
--
ALTER TABLE `contas`
  MODIFY `conta_codigo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `entrada_produtos`
--
ALTER TABLE `entrada_produtos`
  MODIFY `ent_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `fornecedores`
--
ALTER TABLE `fornecedores`
  MODIFY `for_codigo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `orcamento_c`
--
ALTER TABLE `orcamento_c`
  MODIFY `orc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
--
-- AUTO_INCREMENT for table `pagar`
--
ALTER TABLE `pagar`
  MODIFY `pag_codigo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;
--
-- AUTO_INCREMENT for table `permissoes`
--
ALTER TABLE `permissoes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `produtos`
--
ALTER TABLE `produtos`
  MODIFY `prd_codigo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;
--
-- AUTO_INCREMENT for table `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `usu_codigo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1002;
--
-- AUTO_INCREMENT for table `vendac`
--
ALTER TABLE `vendac`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `entrada_produtos`
--
ALTER TABLE `entrada_produtos`
  ADD CONSTRAINT `FK_entrada_produtos_prd_codigo` FOREIGN KEY (`ent_prd_codigo`) REFERENCES `produtos` (`prd_codigo`);

--
-- Limitadores para a tabela `orcamento_c`
--
ALTER TABLE `orcamento_c`
  ADD CONSTRAINT `FK_orcamentoC_cli_codigo` FOREIGN KEY (`cli_codigo`) REFERENCES `clientes` (`cli_codigo`),
  ADD CONSTRAINT `FK_orcamentoC_usu_codigo` FOREIGN KEY (`usu_codigo`) REFERENCES `usuarios` (`usu_codigo`);

--
-- Limitadores para a tabela `orcamento_d`
--
ALTER TABLE `orcamento_d`
  ADD CONSTRAINT `FK_orcamentoD_prod_codigo` FOREIGN KEY (`prd_codigo`) REFERENCES `produtos` (`prd_codigo`);

--
-- Limitadores para a tabela `pagar`
--
ALTER TABLE `pagar`
  ADD CONSTRAINT `FK_contaid` FOREIGN KEY (`conta_codigo`) REFERENCES `contas` (`conta_codigo`);

--
-- Limitadores para a tabela `produtos`
--
ALTER TABLE `produtos`
  ADD CONSTRAINT `FK_produtos_cat_codigo` FOREIGN KEY (`cat_codigo`) REFERENCES `categorias` (`cat_codigo`),
  ADD CONSTRAINT `FK_produtos_for_codigo` FOREIGN KEY (`for_codigo`) REFERENCES `fornecedores` (`for_codigo`);

--
-- Limitadores para a tabela `vendac`
--
ALTER TABLE `vendac`
  ADD CONSTRAINT `FK_vendac_cli_codigo` FOREIGN KEY (`vendac_cli_codigo`) REFERENCES `clientes` (`cli_codigo`),
  ADD CONSTRAINT `FK_vendac_usu_codigo` FOREIGN KEY (`vendac_usu_codigo`) REFERENCES `usuarios` (`usu_codigo`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
