<?php

class UsuariosInstance {

    function __construct() {
        
    }

    public function c_GravarUsuario($ID_CPF_EMPRESA) {
        $usuario = new UsuariosBean ();
        $usuario->setUsu_dispositivo($_POST ["usu_dispositivo"]);
        $usuario->setUsu_desconto($_POST["usu_desconto"]);
        $usuario->setUsu_nome(Util::remover_letra_acentuada($_POST ["usu_nome"]));
        $usuario->setUsu_comissao($_POST["usu_comissao"]);
        $usuario->setUsu_email(Util::remover_letra_acentuada($_POST["usu_email"]));
        $usuario->setUsu_cpf($_POST["usu_cpf"]);
        $usuario->setUsu_codigo($_POST["usu_codigo"]);
        $usuario->setID_CPF_EMPRESA($ID_CPF_EMPRESA);
        return UsuariosDao::getInstance()->m_GravarUsuario($usuario);
    }

    public function c_AtualizaUsuario($ID_CPF_EMPRESA) {
        $usuario = new UsuariosBean ();
        $usuario->setID_CPF_EMPRESA($ID_CPF_EMPRESA);
        $usuario->setUsu_codigo($_POST["usu_codigo"]);
        $usuario->setUsu_nome(Util::remover_letra_acentuada($_POST ["usu_nome"]));
        $usuario->setUsu_dispositivo($_POST["usu_dispositivo"]);
        $usuario->setUsu_desconto($_POST["usu_desconto"]);
        $usuario->setUsu_comissao($_POST["usu_comissao"]);
        $usuario->setUsu_email(Util::remover_letra_acentuada($_POST["usu_email"]));
        $usuario->setUsu_cpf(password_hash($_POST["usu_cpf"], PASSWORD_DEFAULT));
        return UsuariosDao::getInstance()->m_AtualizaUsuario($usuario);
    }

    public function c_LiberaAcessoSite($acesso) {
        $usuario = new UsuariosBean ();
        $usuario->setID_CPF_EMPRESA($_POST ["emp_cpf"]);
        $usuario->setUsu_celularkey($_POST ["emp_celularkey"]);
        $usuario->setUsu_liberado($acesso);
        return UsuariosDao::getInstance()->m_LiberaAcessoSite($usuario);
    }

    public function c_valirdarUsuario($email, $senha, $usu_liberado) {
        $usuario = new UsuariosBean ();
        $usuario->setUsu_cpf($senha);
        $usuario->setUsu_email($email);
        $usuario->setUsu_liberado($usu_liberado);
        return UsuariosDao::getInstance()->m_ValidarUsuario($usuario);
    }

    public function c_buscar_email_esqueci_minha_senha() {
        $usuario = new UsuariosBean ();
        $usuario->setUsu_email($_POST ["usu_email"]);
        return UsuariosDao::getInstance()->m_buscar_email_esqueci_minha_senha($usuario);
    }

    public function c_buscar_usuario_por_email($usu_email, $liberado) {
        return UsuariosDao::getInstance()->m_buscar_usuario_por_email($usu_email, $liberado);
    }

    public function c_buscarUsuariosLiberados($ID_CPF_EMPRESA, $usu_liberado) {
        $usuario = new UsuariosBean ();
        $usuario->setUsu_liberado($usu_liberado);
        $usuario->setID_CPF_EMPRESA($ID_CPF_EMPRESA);
        return UsuariosDao::getInstance()->m_buscarUsuariosLiberados($usuario);
    }

    public function c_busca_usuario_por_nome($ID_CPF_EMPRESA, $usu_nome) {
        $usuario = new UsuariosBean ();
        $usuario->setUsu_nome($usu_nome);
        $usuario->setID_CPF_EMPRESA($ID_CPF_EMPRESA);
        return UsuariosDao::getInstance()->m_busca_usuario_por_nome($usuario);
    }

    public function c_BuscaUsuarioPorCodigo($ID_CPF_EMPRESA) {
        $usuario = new UsuariosBean ();
        $usuario->setID_CPF_EMPRESA($ID_CPF_EMPRESA);
        $usuario->setUsu_codigo($_GET ["usu_codigo"]);
        return UsuariosDao::getInstance()->m_BuscaUsuarioPorCodigo($usuario);
    }

    public function c_BuscarUsuarioPorCodigo($ID_CPF_EMPRESA, $usu_codigo) {
        $usuario = new UsuariosBean ();
        $usuario->setID_CPF_EMPRESA($ID_CPF_EMPRESA);
        $usuario->setUsu_codigo($usu_codigo);
        return UsuariosDao::getInstance()->m_BuscaUsuarioPorCodigo($usuario);
    }

    public function c_BuscaUsuarioPor_usu_celularkey() {
        $usuario = new UsuariosBean ();
        $usuario->setID_CPF_EMPRESA($_POST["emp_cpf"]);
        $usuario->setUsu_celularkey($_POST["emp_celularkey"]);
        return UsuariosDao::getInstance()->m_BuscaUsuarioPor_usu_celularkey($usuario);
    }

    public function c_busca_usuario_por_celkey($usu_celularkey) {
        return UsuariosDao::getInstance()->m_busca_usuario_por_celkey($usu_celularkey);
    }

    public function c_BuscaUsuarioPor_usu_cel_key($ID_CPF_EMPRESA, $EMP_CELULARKEY) {
        $usuario = new UsuariosBean ();
        $usuario->setID_CPF_EMPRESA($ID_CPF_EMPRESA);
        $usuario->setUsu_celularkey($EMP_CELULARKEY);
        return UsuariosDao::getInstance()->m_BuscaUsuarioPor_usu_celularkey($usuario);
    }

    public function c_BuscaUsu_CodigoPor_Celularkey_Para_ReativarCelularDesinstalado() {
        $usuario = new UsuariosBean ();
        $usuario->setUsu_celularkey($_POST["emp_celularkey"]);
        return UsuariosDao::getInstance()->m_BuscaUsu_CodigoPor_Celularkey_Para_ReativarCelularDesinstalado($usuario);
    }

    public function c_GravaUsuarioJsoN_No_Registro_da_Empresa() {
        $usuario = new UsuariosBean ();
        $usuario->setUsu_nome($_POST["nome_vendedor"]);
        $usuario->setUsu_email($_POST["emp_email"]);
        $usuario->setUsu_celularkey($_POST["emp_celularkey"]);
        $usuario->setUsu_numerocelular($_POST["emp_numerocelular"]);
        // gravando a senha do usuario com password_hash
        $usuario->setUsu_cpf(password_hash($_POST["emp_cpf"], PASSWORD_DEFAULT));
        $usuario->setUsu_dispositivo("MARCA_DO_SEU_CELULAR");
        $usuario->setUsu_liberado("S");
        $usuario->setUsu_desconto(0);
        $usuario->setUsu_comissao(0);
        $usuario->setID_CPF_EMPRESA($_POST["emp_cpf"]);
        return UsuariosDao::getInstance()->m_GravarUsuario($usuario);
    }

    public function c_listar_todos_usuarios_para_diretor() {
        return UsuariosDao::getInstance()->m_listar_todos_usuarios_para_diretor();
    }

    public function c_busca_dados_vendedor() {
        $usuario = new UsuariosBean ();
        $usuario->setUsu_celularkey($_POST["emp_celularkey"]);
        return UsuariosDao::getInstance()->m_busca_dados_vendedor($usuario);
    }

}

?>