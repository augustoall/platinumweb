<?php
if (isset($_POST["emp_nome"]) &&
        isset($_POST["emp_cpf"]) &&
        isset($_POST["emp_licenca"]) &&
        isset($_POST["nome_vendedor"]) &&
        isset($_POST["emp_celularkey"]) &&
        isset($_POST["emp_numerocelular"]) &&
        isset($_POST["emp_email"])) {
    
    
    require_once '../includes/load__class__file_path_1.php';
    $usuario = new UsuariosInstance();
    $empresa = new EmpresaInstance();
    $tabelas = new TabelasInstance();
    $empBean = new EmpresaBean();
    $permissoes = new PermissoesInstance();
    $firebase = new FirebaseInstance();
    


// CADASTRA TABELAS PARA AS PERMISSOES
    cadastra_tabelas_para_atribuir_permissoes();

// VERIFICANDO SE O KEY SERIAL DESTE CELULAR SE ENCONTRA REGISTRADO NA WEB
    $empBean = $empresa->c_verifica_se_emp_celularkey_ja_se_registrou_uma_vez();
    if (!is_null($empBean->getEmp_codigo())) {
        $empresa->C_atualiza_dias_licenca();
        $resposta["sucesso"] = 1;
        $resposta["mensagem"] = "ja registrado atualize sua licenca";
        echo json_encode($resposta);
    } else {


        // VERIFICA SE O NUMERO DE CPF JA EXISTE REGISTRADO NA WEB
        $empBean = $empresa->C_verifica_se_cpf_empresa_ja_existe();

        $resultado_gravacao_empresa = $empresa->C_gravaEmpresa();
        $resultado_gravacao_usuario = $usuario->c_GravaUsuarioJsoN_No_Registro_da_Empresa();

        // quando instala o app o ID_CPF_EMPRESA é gravado como  0000000 em get_device_id_firebase.php
        $firebase->c_atualiza_ID_CPF_EMPRESA_firebase($_POST["emp_cpf"],$_POST["emp_celularkey"]);
        
        $tab = new TabelasBean();

        // ASSUMINDO QUE UMA EMPRESA PODE TER VARIOS VENDEDORES , O PRIMEIRO CPF QUE SE 
        // REGISTRAR PASSARA A TER A PERMISSAO DE ADMINISTRADOR E PODERA ATRIBUIR PERMISSOES
        // DE EXCLUIR OU ALTERAR OU CADASTRAR 
        // SE A EMPRESA SE REGISTRAR POR MAIS DE UMA VEZ COM O MESMO NUMERO DE CPF , ENTAO 
        // ESTE SEGUNDO USUARIO PASSARA A TER PERMISSAO DE USUARIO E TERA PERMISSAO APENAS PARA VER ALGUNS REGISTROS

        if (is_null($empBean->getEmp_codigo())) {
            // ATRIBUI PERMISSAO DE ADMINISTRADOR(ADM) E A PRIMEIRA VEZ QUE REGISTRA
            $tab = $tabelas->c_busca_nome_das_tabelas_gravadas();
            foreach ($tab as $t) {
                $permissoes->c_gravaPermissao($t->getTabela_nome(), "ADM");
            }
        } else {
            // ATRIBUI PERMISSAO DE USUARIO(USER) POIS JA EXISTE O MESMO CPF CADASTRADO
            $tab = $tabelas->c_busca_nome_das_tabelas_gravadas();
            foreach ($tab as $t) {
                $permissoes->C_grava_nova_Permissao_se_cpf_empresa_ja_existe($t->getTabela_nome(), "N", "N", "N", "N", "USER");
            }
        }

        if (($resultado_gravacao_empresa) && ($resultado_gravacao_usuario)) {
            $dias = retornadias();
            
                      // buscar este usuario que foi gravado agora $_POST["emp_celularkey"]
            $usuarioBean = new UsuariosBean();
            $usuarioBean = $usuario->c_BuscaUsuarioPor_usu_celularkey();

            $resposta["usuario_array"] = array();

            $c = array();
            $c["usu_codigo"] = $usuarioBean->getUsu_codigo();
            $c["nome_vendedor"] = $usuarioBean->getUsu_nome();
            $c["usu_desconto"] = $usuarioBean->getUsu_desconto();
            array_push($resposta["usuario_array"], $c);

            $resposta ["sucesso"] = 2;
            $resposta["mensagem"] = "faltam " . $dias . " dias para terminar sua licenca";
            echo json_encode($resposta);          
        } else {
            $resposta["sucesso"] = 3;
            $resposta["mensagem"] = "Erro ao tentar gravar a [[ empresa ou usuario ]] em registra_empresa.php ";
            echo json_encode($resposta);
        }
    }
} else {
    $resposta["sucesso"] = 5;
    $resposta["mensagem"] = "parametros nao identificados ";
    echo json_encode($resposta);
}

function cadastra_tabelas_para_atribuir_permissoes() {
    $tabela = new TabelasInstance();
    $tabelas_banco = new TabelasBean();

    $tabelas_banco = $tabela->c_busca_todas_tabelas_do_banco();
    foreach ($tabelas_banco as $tbbanco) {

        $retorno = new TabelasBean();
        $retorno = $tabela->c_verifica_se_tabela_existe($tbbanco);

        if (is_null($retorno->getTabela_nome())) {
            $tabela->c_gravar_nome_das_tabelas(strtoupper($tbbanco));
        }
    }
}

function retornadias() {

    $empBean = new EmpresaBean();
    $emp = new EmpresaInstance();
    $empBean = $emp->c_busca_empresa_por_emp_celularkey();
    $time_inicial = strtotime($empBean->getEmp_inicio());
    $time_final = strtotime($empBean->getEmp_fim());
    $diferenca = $time_final - $time_inicial;
    $dias = (int) floor($diferenca / (60 * 60 * 24));
    return $dias;
}
?>


