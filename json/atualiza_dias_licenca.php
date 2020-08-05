<?php

// este arquivo é responsavel em atualizar os dias de licenca no dispositivo
// este arquivo calcula a diferença entre as data de inicio e fim e manda este
// resultado para o android e liberando acesso do usuario no site.

if (isset($_POST['emp_celularkey'])) {

    error_reporting(E_ALL ^ E_NOTICE);
    require_once '../includes/load__class__file_path_1.php';
    
    
    $empresa = new EmpresaInstance();
    $empBean = new EmpresaBean();
    $usuario = new UsuariosInstance();
    $empresa->C_atualiza_dias_licenca();

    $empBean = $empresa->C_getEmpresaExistente();

    if (!is_null($empBean->getEmp_codigo())) {
        $dias = retornadias();

        if ($dias > 0) {
            $usuario->C_liberaAcessoSite("S");
            $resposta["dias"] = $dias;
        }

        if ($dias <= 0) {
            $usuario->C_liberaAcessoSite("N");
            $resposta["dias"] = $dias;
        }

        echo json_encode($resposta);
    } else {

        $resposta["dias"] = 0;
        echo json_encode($resposta);
    }
} else {
    $resposta["dias"] = 20;
    echo json_encode($resposta);
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


