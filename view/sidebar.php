<!-- sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: este estilo pode ser encontrado em sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="Assets/images/user01.png" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p><?php echo $_SESSION["usu_nome"] ?></p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
            <li class="header">Navegação Principal</li>
            <?php if ($nivel == "DIRETOR") : ?>
                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-pencil"></i>
                        <span>FUNÇÕES GERAIS</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="EMPRESA/ListaEmpresa.php" target="Frame1" ><i class="img-circle"></i> Administrar Empresas</a></li>
                    </ul>
                </li>
            <?php endif; ?>

            <li>
                <a href="home.php" target="Frame1">
                    <i class="fa fa-home"></i> <span>Painel Principal</span>
                </a>
            </li> 

            <?php if ($nivel == "DIRETOR" || $nivel == "ADM") : ?>
                
            
                <li>
                    <a href="PERMISSOES/VisualizarPermissao.php" target="Frame1">
                        <i class="fa fa-key"></i> <span>Permissões</span>
                    </a>
                </li> 
                <li>
                    <a href="LOG/VisualizarLog.php" target="Frame1">
                        <i class="fa fa-floppy-o"></i> <span>Log do sistema</span>
                    </a>
                </li>
            <?php endif; ?>
            <li class="header">Cadastros e consultas</li>

            <li class="treeview">
                <a href="#">
                    <i class="fa fa-floppy-o"></i>
                    <span>Cadastros Gerais</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="CATEGORIAS/CadastraCategorias.php" target="Frame1"><i class="fa fa-caret-right"></i> Cadastro de Categorias</a></li>
                    <li><a href="FORNECEDOR/CadastraFornecedor.php" target="Frame1"><i class="fa fa-caret-right"></i> Cadastro de Fornecedores</a></li>
                    <li><a href="PRODUTOS/CadastraProdutos.php" target="Frame1"><i class="fa fa-caret-right"></i> Cadastro de Produtos</a></li>
                    <li><a href="PRODUTOS/CarregarProdutosExel.php" target="Frame1"><i class="fa fa-caret-right"></i>Cadastro Produtos Exel</a></li>	
                    <li><a href="CLIENTES/CadastraClientes.php" target="Frame1"><i class="fa fa-caret-right"></i> Cadastro Clientes </a></li>
                </ul>
            </li>
            
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-floppy-o"></i>
                    <span>Cadastros Produtos</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="CATEGORIAS/CadastraCategorias.php" target="Frame1"><i class="fa fa-caret-right"></i> Cadastro de Categorias</a></li>
                    <li><a href="FORNECEDOR/CadastraFornecedor.php" target="Frame1"><i class="fa fa-caret-right"></i> Cadastro de Fornecedores</a></li>
                    <li><a href="PRODUTOS/CadastraProdutos.php" target="Frame1"><i class="fa fa-caret-right"></i> Cadastro de Produtos</a></li>
                    <li><a href="PRODUTOS/CarregarProdutosExel.php" target="Frame1"><i class="fa fa-caret-right"></i>Cadastro Produtos Exel</a></li>	
                    <li><a href="CLIENTES/CadastraClientes.php" target="Frame1"><i class="fa fa-caret-right"></i> Cadastro Clientes </a></li>
                </ul>
            </li>

            <li class="treeview">
                <a href="#">
                    <i class="fa fa-search"></i>
                    <span>Consultas Gerais</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">  			
                    <li><a href="CLIENTES/ListaClientes.php" target="Frame1"><i class="fa fa-caret-right"></i> de clientes</a></li>                   
                    <li><a href="PRODUTOS/ListaProdutos.php" target="Frame1"><i class="fa fa-caret-right"></i> de produtos</a></li>
                    <li><a href="CATEGORIAS/ListaCategorias.php" target="Frame1"><i class="fa fa-caret-right"></i> de categorias</a></li>
                    <li><a href="FORNECEDOR/ListaFornecedor.php" target="Frame1"><i class="fa fa-caret-right"></i> de fornecedores</a></li>
                    <li><a href="CHEQUES/ListaCheques.php" target="Frame1"><i class="fa fa-caret-right"></i> de Cheques</a></li>
                    <li><a href="USUARIOS/ListaUsuarios.php" target="Frame1"><i class="fa fa-caret-right"></i> de usuários</a></li>
                </ul>
            </li> 



            <li>
                <a href="VENDA/consultas_de_vendas/consulta_pedvenda_codigo.php" target="Frame1">
                    <i class="fa fa-search"></i> <span>Consulta Pedido</span>            
                </a>
            </li> 

            <li>
                <a href="RECEBER/contas_todas/ListaContasReceber.php" target="Frame1">
                    <i class="fa fa-search"></i> <span>Consulta Parcelas</span>            
                </a>
            </li> 



            <li class="treeview">
                <a href="#">
                    <i class="fa fa-search"></i>
                    <span>Consulta de Pagamentos</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="HISTORICO_PAGAMENTO/ListaHistoricosPagamentos.php" target="Frame1"><i class="fa fa-caret-right"></i> Pagamentos - Todos</a></li>
                </ul>
            </li>

            <li class="header">Relatórios</li>

            <li class="treeview">
                <a href="#">
                    <i class="fa fa-file-pdf-o"></i>
                    <span>Relatório Clientes</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">  
                    <li><a href="CLIENTES/Relatorio_clientes.php?rel=CIDADE" target="Frame1"><i class="fa fa-caret-right"></i> Por Cidade</a></li>  
                    <li><a href="CLIENTES/Relatorio_clientes.php?rel=BAIRRO" target="Frame1"><i class="fa fa-caret-right"></i> Por Bairro</a></li> 
                    <li><a href="CLIENTES/Relatorio_clientes.php?rel=VENDEDOR" target="Frame1"><i class="fa fa-caret-right"></i> Por Vendedor</a></li>
                    <li><a href="VENDA/relatorios_gerais_vendas/rel_clientes_que_mais_compram.php" target="Frame1"><i class="fa fa-caret-right"></i> Clientes que mais compram</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-file-pdf-o"></i>
                    <span>Relatório Produtos</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">  
                    <li><a href="PRODUTOS/rel_produtos.php" target="Frame1"><i class="fa fa-caret-right"></i> Por Categoria</a></li>  
                    <li><a href="PRODUTOS/imprimir_rel_prod.php?produto=sem_estoque" target="Frame1"><i class="fa fa-caret-right"></i> Produtos Sem Estoque</a></li>  
                    <li><a href="PRODUTOS/imprimir_rel_prod.php?produto=all" target="Frame1"><i class="fa fa-caret-right"></i> Todos os Produtos</a></li>  
                    <li><a href="PRODUTOS/imprimir_rel_prod.php?produto=inativos" target="Frame1"><i class="fa fa-caret-right"></i> Produtos Inativos</a></li>  
                    <li><a href="VENDA/produtos_mais_vendidos_periodo/busca_produtos_mais_vendidos_periodo.php" target="Frame1"><i class="fa fa-caret-right"></i>Produtos + Vendidos</a></li>
                </ul>
            </li>

            <?php if ($nivel == "DIRETOR" || $nivel == "ADM") : ?>
                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-file-pdf-o"></i>
                        <span>Relatório Vendas</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">			   
                        <li ><a href="VENDA/vendas_por_cliente/busca_vendas_por_cliente.php" target="Frame1"><i class="fa fa-caret-right"></i> Por Cliente</a></li>
                        <li  ><a href="VENDA/vendas_por_periodo/busca_vendas_por_periodo.php" target="Frame1"><i class="fa fa-caret-right"></i> Por Período</a></li>
                        <li ><a href="VENDA/vendas_por_vendedor/busca_vendas_por_vendedor.php" target="Frame1"><i class="fa fa-caret-right"></i>  Por Vendedor</a></li>
                        <li><a href="VENDA/produtos_mais_vendidos_periodo/busca_produtos_mais_vendidos_periodo.php" target="Frame1"><i class="fa fa-caret-right"></i> Mais Vendidos</a></li>
                        <li><a href="VENDA/grafico_de_vendas_por_vendedor.php" target="Frame1"><i class="fa fa-caret-right"></i> Gráfico de vendas</a></li>
                        <li><a href="VENDA/relatorios_gerais_vendas/rel_clientes_que_mais_compram.php" target="Frame1"><i class="fa fa-caret-right"></i> Clientes que mais compram</a></li>
                    </ul>
                </li>


                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-file-pdf-o"></i>
                        <span>Rel.Contas Receber</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">			   
                        <li ><a href="RECEBER/contas_receber_por_cliente/busca_contas_receber_cliente.php" target="Frame1"><i class="fa fa-caret-right"></i> Por Cliente</a></li>
                    </ul>
                </li>  
            <?php endif; ?>
            <li class="header">Sistema CMDV</li>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>