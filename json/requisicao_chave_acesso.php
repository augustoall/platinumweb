<?php

header('Content-Type: text/html; charset=UTF-8');
error_reporting(E_ALL ^ E_NOTICE);


require_once '../includes/load__class__file_path_1.php';

$empresa = new EmpresaInstance();
$empBean = new EmpresaBean();
$usuario = new UsuariosInstance();
$usuarioBean = new UsuariosBean();
$empresa = new EmpresaInstance();

$chlicencaBean = new ChaveLicencaBean();
$chave_licenca = new ChaveLicencaInstance();

$reativar = $_POST["reativar"];


if ($reativar == "N") {

    $licenca_enviada_cliente = $_POST['key_existing'];
    $empresa->C_atualiza_dias_licenca();
    $empBean = $empresa->C_getEmpresaExistente();

    if (!is_null($empBean->getEmp_codigo())) {

        $dias = retornadias();

		// QUANDO OS DIAS FOREM MENOR QUE 0
        if ($dias <= 0) {

            //se a licenca que a central mandou é igual a licenca gravada no banco
            if ($licenca_enviada_cliente == $empBean->getEmp_licenca()) {

                // buscando a chave em nossa base de dados
                $chlicencaBean = $chave_licenca->c_busca_chave_licenca_nao_usada($licenca_enviada_cliente);
                
               

                if (!is_null($chlicencaBean->getLic_dias())) {


                    // coloca dias a serem usados, neste ponto o cliente nao TINHA dias pra usar     
                    $resultado_update = $empresa->c_acrescenta_dias_de_acesso_em_licenca_vencida($chlicencaBean->getLic_dias());

                    $dias = retornadias();

                    if ($resultado_update > 0) {

                        // atualiza a chave pra ficar usada
                        $chave_licenca->c_atualiza_chave($licenca_enviada_cliente, 'LICENCA USADA POR :: ' . $empBean->getEmp_numerocelular() . ' - ' . $empBean->getEmp_email() . ' - ' . $empBean->getEmp_nome());

                        //atualiza e da acesso ao usuario novamente no site
                        $usuario->c_LiberaAcessoSite("S");
                        $dias = retornadias();
                        $resposta["sucesso"] = 20;
                        $resposta["mensagem"] = "chave de acesso atualizada";
                        $resposta["dias"] = $dias;
                        echo json_encode($resposta);
                    } else {
                        $usuario->C_liberaAcessoSite("N");
                        $dias = retornadias();
                        $resposta["sucesso"] = 30;
                        $resposta["mensagem"] = "erro ao atualizar a licenca";
                        $resposta["dias"] = $dias;
                        echo json_encode($resposta);
                    }
                }
            } else {
                $usuario->C_liberaAcessoSite("N");
                $dias = retornadias();
                $resposta["sucesso"] = 40;
                $resposta["mensagem"] = "chave nao confere";
                $resposta["dias"] = $dias;
                echo json_encode($resposta);
            }
        }



		// QUANDO OS DIAS FOREM MAIOR QUE 0
        if ($dias > 0) {

            if ($licenca_enviada_cliente == $empBean->getEmp_licenca()) {


                $chlicencaBean = $chave_licenca->c_busca_chave_licenca_nao_usada($licenca_enviada_cliente);


                if (!is_null($chlicencaBean->getLic_dias())) {

                    // pega os dias que o cliente ainda tem pra usar e soma + $chlicencaBean->getLic_dias()
                    $resultado_update = $empresa->C_acrescenta_dias_de_acesso($chlicencaBean->getLic_dias());

                    if ($resultado_update > 0) {

                        // atualiza a chave pra ficar usada
                        $chave_licenca->c_atualiza_chave($licenca_enviada_cliente, 'LICENCA USADA POR :: ' . $empBean->getEmp_numerocelular() . ' - ' . $empBean->getEmp_email() . ' - ' . $empBean->getEmp_nome());

                        $dias = retornadias();
                        $resposta["sucesso"] = 50;
                        $resposta["mensagem"] = "licenca com novo vencimento para " . $dias . " dias";
                        $resposta["dias"] = $dias;
                        echo json_encode($resposta);
                    } else {
                        $dias = retornadias();
                        $resposta["sucesso"] = 60;
                        $resposta["mensagem"] = "erro ao atualizar a licenca";
                        $resposta["dias"] = $dias;
                        echo json_encode($resposta);
                    }
                }
            } else {
                $dias = retornadias();
                $resposta["sucesso"] = 70;
                $resposta["mensagem"] = "a chave nao confere";
                $resposta["dias"] = $dias;
                echo json_encode($resposta);
            }
        }
    } else {

        $resposta["sucesso"] = 80;
        $resposta["mensagem"] = "empresa nao cadastrada";
        $resposta["dias"] = 0;
        echo json_encode($resposta);
    }
}




//QUANDO O USUARIO DESINSTALA O APLICATIVO ANDROID


/*
 * 
 *  QUANDO O USUARIO DESINSTALA O APP 
 * 
 *  1 - ELE PODE TER DIAS PRA USAR AINDA
 * 
 *  2 - OS DIAS DELE ACABOU* 
 * 
 * 
 * 
 */




if ($reativar == "S") {

    $licenca_enviada_cliente = $_POST['key_existing'];
    $empBean = $empresa->C_getEmpresaExistente();
    $empresa->C_atualiza_dias_licenca();

    if (!is_null($empBean->getEmp_codigo())) {

        $dias = retornadias();


        // IF DIAS <= 0  OU IF DIAS > 0 LINHA 186
        if ($dias <= 0) {

            //aqui a licenca ja acabou
            if ($licenca_enviada_cliente == $empBean->getEmp_licenca()) {

                $chlicencaBean = $chave_licenca->c_busca_chave_licenca_nao_usada($licenca_enviada_cliente);

                if (!is_null($chlicencaBean->getLic_dias())) {

                    //recebi a licenca que eu mesmo enviei pro cliente $licenca_enviada_cliente
                    $resultado_update = $empresa->c_acrescenta_dias_de_acesso_em_licenca_vencida($chlicencaBean->getLic_dias());

                    if ($resultado_update > 0) {

                        // atualiza a chave pra ficar usada
                        $chave_licenca->c_atualiza_chave($licenca_enviada_cliente, 'LICENCA USADA POR :: ' . $empBean->getEmp_numerocelular() . ' - ' . $empBean->getEmp_email() . ' - ' . $empBean->getEmp_nome());


                        // REATIVAR =  SIM
                        //***********************************************************************************
                        // só tem 1 usuario com este emp_celularkey , entao pegar o codigo dele e colocar no vendedor no celular   
                        $usuarioBean = $usuario->c_BuscaUsu_CodigoPor_Celularkey_Para_ReativarCelularDesinstalado();
                        //***********************************************************************************
                        //atualiza e da acesso ao usuario novamente no site
                        $usuario->C_liberaAcessoSite("S");
                        $dias = retornadias();
                        $resposta["sucesso"] = 20;
                        $resposta["mensagem"] = "chave de acesso atualizada";
                        $resposta["emp_cpf"] = $empBean->getEmp_cpf();
                        $resposta["emp_numerocelular"] = $empBean->getEmp_numerocelular();
                        $resposta["emp_email"] = $empBean->getEmp_email();
                        $resposta["dias"] = $dias;
                        // repassando o codigo do vendedor pro celular
                        $resposta["usu_codigo"] = $usuarioBean->getUsu_codigo();


                        echo json_encode($resposta);
                    } else {
                        $usuario->C_liberaAcessoSite("N");
                        $dias = retornadias();
                        $resposta["sucesso"] = 30;
                        $resposta["mensagem"] = "erro ao atualizar a licenca";
                        $resposta["emp_cpf"] = "";
                        $resposta["emp_numerocelular"] = "";
                        $resposta["emp_email"] = "";
                        $resposta["dias"] = $dias;
                        echo json_encode($resposta);
                    }
                }
            } else {
                $usuario->C_liberaAcessoSite("N");
                $dias = retornadias();
                $resposta["sucesso"] = 40;
                $resposta["mensagem"] = "chave nao confere";
                $resposta["emp_cpf"] = "";
                $resposta["emp_numerocelular"] = "";
                $resposta["emp_email"] = "";
                $resposta["dias"] = $dias;
                echo json_encode($resposta);
            }
        } else {

            // NAO PODE SER ENVIADA UMA CHAVE PRO CLIENTE NESTE CASO 
            // POR QUE ELE AINDA TEM DIAS PRA USAR A APP.
            // $licenca_enviada_cliente = $_POST['key_existing']; <<<<<<< NAO PODE SER COMPARADA ASSIM
            // caso tenha desinstalado a app mas ainda consta dias pra uso da licenca

            if ($_POST["emp_celularkey"] == $empBean->getEmp_celularkey()) {

                //atualiza e da acesso ao usuario novamente no site
                $dias = retornadias();
                $resultado_update = $empresa->C_updateEmp_celularkey();

                if ($resultado_update > 0) {

                    // REATIVAR =  SIM
                    //***********************************************************************************
                    // só tem 1 usuario com este emp_celularkey , entao pegar o codigo dele e colocar no vendedor no celular   
                    $usuarioBean = $usuario->c_BuscaUsu_CodigoPor_Celularkey_Para_ReativarCelularDesinstalado();
                    //***********************************************************************************

                    $usuario->C_liberaAcessoSite("S");
                    $resposta["sucesso"] = 50;
                    $resposta["mensagem"] = "chave de acesso atualizada";
                    $resposta["emp_cpf"] = $empBean->getEmp_cpf();
                    $resposta["emp_numerocelular"] = $empBean->getEmp_numerocelular();
                    $resposta["emp_email"] = $empBean->getEmp_email();
                    $resposta["dias"] = $dias;
                    $resposta["usu_codigo"] = $usuarioBean->getUsu_codigo();

                    echo json_encode($resposta);
                } else {
                    $usuario->C_liberaAcessoSite("N");

                    $resposta["sucesso"] = 30;
                    $resposta["mensagem"] = "erro ao atualizar a licenca";
                    $resposta["emp_cpf"] = "";
                    $resposta["emp_numerocelular"] = "";
                    $resposta["emp_email"] = "";
                    $resposta["dias"] = $dias;
                    echo json_encode($resposta);
                }
            } else {
                $usuario->C_liberaAcessoSite("N");

                $resposta["sucesso"] = 60;
                $resposta["mensagem"] = "celular desconhecido";
                $resposta["emp_cpf"] = "";
                $resposta["emp_numerocelular"] = "";
                $resposta["emp_email"] = "";
                $resposta["dias"] = $dias;
                echo json_encode($resposta);
            }
        }
    } else {

        $resposta["sucesso"] = 70;
        $resposta["mensagem"] = "celular sem registro";
        $resposta["emp_cpf"] = "";
        $resposta["emp_numerocelular"] = "";
        $resposta["emp_email"] = "";
        $resposta["dias"] = 0;
        echo json_encode($resposta);
    }
}

function retornadias() {

    $empBean = new EmpresaBean();
    $empresa = new EmpresaInstance();
    $empBean = $empresa->c_busca_empresa_por_emp_celularkey();
    $time_inicial = strtotime($empBean->getEmp_inicio());
    $time_final = strtotime($empBean->getEmp_fim());
    $diferenca = $time_final - $time_inicial;
    $dias = (int) floor($diferenca / (60 * 60 * 24));
    return $dias;
}
?>


