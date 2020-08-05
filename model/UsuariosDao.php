<?php

class UsuariosDao {

    public static $instance;

    public function __construct() {
        
    }

    static public function getInstance() {
        if (!isset(self::$instance))
            self::$instance = new UsuariosDao ();
        return self::$instance;
    }

    public function m_GravarUsuario(UsuariosBean $usuario) {
        try {

            $sql = "insert into usuarios (
            usu_nome, usu_email,usu_celularkey, 
            usu_numerocelular, usu_cpf,usu_dispositivo, 
            usu_liberado, usu_desconto,usu_comissao, 
            ID_CPF_EMPRESA) values (
            :usu_nome, :usu_email,:usu_celularkey, 
            :usu_numerocelular, :usu_cpf, 
            :usu_dispositivo, :usu_liberado,:usu_desconto, 
            :usu_comissao,:ID_CPF_EMPRESA) ";

            $statement_sql = ConPDO::getInstance()->prepare($sql);
            $statement_sql->bindValue(":usu_nome", $usuario->getUsu_nome());
            $statement_sql->bindValue(":usu_email", $usuario->getUsu_email());
            $statement_sql->bindValue(":usu_celularkey", $usuario->getUsu_celularkey());
            $statement_sql->bindValue(":usu_numerocelular", $usuario->getUsu_numerocelular());
            $statement_sql->bindValue(":usu_cpf", $usuario->getUsu_cpf());
            $statement_sql->bindValue(":usu_dispositivo", $usuario->getUsu_dispositivo());
            $statement_sql->bindValue(":usu_liberado", $usuario->getUsu_liberado());
            $statement_sql->bindValue(":usu_desconto", $usuario->getUsu_desconto());
            $statement_sql->bindValue(":usu_comissao", $usuario->getUsu_comissao());
            $statement_sql->bindValue(":ID_CPF_EMPRESA", $usuario->getID_CPF_EMPRESA());

            return $statement_sql->execute();
        } catch (PDOException $e) {
            print "[[   Erro em m_GravarUsuario :: " . $e->getMessage() . "   ]]    ";
        }
    }

    public function m_AtualizaUsuario(UsuariosBean $usuario) {
        try {

            $sql = " update usuarios set
                     usu_nome = :usu_nome ,
                     usu_dispositivo = :usu_dispositivo ,
                     usu_desconto = :usu_desconto ,
                     usu_comissao = :usu_comissao  ,
                     usu_email = :usu_email ,
                     usu_cpf = :usu_cpf
                     where  ID_CPF_EMPRESA = :ID_CPF_EMPRESA and usu_codigo = :usu_codigo  ";

            $statement_sql = ConPDO::getInstance()->prepare($sql);
            $statement_sql->bindValue(":usu_nome", $usuario->getUsu_nome());
            $statement_sql->bindValue(":usu_dispositivo", $usuario->getUsu_dispositivo());
            $statement_sql->bindValue(":usu_desconto", $usuario->getUsu_desconto());
            $statement_sql->bindValue(":usu_comissao", $usuario->getUsu_comissao());
            $statement_sql->bindValue(":usu_email", $usuario->getUsu_email());
            $statement_sql->bindValue(":usu_cpf", $usuario->getUsu_cpf());

            $statement_sql->bindValue(":ID_CPF_EMPRESA", $usuario->getID_CPF_EMPRESA());
            $statement_sql->bindValue(":usu_codigo", $usuario->getUsu_codigo());

            return $statement_sql->execute();
        } catch (PDOException $e) {
            print "[[   Erro em m_AtualizaUsuario :: " . $e->getMessage() . "  ]]  ";
        }
    }

    public function m_listar_todos_usuarios_para_diretor() {
        try {
            $sql = "select * from usuarios";
            $statement_sql = ConPDO::getInstance()->prepare($sql);
            $statement_sql->execute();

            return $this->m_Fetch_Array_Usuarios($statement_sql);
        } catch (PDOException $e) {
            print "[[   Erro em m_buscarUsuariosLiberados :: " . $e->getMessage() . "   ]]  ";
        }
    }

    public function m_buscarUsuariosLiberados(UsuariosBean $usuario) {
        try {
            $sql = "select * from usuarios  where  ID_CPF_EMPRESA=? and usu_liberado=?";
            $statement_sql = ConPDO::getInstance()->prepare($sql);
            $statement_sql->bindValue(1, $usuario->getID_CPF_EMPRESA());
            $statement_sql->bindValue(2, $usuario->getUsu_liberado());
            $statement_sql->execute();
            return $this->m_Fetch_Array_Usuarios($statement_sql);
        } catch (PDOException $e) {
            print "[[   Erro em m_buscarUsuariosLiberados :: " . $e->getMessage() . "   ]]  ";
        }
    }

    public function m_BuscaUsuarioPorCodigo(UsuariosBean $usuario) {
        try {
            $sql = "select * from usuarios where ID_CPF_EMPRESA=? and usu_codigo=?";
            $statement_sql = ConPDO::getInstance()->prepare($sql);
            $statement_sql->bindValue(1, $usuario->getID_CPF_EMPRESA());
            $statement_sql->bindValue(2, $usuario->getUsu_codigo());
            $statement_sql->execute();
            return $this->m_Popula_Usuario($statement_sql->fetch(PDO::FETCH_ASSOC));
        } catch (PDOException $e) {
            print "[[   Erro em m_BuscaUsuarioPorCodigo :: " . $e->getMessage() . "   ]]  ";
        }
    }

    public function m_BuscaUsuarioPor_usu_celularkey(UsuariosBean $usuario) {
        try {

            $sql = "select usu_codigo,usu_nome, usu_email,usu_celularkey,usu_numerocelular, usu_cpf,usu_dispositivo,
            usu_liberado, usu_desconto,usu_comissao, ID_CPF_EMPRESA from usuarios  where  ID_CPF_EMPRESA=:ID_CPF_EMPRESA and usu_celularkey=:usu_celularkey ";
            $statement_sql = ConPDO::getInstance()->prepare($sql);

            $statement_sql->bindValue(":ID_CPF_EMPRESA", $usuario->getID_CPF_EMPRESA());
            $statement_sql->bindValue(":usu_celularkey", $usuario->getUsu_celularkey());

            $statement_sql->execute();
            return $this->m_Popula_Usuario($statement_sql->fetch(PDO::FETCH_ASSOC));
        } catch (PDOException $e) {
            print "[[   Erro em m_BuscaUsuarioPor_usu_celularkey :: " . $e->getMessage() . "   ]] ";
        }
    }

    public function m_busca_usuario_por_celkey($usu_celularkey) {
        try {

            $sql = "select * from usuarios where usu_celularkey=?";
            $statement_sql = ConPDO::getInstance()->prepare($sql);
            $statement_sql->bindValue(1, $usu_celularkey);
            $statement_sql->execute();
            return $this->m_Popula_Usuario($statement_sql->fetch(PDO::FETCH_ASSOC));
        } catch (PDOException $e) {
            print "[[   Erro em m_busca_usuario_por_celkey :: " . $e->getMessage() . "   ]] ";
        }
    }

    public function m_BuscaUsu_CodigoPor_Celularkey_Para_ReativarCelularDesinstalado(UsuariosBean $usuario) {
        try {

            //  este metodo foi criado para quem desinstalou o app e tentou instalar novamente, este metodo
            // retornara o codigo do vendedor para o celular que o app fora desinstado
            $sql = "select usu_codigo from usuarios  where usu_celularkey = :usu_celularkey ";
            $statement_sql = ConPDO::getInstance()->prepare($sql);
            $statement_sql->bindValue(":usu_celularkey", $usuario->getUsu_celularkey());
            $statement_sql->execute();
            return $this->m_Popula_Usuario($statement_sql->fetch(PDO::FETCH_ASSOC));
        } catch (PDOException $e) {
            print "[[   Erro em m_BuscaUsu_CodigoPor_Celularkey_Para_ReativarCelularDesinstalado :: " . $e->getMessage() . "   ]] ";
        }
    }

    public function m_LiberaAcessoSite(UsuariosBean $usuario) {
        try {

            $sql = "update usuarios set usu_liberado = :usu_liberado where ID_CPF_EMPRESA  = :ID_CPF_EMPRESA   and usu_celularkey = :usu_celularkey ";
            $statement_sql = ConPDO::getInstance()->prepare($sql);

            $statement_sql->bindValue(":usu_liberado", $usuario->getUsu_liberado());
            $statement_sql->bindValue(":ID_CPF_EMPRESA", $usuario->getID_CPF_EMPRESA());
            $statement_sql->bindValue(":usu_celularkey", $usuario->getUsu_celularkey());
            return $statement_sql->execute();
        } catch (PDOException $e) {
            print "[[   Erro em m_LiberaAcessoSite :: " . $e->getMessage() . "   ]]   ";
        }
    }

    public function m_ValidarUsuario(UsuariosBean $usuario) {
        try {

            $sql = "select usu_codigo,usu_nome, usu_email,usu_celularkey,usu_numerocelular, usu_cpf,usu_dispositivo,
            usu_liberado, usu_desconto,usu_comissao, ID_CPF_EMPRESA from usuarios  where  usu_cpf=:usu_cpf and usu_email=:usu_email and usu_liberado=:usu_liberado  ";

            $statement_sql = ConPDO::getInstance()->prepare($sql);
            $statement_sql->bindValue(":usu_cpf", $usuario->getUsu_cpf());
            $statement_sql->bindValue(":usu_email", $usuario->getUsu_email());
            $statement_sql->bindValue(":usu_liberado", $usuario->getUsu_liberado());

            $statement_sql->execute();

            return $this->m_Popula_Usuario($statement_sql->fetch(PDO::FETCH_ASSOC));
        } catch (PDOException $e) {
            print "[[   Erro em m_ValidarUsuario :: " . $e->getMessage();
        }
    }

    public function m_buscar_email_esqueci_minha_senha(UsuariosBean $usuario) {
        try {
            $sql = "select * from usuarios where usu_email=:usu_email";
            $statement_sql = ConPDO::getInstance()->prepare($sql);
            $statement_sql->bindValue(":usu_email", $usuario->getUsu_email());
            $statement_sql->execute();


            return $this->m_Popula_Usuario($statement_sql->fetch(PDO::FETCH_ASSOC));
        } catch (PDOException $e) {
            print "[[   Erro em m_buscar_email_esqueci_minha_senha :: " . $e->getMessage();
        }
    }

    public function m_buscar_usuario_por_email($usu_email, $liberado) {
        try {
            $sql = "select * from usuarios where usu_email=? and usu_liberado=?";
            $statement_sql = ConPDO::getInstance()->prepare($sql);
            $statement_sql->bindValue(1, $usu_email);
            $statement_sql->bindValue(2, $liberado);
            $statement_sql->execute();
            return $this->m_Popula_Usuario($statement_sql->fetch(PDO::FETCH_ASSOC));
        } catch (PDOException $e) {
            print "[[   Erro em m_buscar_usuario_por_email :: " . $e->getMessage();
        }
    }

    public function m_busca_usuario_por_nome(UsuariosBean $usuario) {
        try {
            $sql = "select * from usuarios where usu_nome=:usu_nome and ID_CPF_EMPRESA= :ID_CPF_EMPRESA";
            $statement_sql = ConPDO::getInstance()->prepare($sql);
            $statement_sql->bindValue(":usu_nome", $usuario->getUsu_nome());
            $statement_sql->bindValue(":ID_CPF_EMPRESA", $usuario->getID_CPF_EMPRESA());

            $statement_sql->execute();

            $user = new UsuariosBean();
            $stmt = $statement_sql->fetch(PDO::FETCH_ASSOC);
            $user->setUsu_codigo($stmt["usu_codigo"]);
            $user->setUsu_nome($stmt["usu_nome"]);

            return $user;
        } catch (PDOException $e) {
            print "[[   Erro em c_busca_usuario_por_nome :: " . $e->getMessage();
        }
    }

    public function m_Fetch_Array_Usuarios($statement_sql) {
        $results = array();

        if ($statement_sql) {
            while ($linha = $statement_sql->fetch(PDO::FETCH_OBJ)) {

                $usuario = new UsuariosBean ();
                $usuario->setUsu_codigo($linha->usu_codigo);
                $usuario->setUsu_nome($linha->usu_nome);
                $usuario->setUsu_email($linha->usu_email);
                $usuario->setUsu_celularkey($linha->usu_celularkey);
                $usuario->setUsu_numerocelular($linha->usu_numerocelular);
                $usuario->setUsu_cpf($linha->usu_cpf);
                $usuario->setUsu_dispositivo($linha->usu_dispositivo);
                $usuario->setUsu_liberado($linha->usu_liberado);
                $usuario->setUsu_desconto($linha->usu_desconto);
                $usuario->setUsu_comissao($linha->usu_comissao);
                $usuario->setID_CPF_EMPRESA($linha->ID_CPF_EMPRESA);
                $results [] = $usuario;
            }
        }
        return $results;
    }

    public function m_Popula_Usuario($linha) {
        $usuario = new UsuariosBean ();
        $usuario->setUsu_codigo($linha["usu_codigo"]);
        $usuario->setUsu_nome($linha["usu_nome"]);
        $usuario->setUsu_email($linha["usu_email"]);
        $usuario->setUsu_celularkey($linha["usu_celularkey"]);
        $usuario->setUsu_numerocelular($linha["usu_numerocelular"]);
        $usuario->setUsu_cpf($linha["usu_cpf"]);
        $usuario->setUsu_dispositivo($linha["usu_dispositivo"]);
        $usuario->setUsu_liberado($linha["usu_liberado"]);
        $usuario->setUsu_desconto($linha["usu_desconto"]);
        $usuario->setUsu_comissao($linha["usu_comissao"]);
        $usuario->setID_CPF_EMPRESA($linha["ID_CPF_EMPRESA"]);
        return $usuario;
    }

    public function m_EXCLUIR_USUARIOS_ID_CPF_EMPRESA($ID_CPF_EMPRESA) {
        try {
            $sql = "delete from usuarios where ID_CPF_EMPRESA=:ID_CPF_EMPRESA";
            $statement_sql = ConPDO::getInstance()->prepare($sql);
            $statement_sql->bindValue(":ID_CPF_EMPRESA", $ID_CPF_EMPRESA);
            return $statement_sql->execute();
        } catch (PDOException $e) {
            print "Erro em m_EXCLUIR_USUARIOS_ID_CPF_EMPRESA :: " . $e->getMessage();
        }
    }

    public function m_busca_dados_vendedor(UsuariosBean $usuario) {
        try {
            $sql = "select * from usuarios  where usu_celularkey=? and usu_liberado = 'S' ";
            $statement_sql = ConPDO::getInstance()->prepare($sql);
            $statement_sql->bindValue(1, $usuario->getUsu_celularkey());
            $statement_sql->execute();
            return $this->m_Popula_Usuario($statement_sql->fetch(PDO::FETCH_ASSOC));
        } catch (PDOException $e) {
            print "[[   Erro em m_busca_dados_vendedor :: " . $e->getMessage() . "   ]] ";
        }
    }

}
