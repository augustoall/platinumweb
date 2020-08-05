<?php

class EmpresaInstance {

    function __construct() {
        
    }

    public function C_atualiza_dias_licenca() {
        return EmpresaDao::getInstance()->M_atualiza_dias_licenca();
    }

    public function C_gravaEmpresa() {

        $data_usa = date('Y-m-d');
        $data_br = date('d/m/Y');

        list($dia, $mes, $ano) = explode('/', $data_br);
        $time = mktime(0, 0, 0, $mes, $dia + 10, $ano);
        $d = strftime('%d/%m/%Y', $time);
        list($day, $month, $year) = explode('/', $d);
        $var_data = $year . "-" . $month . "-" . $day;

        $empresa = new EmpresaBean();
        $empresa->setEmp_nome($_POST["emp_nome"]);
        $empresa->setEmp_cpf($_POST["emp_cpf"]);
        $empresa->setEmp_licenca($_POST["emp_licenca"]);
        $empresa->setEmp_fim($var_data);

        $empresa->setEmp_inicio(date('Y-m-d'));
        $empresa->setEmp_celularkey($_POST["emp_celularkey"]);
        $empresa->setUsu_codigo($_POST["usu_codigo"]);
        $empresa->setEmp_datapedido($data_usa);

        $empresa->setEmp_totalemdias(10);
        $empresa->setEmp_numerocelular($_POST["emp_numerocelular"]);
        $empresa->setEmp_email($_POST["emp_email"]);
        return EmpresaDao::getInstance()->M_gravaEmpresa($empresa);
    }

    public function c_atualiza_empresa_na_administracao() {

        $empresa = new EmpresaBean();
        $empresa->setEmp_codigo($_POST["emp_codigo"]);
        $empresa->setEmp_nome($_POST["emp_nome"]);
        $empresa->setEmp_cpf($_POST["emp_cpf"]);
        $empresa->setEmp_licenca($_POST["emp_licenca"]);
        $empresa->setEmp_fim(Util::format_AAAA_MM_DD($_POST["emp_fim"]));

        $empresa->setEmp_inicio(Util::format_AAAA_MM_DD($_POST["emp_inicio"]));
        $empresa->setEmp_celularkey($_POST["emp_celularkey"]);
        $empresa->setUsu_codigo($_POST["usu_codigo"]);
        $empresa->setEmp_datapedido(Util::format_AAAA_MM_DD($_POST["emp_datapedido"]));

        $empresa->setEmp_totalemdias($_POST["dias_restantes"]);
        $empresa->setEmp_numerocelular($_POST["emp_numerocelular"]);
        $empresa->setEmp_email($_POST["emp_email"]);
        return EmpresaDao::getInstance()->m_atualiza_empresa_na_administracao($empresa);
    }

    public function C_getEmpresaExistente() {
        $empresa = new EmpresaBean();
        $empresa->setEmp_celularkey($_POST["emp_celularkey"]);
        return EmpresaDao::getInstance()->M_getEmpresaWhereEmp_celularkeyReturn($empresa);
    }

    public function c_verifica_se_emp_celularkey_ja_se_registrou_uma_vez() {
        $empresa = new EmpresaBean();
        $empresa->setEmp_celularkey($_POST["emp_celularkey"]);
        return EmpresaDao::getInstance()->M_getEmpresaWhereEmp_celularkeyReturn($empresa);
    }

    public function c_busca_empresa_por_emp_celularkey() {
        $empresa = new EmpresaBean();
        $empresa->setEmp_celularkey($_POST["emp_celularkey"]);
        return EmpresaDao::getInstance()->m_busca_empresa_por_emp_celularkey($empresa);
    }

    public function c_busca_datas_de_validades_diretor($emp_celularkey) {
        $empresa = new EmpresaBean();
        $empresa->setEmp_celularkey($emp_celularkey);
        return EmpresaDao::getInstance()->m_busca_empresa_por_emp_celularkey($empresa);
    }

    public function c_busca_datas_de_validades() {
        $empresa = new EmpresaBean();
        $empresa->setEmp_celularkey($_SESSION["usu_celularkey"]);
        return EmpresaDao::getInstance()->m_busca_empresa_por_emp_celularkey($empresa);
    }

    public function c_acrescenta_dias_de_acesso_em_licenca_vencida($dias_acrescimo) {


        // este metodo acrescenda 30 dias reais caso a licenca do cliente esteja
        // muito vencida e a funcao  $dias = retornadias();  retorne  -1 , ou dias negativos
        // nao podendo ser somadas com o dia de acrescimo
        // pega valor de $emp->getEmp_inicio()


        $empresa = new EmpresaBean();
        $emp = new EmpresaBean();
        $empresa->setEmp_celularkey($_POST["emp_celularkey"]);
        $emp = EmpresaDao::getInstance()->M_getEmpresaWhereEmp_celularkeyReturn($empresa);

        list($ano_ano, $mes_do_ano, $dia_do_ano) = explode('-', $emp->getEmp_inicio());
        $nova_data_br = $dia_do_ano . "/" . $mes_do_ano . "/" . $ano_ano;

        list($dia, $mes, $ano) = explode('/', $nova_data_br);

        $time = mktime(0, 0, 0, $mes, $dia + $dias_acrescimo, $ano);
        $d = strftime('%d/%m/%Y', $time);
        list($day, $month, $year) = explode('/', $d);

        $nova_data_de_validade = $year . "-" . $month . "-" . $day;
        $empresa->setNewkey($_POST['newkey']);
        $empresa->setNewdatevalidate($nova_data_de_validade);
        return EmpresaDao::getInstance()->M_updateKeyEmp($empresa);
    }

    public function C_acrescenta_dias_de_acesso($dias_acrescimo) {

        // metodo usado caso o cliente ainda tem dias para serem usados > 0 , ou seja
        // o sistema vai pegar a quantidad de dias que restam para o cliente usar
        // e somar com a variavel $dias_acrescimo
        // pega valor de  $emp->getEmp_fim()

        $empresa = new EmpresaBean();
        $emp = new EmpresaBean();
        $empresa->setEmp_celularkey($_POST["emp_celularkey"]);
        $emp = EmpresaDao::getInstance()->M_getEmpresaWhereEmp_celularkeyReturn($empresa);

        list($ano_ano, $mes_do_ano, $dia_do_ano) = explode('-', $emp->getEmp_fim());
        $nova_data_br = $dia_do_ano . "/" . $mes_do_ano . "/" . $ano_ano;

        list($dia, $mes, $ano) = explode('/', $nova_data_br);

        $time = mktime(0, 0, 0, $mes, $dia + $dias_acrescimo, $ano);
        $d = strftime('%d/%m/%Y', $time);
        list($day, $month, $year) = explode('/', $d);

        $nova_data_de_validade = $year . "-" . $month . "-" . $day;
        $empresa->setNewkey($_POST['newkey']);
        $empresa->setNewdatevalidate($nova_data_de_validade);
        return EmpresaDao::getInstance()->M_updateKeyEmp($empresa);
    }

    public function C_updateEmp_celularkey() {
        $empresa = new EmpresaBean();
        $empresa->setEmp_celularkey($_POST["emp_celularkey"]);
        $empresa->setNewkey($_POST['newkey']);
        return EmpresaDao::getInstance()->M_updateEmp_celularkey($empresa);
    }

    public function C_verifica_se_cpf_empresa_ja_existe() {
        $empresa = new EmpresaBean();
        $empresa->setEmp_cpf($_POST["emp_cpf"]);
        return EmpresaDao::getInstance()->M_verifica_se_cpf_empresa_ja_existe($empresa);
    }

    public function c_bsuca_empresa_por_codigo() {
        $empresa = new EmpresaBean();
        $empresa->setEmp_codigo($_GET["emp_codigo"]);
        return EmpresaDao::getInstance()->m_bsuca_empresa_por_codigo($empresa);
    }

    public function C_verifica_se_cpf_empresa_diretor_ja_existe() {
        $empresa = new EmpresaBean();
        $empresa->setEmp_cpf($_POST["emp_cpf"]);
        return EmpresaDao::getInstance()->M_verifica_se_cpf_empresa_diretor_ja_existe($empresa);
    }

    public function c_bsuca_todas_empresas_para_administracao() {
        return EmpresaDao::getInstance()->m_bsuca_todas_empresas_para_administracao();
    }

    public function c_busca_empresa_por_ID_CPF_EMPRESA($ID_CPF_EMPRESA) {
        return EmpresaDao::getInstance()->m_busca_empresa_por_ID_CPF_EMPRESA($ID_CPF_EMPRESA);
    }

    public function c_busca_dias_de_acesso_empresa_DATEDIFF($emp_celularkey) {
        return EmpresaDao::getInstance()->m_busca_dias_de_acesso_empresa_DATEDIFF($emp_celularkey);
    }

}

?>
