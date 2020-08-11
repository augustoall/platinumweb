<?php
    ob_start();
    session_start();

if ($_POST) {
//    ob_start();
//    session_start();

    $_SESSION["MENSAGEM"] = "";

    $BASE_URL = "https://cmdv.sistemaseapps.com.br/";

    require_once './includes/load__class__file_path_0.php';
    include_once './view/Config.php';

    $usuario = new UsuariosInstance();
    $usuBean = new UsuariosBean();
    $permisao = new PermissoesInstance();
    $permissaoBean = new PermissoesBean();
    $empresaConf = new EmpresaConfigInstance();
    $empresa = new EmpresaInstance();
    $empBean = new EmpresaBean();

    // Constante com a quantidade de tentativas aceitas
    define('TENTATIVAS_ACEITAS', 5);

    // Constante com a quantidade minutos para bloqueio
    define('MINUTOS_BLOQUEIO', 30);

    //Verifica se a origem da requisição é do mesmo domínio da aplicação
//    if (isset($_SERVER['HTTP_REFERER']) && $_SERVER['HTTP_REFERER'] != "http://www.centralmetadevendas.com.br/SistemaCMDV/"):
//        $_SESSION["MENSAGEM"] = 'HTTP_REFERER Erro ao tentar login!';
//        header("Location:" . $BASE_URL);
//        exit();
//    endif;

    $email = (isset($_POST['usu_email'])) ? $_POST['usu_email'] : '';
    $senha = (isset($_POST['usu_cpf'])) ? $_POST['usu_cpf'] : '';

    // Validações de preenchimento e-mail e senha se foi preenchido o e-mail
//    if (empty($email)):
//        $_SESSION["MENSAGEM"] = 'informe o email';
//        header("Location:");
//        exit();
//    endif;
//
//    if (empty($senha)):
//        $_SESSION["MENSAGEM"] = 'informe a senha';
//        header("Location:" . $BASE_URL);
//        exit();
//    endif;
//
//    // Verifica se o formato do e-mail é válido
//    if (!filter_var($email, FILTER_VALIDATE_EMAIL)):
//        $_SESSION["MENSAGEM"] = 'este não é um email válido';
//        header("Location:" . $BASE_URL);
//        exit();
//    endif;
// Dica 4 - Verifica se o usuário já excedeu a quantidade de tentativas erradas do dia
//    $sql = "SELECT count(*) AS tentativas, MINUTE(TIMEDIFF(NOW(), MAX(data_hora))) AS minutos ";
//    $sql .= "FROM usuarios_login_tentativas WHERE ip = ? and DATE_FORMAT(data_hora,'%Y-%m-%d') = ? AND bloqueado = ?";
//    $stm = ConPDO::getInstance()->prepare($sql);
//    $stm->bindValue(1, $_SERVER['SERVER_ADDR']);
//    $stm->bindValue(2, date('Y-m-d'));
//    $stm->bindValue(3, 'SIM');
//    $stm->execute();
//    $retorno = $stm->fetch(PDO::FETCH_OBJ);
//
//    if (!empty($retorno->tentativas) && intval($retorno->minutos) <= MINUTOS_BLOQUEIO):
//        $_SESSION["tentativas"] = '';
//        $_SESSION["MENSAGEM"] = 'limite de tentativas excedido !!';
//        header("Location:" . $BASE_URL);
//
//        exit();
//    endif;

    $usuBean = $usuario->c_buscar_usuario_por_email($email, 'S');
    
    // if (!password_verify($senha, $usuBean->getUsu_cpf())) {
         
    // }
    

//    if (is_null($usuBean->getUsu_email())) {
//        $_SESSION["MENSAGEM"] = 'este usuário não existe';
//        header("Location:" . $BASE_URL);
//        exit();
//    }
//
//    if (!password_verify($senha, $usuBean->getUsu_cpf())) {
//
//        $_SESSION['tentativas'] = (isset($_SESSION['tentativas'])) ? $_SESSION['tentativas'] += 1 : 1;
//        $bloqueado = ($_SESSION['tentativas'] == TENTATIVAS_ACEITAS) ? 'SIM' : 'NAO';
//
//        // Dica 7 - Grava a tentativa independente de falha ou não
//        $sql = 'INSERT INTO usuarios_login_tentativas (ip, email, senha, origem, bloqueado) VALUES (?, ?, ?, ?, ?)';
//        $stm = ConPDO::getInstance()->prepare($sql);
//        $stm->bindValue(1, $_SERVER['SERVER_ADDR']);
//        $stm->bindValue(2, $email);
//        $stm->bindValue(3, $senha);
//        $stm->bindValue(4, $_SERVER['HTTP_REFERER']);
//        $stm->bindValue(5, $bloqueado);
//        $stm->execute();
//        $total = TENTATIVAS_ACEITAS - $_SESSION['tentativas'];
//        $_SESSION["MENSAGEM"] = 'senha incorreta , você tem ' . $total . ' tentativas restantes';
//        header("Location:" . $BASE_URL);
//        exit();
//    }
    // passou no login e senha
    ////Mi liga 021 89 9 9411 1294
    //p8ii6hqf-denunc
    //60 = 1min
    //150 2,5min
    //300=5min
    //600=10min
    //1200=20 min 
    //2400=40 min
    //3600=1 hora
    //2700=45min  45min*60seg=2700    
    date_default_timezone_set('America/Sao_Paulo');
    $_SESSION["TEMPO_DA_SESSAO"] = 2000;
    $_SESSION["BASE_URL"] = '';
    $_SESSION["ultimoAcesso"] = date("Y-n-j H:i:s");
    $_SESSION["usu_codigo"] = $usuBean->getUsu_codigo();
    $_SESSION["usu_nome"] = $usuBean->getUsu_nome();
    $_SESSION["usu_numerocelular"] = $usuBean->getUsu_numerocelular();
    $_SESSION["usu_liberado"] = $usuBean->getUsu_liberado();
    $_SESSION["usu_email"] = $usuBean->getUsu_email();
    $_SESSION["usu_cpf"] = $usuBean->getUsu_cpf();
    $_SESSION["usu_celularkey"] = $usuBean->getUsu_celularkey();
    $_SESSION["ID_CPF_EMPRESA"] = $usuBean->getID_CPF_EMPRESA();


    // verificando se este login tem dias de acesso pra ser utilizado
    $empresa->C_atualiza_dias_licenca();
    $_POST["emp_celularkey"] = $usuBean->getUsu_celularkey();
    $empBean = $empresa->c_busca_empresa_por_emp_celularkey();
    $dias = Util::verifica_dias_acesso($empBean);

    if ($dias <= 0) {
        $_SESSION["MENSAGEM"] = 'Este login encontra-se SEM ACESSO AO SISTEMA a ' . -$dias . ' dia(s). Renove seu acesso em <a href=http://www.centralmetadevendas.com.br/licencas>http://www.centralmetadevendas.com.br/licencas</a> ';
        header("Location:" . BASE_URL);
        exit();
    }

    $log = new LogInstance();
    $log->c_inserir_log('LOGIN NO SISTEMA', 'LOGIN NO SISTEMA', $_SESSION["usu_numerocelular"], $_SESSION["usu_codigo"], date('Y-m-d H:i:s'), $_SESSION["usu_email"], $_SESSION["ID_CPF_EMPRESA"]);

    // as linhas abaixo serve para verificar se existe alguma nova tabela no banco de dados mas nao tem permissoes para ela
    //uma vez que a empresa ja se registrou
    // gravando o nome de alguma tabela caso haja alteração no banco de dados
    $tabela = new TabelasInstance();
    $tabelas_banco = new TabelasBean();

    // busca o nome das tabelas com show tables existentes no banco
    $tabelas_banco = $tabela->c_busca_todas_tabelas_do_banco();
    foreach ($tabelas_banco as $tbbanco) {

        $retorno = new TabelasBean();
        // verifica se esta tabela do show tables existe gravada na tabela de TABELAS
        $retorno = $tabela->c_verifica_se_tabela_existe($tbbanco);

        // se essa tabela nao existir na tabela de TABELAS entao gravo o nome dela
        if (is_null($retorno->getTabela_nome())) {
            $tabela->c_gravar_nome_das_tabelas(strtoupper($tbbanco));
        }
    }


    // busco o nome de todas as tabelas que foram gravadas atraves do show tables
    $tabelas_banco = $tabela->c_busca_nome_das_tabelas_gravadas();
    foreach ($tabelas_banco as $t) {


        // busco o nivel ja gravado para poder gravar e dar permissao com o mesmo nivel
        $permissaoBean = $permisao->C_buscarPermParaTabelaDe("empresa");
        $nivel_existente = $permissaoBean->getPer_nivel();

        //busco e verifico se existe alguma tabela que nao foi dada permissao 
        $nova_permisao = new PermissoesInstance();
        $permissaoBean = $nova_permisao->C_buscarPermParaTabelaDe($t->getTabela_nome());


        $novo_nivel = $permissaoBean->getPer_nivel();
        $nome_tabela = $t->getTabela_nome();

        // se $novo_nivel retornar vazio é por que essa tabela ($t->getTabela_nome()) nao existe na tabela de permissoes
        if ($novo_nivel == "") {

            if ($nivel_existente == "ADM") {
                $nova_permisao->c_gravaPermissao_quando_existe_criacao_de_NOVAS_tabelas_no_banco_de_dados(
                        "S", "S", "S", "N", $nome_tabela, $nivel_existente);
            }
            if ($nivel_existente == "USER") {
                $nova_permisao->c_gravaPermissao_quando_existe_criacao_de_NOVAS_tabelas_no_banco_de_dados(
                        "N", "N", "N", "N", $nome_tabela, $nivel_existente);
            }

            if ($nivel_existente == "DIRETOR") {
                $nova_permisao->c_gravaPermissao_quando_existe_criacao_de_NOVAS_tabelas_no_banco_de_dados(
                        "S", "S", "S", "S", $nome_tabela, $nivel_existente);
            }
        }
    }
    header("Location:view/loginadm.php");
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" >
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <link rel="icon" href="favicon.ico">
        <title>Login Platinum Web</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
        <link href="view/Assets/css/bootstrap.min.css" rel="stylesheet"> 
        <link rel="stylesheet" href="view/Assets/css/AdminLTE.min.css">
        <link rel="stylesheet" href="view/Assets/css/skin-blue.css">        
        <link href="view/Assets/css/sign.css" rel="stylesheet">

    </head>
    <body>
        <div class="container">

            <div class="row">
                <div class="col-sm-12">
                    <form class="form-signin" role="form" action="index.php" method="post">
                        <label for="inputEmail" class="sr-only">Email</label>
                        <input type="email" name="usu_email"  id="inputEmail" class="form-control" value="augustoall@gmail.com"  placeholder="Email" required autofocus>
                        <label for="inputPassword" class="sr-only">Senha</label>
                        <input type="password" value="81988029779"  name="usu_cpf" id="inputPassword" class="form-control" placeholder="Senha" required>
                        <button class="btn btn-lg btn-primary btn-block" type="submit">Entrar na Central</button>
                        <!-- p><a href="view/esqueciminhasenha.php"> esqueci minha senha</a></p -->
                    </form>
                    <?php
                    session_start();
                    if ($_SESSION["MENSAGEM"] != ""):
                        ?>
                        <div class="alert alert-info" role="alert">
                            <strong><?php
                                echo $_SESSION["MENSAGEM"]
                                ?>!</strong> 
                        </div>
                    <?php endif; ?>
                </div>

            </div>





        </div> 
    </body>
</html>
