<?php
$ID_CPF_EMPRESA = $_SESSION["ID_CPF_EMPRESA"];

$produto = new ProdutosInstance();
$prodBean1 = new ProdutoBean();
$prodBean2 = new ProdutoBean();
$prodBean1 = $produto->C_buscarTodosProdutos_ATIVOS($ID_CPF_EMPRESA);
$prodBean2 = $produto->C_buscarTodosProdutos($ID_CPF_EMPRESA);
$ativos = count($prodBean1);
$inativos = count($prodBean2);
$total_inativos = $inativos - $ativos;

$cliente = new ClientesInstance();
$cliBean = new ClientesBean();
$cliBean = $cliente->C_buscarTodosClientes($ID_CPF_EMPRESA);

$fornecedor = new FornecedoresInstancce();
$fornBean = new FornecedoresBean();
$fornBean = $fornecedor->C_buscaTodosFornecedores($ID_CPF_EMPRESA);

$vendaC = new VendaInstance();
$vendaCBean = new VendacBean();
$data_inicial = date('d/m/Y');
$datafinal = date('d/m/Y');
$vendaCBean = $vendaC->c_conta_vendas_do_dia($ID_CPF_EMPRESA, $data_inicial, $datafinal);

$permisao = new PermissoesInstance();
$permissaoBean = new PermissoesBean();
$permissaoBean = $permisao->C_buscarPermParaTabelaDe("empresa");
$nivel = $permissaoBean->getPer_nivel();
?>

<header class="main-header">
    <a href="Assets/images/user01.png" class="logo">        
        <span class="logo-mini"><?php echo $nivel ?></span>        
        <span class="logo-lg"><b><?php echo $nivel ?></b></span>
    </a>

    <nav class="navbar navbar-static-top">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </a>

        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">

                <?php if ($nivel == "DIRETOR") : ?>
                    <!--li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">PUSH NOTIFICATIONS<span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="FIREBASE/fcm-global-push.php" target="Frame1">Enviar push para todos os Clientes</a></li>
                            <li><a href="FIREBASE/Lista_devices.php" target="Frame1">Enviar push para um Cliente </a></li>
                        </ul>
                    </li -->
                <?php endif; ?>

                <?php if ($nivel == "DIRETOR" || $nivel == "ADM") : ?>
                    <!--li><a href="EMPRESA_CONFIG/empresa-config.php" target="Frame1">CONFIGURAÇÕES EMPRESA</a></li -->
                <?php endif; ?>



                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">COMPRAS PRODUTOS<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="ENTRPRODUTO/CadastraEntradaProduto.php" target="Frame1">Entrada de Produtos</a></li>
                        <li><a href="ENTRPRODUTO/ListaEntradaProdutos.php" target="Frame1">Consultar Notas de Entrada</a></li>
                        <li><a href="PRODUTOS/ListaProdutos.php" target="Frame1">Consultar estoque produto</a></li>
                    </ul>
                </li>

                <li class="dropdown messages-menu">
                    <a href="#" data-toggle="tooltip" data-placement="bottom" title="Clientes" class="dropdown-toggle">
                        <i class="fa fa-users"></i>
                        <span class="label <?php echo (count($cliBean) > 0) ? 'label-success' : 'label-danger' ?>"><?php echo count($cliBean) ?></span>
                    </a>

                </li>

                <li class="dropdown notifications-menu">
                    <a href="#" data-toggle="tooltip" data-placement="bottom" title="Produtos Ativos" class="dropdown-toggle" >
                        <i class="fa fa-barcode"></i>
                        <span class="label <?php echo (count($prodBean1) > 0) ? 'label-success' : 'label-danger' ?>"><?php echo count($prodBean1) ?></span>
                    </a>
                </li>

                <li class="dropdown tasks-menu">
                    <a href="#" data-toggle="tooltip" data-placement="bottom" title="Produtos Inativos" class="dropdown-toggle" >
                        <i class="fa fa-barcode"></i>
                        <span class="label <?php echo ($total_inativos > 0) ? 'label-danger' : 'label-success' ?>"><?php echo $total_inativos ?></span>
                    </a>                
                </li>

                <li class="dropdown tasks-menu">
                    <a href="#" data-toggle="tooltip" data-placement="bottom" title="Fornecedores" class="dropdown-toggle">
                        <i class="fa fa-suitcase"></i>
                        <span class="label <?php echo ($fornBean > 0) ? 'label-success' : 'label-danger' ?>"><?php echo count($fornBean) ?></span>
                    </a>
                </li>

                <li class="dropdown tasks-menu">
                    <a href="#" data-toggle="tooltip" data-placement="bottom" title="Vendas Hoje" class="dropdown-toggle">
                        <i class="fa fa-cc-visa"></i>
                        <span class="label <?php echo ($vendaCBean > 0) ? 'label-success' : 'label-danger' ?>"><?php echo count($vendaCBean) ?></span>
                    </a>
                </li>   


                <li class="dropdown tasks-menu">
                    <a href="VENDA/grafico_de_vendas_por_vendedor.php" data-toggle="tooltip" data-placement="bottom" title="Gráfico de vendas por vendedor" target="Frame1"  class="dropdown-toggle">
                        <i class="fa fa fa-pie-chart"></i>                        
                    </a>
                </li>

                <li class="dropdown tasks-menu">
                    <a href="VENDA/ListaVendas.php" data-toggle="tooltip" data-placement="bottom" title="Ver últimas vendas" class="dropdown-toggle" >
                        <i class="fa fa-eye"></i>                        
                    </a>
                </li>

                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <img src="Assets/images/user01.png" class="user-image" alt="User Image">
                        <span class="hidden-xs"><?php echo $_SESSION["usu_nome"] ?></span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header">
                            <img src="Assets/images/user01.png" class="img-circle" alt="User Image">
                            <p>
                                <?php echo $_SESSION["usu_nome"] ?>                               
                            </p>
                        </li>

                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-left">
                                <a href="USUARIOS/CadastraUsuarios.php?usu_codigo=<?php echo $_SESSION["usu_codigo"] ?>" target="Frame1" class="btn btn-default btn-flat">Perfil</a>
                            </div>
                            <div class="pull-right">
                                <a href="logoff.php" class="btn btn-default btn-flat">Sair</a>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>