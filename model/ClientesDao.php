<?php

error_reporting(E_ALL ^ E_NOTICE);

class ClientesDao {

    public static $instance;

    public function __construct() {
        
    }

    static public function getInstance() {
        if (!isset(self::$instance))
            self::$instance = new ClientesDao ();
        return self::$instance;
    }

    public function m_grava_cliente(ClientesBean $cliente) {
        try {
            $sql = "INSERT INTO clientes
                            (ID_CPF_EMPRESA,
                            cli_codigo,
                            cli_nome,
                            
                            cli_fantasia,
                            cli_endereco,
                            cli_bairro,
                            
                            cli_cep,
                            cid_codigo,
                            cli_contato1,
                            
                            cli_contato2,
                            cli_contato3,
                            cli_nascimento,
                            
                            cli_cpfcnpj,
                            cli_rginscricaoest,
                            cli_limite,
                            
                            cli_email,
                            cli_observacao,
                            usu_codigo,
                            
                            cli_senha,
                            cli_chave)
                            values (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";

            $statement_sql = ConPDO::getInstance()->prepare($sql);

            $statement_sql->bindValue(1, $cliente->getID_CPF_EMPRESA());
            $statement_sql->bindValue(2, $cliente->getCli_codigo());
            $statement_sql->bindValue(3, $cliente->getCli_nome());

            $statement_sql->bindValue(4, $cliente->getCli_fantasia());
            $statement_sql->bindValue(5, $cliente->getCli_endereco());
            $statement_sql->bindValue(6, $cliente->getCli_bairro());

            $statement_sql->bindValue(7, $cliente->getCli_cep());
            $statement_sql->bindValue(8, $cliente->getCid_codigo());
            $statement_sql->bindValue(9, $cliente->getCli_contato1());

            $statement_sql->bindValue(10, $cliente->getCli_contato2());
            $statement_sql->bindValue(11, $cliente->getCli_contato3());
            $statement_sql->bindValue(12, $cliente->getCli_nascimento());

            $statement_sql->bindValue(13, $cliente->getCli_cpfcnpj());
            $statement_sql->bindValue(14, $cliente->getCli_rginscricaoest());
            $statement_sql->bindValue(15, $cliente->getCli_limite());

            $statement_sql->bindValue(16, $cliente->getCli_email());
            $statement_sql->bindValue(17, $cliente->getCli_observacao());
            $statement_sql->bindValue(18, $cliente->getUsu_codigo());

            $statement_sql->bindValue(19, $cliente->getCli_senha());
            $statement_sql->bindValue(20, $cliente->getCli_chave());
           

            $statement_sql->execute();
            return ConPDO::getInstance()->lastInsertId();
        } catch (PDOException $e) {
            print "Erro em m_grava_cliente :: " . $e->getMessage();
        }
    }

    public function M_alterarClienteExportado(ClientesBean $cliente) {
        try {

            $sql = "update clientes set                     
                    
                    ID_CPF_EMPRESA= ?,
                    cli_nome= ?, 
                    cli_fantasia= ?,
                    
                    cli_endereco= ?,
                    cli_bairro= ?,
                    cli_cep= ?,
                    
                    cid_codigo= ?,
                    cli_contato1= ?,
                    cli_contato2= ?,
                    
                    cli_contato3= ?,
                    cli_nascimento= ?,
                    cli_cpfcnpj= ?,
                    
                    cli_rginscricaoest= ?,
                    cli_limite= ?,
                    cli_email= ?,
                    
                    cli_observacao= ?,
                    usu_codigo= ?,
                    cli_senha= ?,
                   
                    cli_chave= ? 
                    where ID_CPF_EMPRESA= ? and cli_codigo= ?";

            $statement_sql = ConPDO::getInstance()->prepare($sql);
            $statement_sql->bindValue(1, $cliente->getID_CPF_EMPRESA());
            $statement_sql->bindValue(2, $cliente->getCli_nome());
            $statement_sql->bindValue(3, $cliente->getCli_fantasia());

            $statement_sql->bindValue(4, $cliente->getCli_endereco());
            $statement_sql->bindValue(5, $cliente->getCli_bairro());
            $statement_sql->bindValue(6, $cliente->getCli_cep());

            $statement_sql->bindValue(7, $cliente->getCid_codigo());
            $statement_sql->bindValue(8, $cliente->getCli_contato1());
            $statement_sql->bindValue(9, $cliente->getCli_contato2());

            $statement_sql->bindValue(10, $cliente->getCli_contato3());
            $statement_sql->bindValue(11, $cliente->getCli_nascimento());
            $statement_sql->bindValue(12, $cliente->getCli_cpfcnpj());

            $statement_sql->bindValue(13, $cliente->getCli_rginscricaoest());
            $statement_sql->bindValue(14, $cliente->getCli_limite());
            $statement_sql->bindValue(15, $cliente->getCli_email());

            $statement_sql->bindValue(16, $cliente->getCli_observacao());
            $statement_sql->bindValue(17, $cliente->getUsu_codigo());
            $statement_sql->bindValue(18, $cliente->getCli_senha());

            $statement_sql->bindValue(19, $cliente->getCli_chave());

            //where
            $statement_sql->bindValue(20, $cliente->getID_CPF_EMPRESA());
            $statement_sql->bindValue(21, $cliente->getCli_codigo());

            return $statement_sql->execute();
        } catch (PDOException $e) {
            print "Erro em M_alterarClienteExportado :: " . $e->getMessage();
        }
    }

    public function m_altera_cliente_cadastrado_offline($cli_codigo, $ID_CPF_EMPRESA) {
        try {
            $sql = "update clientes set cli_chave ='' where cli_codigo= ? and ID_CPF_EMPRESA= ?  ";
            $statement_sql = ConPDO::getInstance()->prepare($sql);
            $statement_sql->bindValue(1, $cli_codigo);
            $statement_sql->bindValue(2, $ID_CPF_EMPRESA);
            return $statement_sql->execute();
        } catch (PDOException $e) {
            print "Erro em m_altera_cliente_cadastrado_offline :: " . $e->getMessage();
        }
    }

    public function m_alterar_cliente_web(ClientesBean $cliente) {
        try {

            $sql = "UPDATE clientes
                    SET
                    ID_CPF_EMPRESA = ?,
                    cli_codigo = ?,
                    cli_nome = ?,
                    
                    cli_fantasia = ?,
                    cli_endereco = ?,
                    cli_bairro = ?,
                    
                    cli_cep = ?,
                    cid_codigo = ?,
                    cli_contato1 = ?,
                    
                    cli_contato2 = ?,
                    cli_contato3 = ?,
                    cli_nascimento = ?,
                    
                    cli_cpfcnpj = ?,
                    cli_rginscricaoest = ?,
                    cli_limite = ?,
                    
                    cli_email = ?,
                    cli_observacao = ?,
                    usu_codigo = ?,
                    
                    cli_senha = ?,
                    cli_chave = ?
                  
                    WHERE cli_codigo = ? and ID_CPF_EMPRESA = ?";

            $statement_sql = ConPDO::getInstance()->prepare($sql);
            $statement_sql->bindValue(1, $cliente->getID_CPF_EMPRESA());
            $statement_sql->bindValue(2, $cliente->getCli_nome());
            $statement_sql->bindValue(3, $cliente->getCli_fantasia());

            $statement_sql->bindValue(4, $cliente->getCli_endereco());
            $statement_sql->bindValue(5, $cliente->getCli_bairro());
            $statement_sql->bindValue(6, $cliente->getCli_cep());

            $statement_sql->bindValue(7, $cliente->getCid_codigo());
            $statement_sql->bindValue(8, $cliente->getCli_contato1());
            $statement_sql->bindValue(9, $cliente->getCli_contato2());

            $statement_sql->bindValue(10, $cliente->getCli_contato3());
            $statement_sql->bindValue(11, $cliente->getCli_nascimento());
            $statement_sql->bindValue(12, $cliente->getCli_cpfcnpj());

            $statement_sql->bindValue(13, $cliente->getCli_rginscricaoest());
            $statement_sql->bindValue(14, $cliente->getCli_limite());
            $statement_sql->bindValue(15, $cliente->getCli_email());

            $statement_sql->bindValue(16, $cliente->getCli_observacao());
            $statement_sql->bindValue(17, $cliente->getUsu_codigo());
            $statement_sql->bindValue(18, $cliente->getCli_senha());

            $statement_sql->bindValue(19, $cliente->getCli_chave());

            //where
            $statement_sql->bindValue(20, $cliente->getID_CPF_EMPRESA());
            $statement_sql->bindValue(21, $cliente->getCli_codigo());


            return $statement_sql->execute();
        } catch (PDOException $e) {
            print "Erro em m_alterar_cliente_web :: " . $e->getMessage();
        }
    }

    public function M_buscarClientePorCodigo(ClientesBean $cliente) {
        try {

            $sql = "select 
                    cli.ID_CPF_EMPRESA,cli.cli_codigo,cli.cli_nome, 
                    cli.cli_fantasia,cli.cli_endereco,cli.cli_bairro, 
                    cli.cli_cep,ifnull(cid.cid_codigo,0) as cid_codigo, 
                    ifnull(cid.cid_nome,'nulo') as cid_nome,             
                    ifnull(usu.usu_codigo,0) as usu_codigo, 
                    ifnull(usu.usu_nome,'nulo') as usu_nome,       
                    cli.cli_senha,cli.cli_contato1,cli.cli_contato2, 
                    cli.cli_contato3,cli.cli_nascimento,cli.cli_cpfcnpj, 
                    cli.cli_rginscricaoest,cli.cli_observacao,cli.cli_limite, 
                    cli.cli_email,cli.cli_chave  FROM clientes cli 
            left outer join cidades cid on cid.cid_codigo = cli.cid_codigo
            left outer join usuarios usu on usu.usu_codigo = cli.usu_codigo where cli.cli_codigo = :cli_codigo and cli.ID_CPF_EMPRESA = :ID_CPF_EMPRESA ";

            $statement_sql = ConPDO::getInstance()->prepare($sql);
            $statement_sql->bindValue(":ID_CPF_EMPRESA", $cliente->getID_CPF_EMPRESA());
            $statement_sql->bindValue(":cli_codigo", $cliente->getCli_codigo());
            $statement_sql->execute();


            return $this->populacliente($statement_sql->fetch(PDO::FETCH_ASSOC));
        } catch (PDOException $e) {
            print "Erro em buscarClientePorCodigo :: " . $e->getMessage();
        }
    }

    public function m_buscaClientePorNome(ClientesBean $cliente) {
        try {

            $sql = "select * FROM clientes where cli_nome like '%" . $cliente->getCli_nome() . "%' and ID_CPF_EMPRESA = :ID_CPF_EMPRESA ";

            $statement_sql = ConPDO::getInstance()->prepare($sql);
            $statement_sql->bindValue(":ID_CPF_EMPRESA", $cliente->getID_CPF_EMPRESA());
            //$statement_sql->bindValue(":cli_nome", $cliente->getCli_nome());
            $statement_sql->execute();
            return $this->populacliente($statement_sql->fetch(PDO::FETCH_ASSOC));
        } catch (PDOException $e) {
            print "Erro em m_buscaClientePorNome :: " . $e->getMessage();
        }
    }

    public function populacliente($linha) {
        $cliente = new ClientesBean ();
        $cliente->setCli_codigo($linha ["cli_codigo"]);
        $cliente->setCli_nascimento(Util::format_DD_MM_AAAA($linha ["cli_nascimento"]));
        $cliente->setCli_nome($linha ["cli_nome"]);
        $cliente->setCli_fantasia($linha ["cli_fantasia"]);
        $cliente->setCli_endereco($linha ["cli_endereco"]);
        $cliente->setCli_bairro($linha ["cli_bairro"]);
        $cliente->setCli_cep($linha ["cli_cep"]);
        $cliente->setCid_codigo($linha ["cid_codigo"]);
        $cliente->setCid_nome($linha ["cid_nome"]);
        $cliente->setCli_contato1($linha ["cli_contato1"]);
        $cliente->setCli_contato2($linha ["cli_contato2"]);
        $cliente->setCli_contato3($linha ["cli_contato3"]);
        $cliente->setCli_cpfcnpj($linha ["cli_cpfcnpj"]);
        $cliente->setCli_rginscricaoest($linha ["cli_rginscricaoest"]);
        $cliente->setCli_limite($linha ["cli_limite"]);
        $cliente->setCli_email($linha ["cli_email"]);
        $cliente->setCli_observacao($linha ["cli_observacao"]);
        $cliente->setUsu_codigo($linha ["usu_codigo"]);
        $cliente->setUsu_nome($linha ["usu_nome"]);
        $cliente->setCli_senha($linha ["cli_senha"]);
        $cliente->setCli_chave($linha ["cli_chave"]);
        $cliente->setID_CPF_EMPRESA($linha ["ID_CPF_EMPRESA"]);



        return $cliente;
    }

    public function m_busca_clienteexportado_pela_chave(ClientesBean $cliente) {
        try {
            $sql = "select * from clientes where ID_CPF_EMPRESA = ? and  cli_chave = ? and cli_codigo = ?";
            $statement_sql = ConPDO::getInstance()->prepare($sql);
            $statement_sql->bindValue(1, $cliente->getID_CPF_EMPRESA());
            $statement_sql->bindValue(2, $cliente->getCli_chave());
            $statement_sql->bindValue(3, $cliente->getCli_codigo());
            $statement_sql->execute();
            return $this->populacliente_para_android($statement_sql->fetch(PDO::FETCH_ASSOC));
        } catch (PDOException $e) {
            print "Erro em m_busca_clienteexportado_pela_chave :: " . $e->getMessage();
        }
    }

    public function m_busca_cliente_gravado_android_offline(ClientesBean $cliente) {
        try {
            $sql = "select * from clientes where ID_CPF_EMPRESA = ? and cli_chave != ''";
            $statement_sql = ConPDO::getInstance()->prepare($sql);
            $statement_sql->bindValue(1, $cliente->getID_CPF_EMPRESA());
            $statement_sql->execute();
            return $this->fetch_array_clientes($statement_sql);
        } catch (PDOException $e) {
            print "Erro em m_busca_cliente_gravado_android_offline :: " . $e->getMessage();
        }
    }

    public function m_select_cliente_cli_chave($cli_chave) {
        try {
            $sql = "select * from clientes where cli_chave= ?";
            $statement_sql = ConPDO::getInstance()->prepare($sql);
            $statement_sql->bindValue(1, $cli_chave);
            $statement_sql->execute();
            return $this->populacliente_para_android($statement_sql->fetch(PDO::FETCH_ASSOC));
        } catch (PDOException $e) {
            print "Erro em m_select_cliente_cli_chave :: " . $e->getMessage();
        }
    }

    public function m_BuscaCliente_por_cli_chave(ClientesBean $cliente) {
        try {

            $sql = "select 
                    cli.ID_CPF_EMPRESA,cli.cli_codigo,cli.cli_nome, 
                    cli.cli_fantasia,cli.cli_endereco,cli.cli_bairro, 
                    cli.cli_cep,ifnull(cid.cid_codigo,0) as cid_codigo, 
                    ifnull(cid.cid_nome,'nulo') as cid_nome,             
                    ifnull(usu.usu_codigo,0) as usu_codigo, 
                    ifnull(usu.usu_nome,'nulo') as usu_nome,       
                    cli.cli_senha,cli.cli_contato1,cli.cli_contato2, 
                    cli.cli_contato3,cli.cli_nascimento,cli.cli_cpfcnpj, 
                    cli.cli_rginscricaoest,cli.cli_observacao,cli.cli_limite, 
                    cli.cli_email,cli.cli_chave  FROM clientes cli 
                    left outer join cidades cid on cid.cid_codigo = cli.cid_codigo
                    left outer join usuarios usu on usu.usu_codigo = cli.usu_codigo where cli.ID_CPF_EMPRESA = :ID_CPF_EMPRESA  and  cli.cli_chave = :cli_chave ";

            $statement_sql = ConPDO::getInstance()->prepare($sql);
            $statement_sql->bindValue(":ID_CPF_EMPRESA", $cliente->getID_CPF_EMPRESA());
            $statement_sql->bindValue(":cli_chave", $cliente->getCli_chave());
            $statement_sql->execute();

            return $this->populacliente_para_android($statement_sql->fetch(PDO::FETCH_ASSOC));
        } catch (PDOException $e) {
            print "Erro em buscarClientePorCodigo :: " . $e->getMessage();
        }
    }

    public function populacliente_para_android($linha) {
        $cliente = new ClientesBean ();
        $cliente->setCli_codigo($linha ["cli_codigo"]);
        $cliente->setCli_nascimento($linha ["cli_nascimento"]);
        $cliente->setCli_nome($linha ["cli_nome"]);
        $cliente->setCli_fantasia($linha ["cli_fantasia"]);
        $cliente->setCli_endereco($linha ["cli_endereco"]);
        $cliente->setCli_bairro($linha ["cli_bairro"]);
        $cliente->setCli_cep($linha ["cli_cep"]);
        $cliente->setCid_codigo($linha ["cid_codigo"]);
        $cliente->setCid_nome($linha ["cid_nome"]);
        $cliente->setCli_contato1($linha ["cli_contato1"]);
        $cliente->setCli_contato2($linha ["cli_contato2"]);
        $cliente->setCli_contato3($linha ["cli_contato3"]);
        $cliente->setCli_cpfcnpj($linha ["cli_cpfcnpj"]);
        $cliente->setCli_rginscricaoest($linha ["cli_rginscricaoest"]);
        $cliente->setCli_limite($linha ["cli_limite"]);
        $cliente->setCli_email($linha ["cli_email"]);
        $cliente->setCli_observacao($linha ["cli_observacao"]);
        $cliente->setUsu_codigo($linha ["usu_codigo"]);
        $cliente->setUsu_nome($linha ["usu_nome"]);
        $cliente->setCli_senha($linha ["cli_senha"]);
        $cliente->setCli_chave($linha ["cli_chave"]);
        $cliente->setID_CPF_EMPRESA($linha ["ID_CPF_EMPRESA"]);
        return $cliente;
    }

    public function m_listar_todos_clientes_para_diretor() {
        try {

            $sql = "select 
            cli.ID_CPF_EMPRESA,cli.cli_codigo,cli.cli_nome, 
            cli.cli_fantasia,cli.cli_endereco,cli.cli_bairro, 
            cli.cli_cep,ifnull(cid.cid_codigo,0) as cid_codigo, 
            ifnull(cid.cid_nome,'nulo') as cid_nome,             
            ifnull(usu.usu_codigo,0) as usu_codigo, 
            ifnull(usu.usu_nome,'nulo') as usu_nome,       
            cli.cli_senha,cli.cli_chave,cli.cli_contato1,cli.cli_contato2, 
            cli.cli_contato3,cli.cli_nascimento,cli.cli_cpfcnpj, 
            cli.cli_rginscricaoest,cli.cli_observacao,cli.cli_limite, 
            cli.cli_email  FROM clientes cli 
            left outer join cidades cid on cid.cid_codigo = cli.cid_codigo
            left outer join usuarios usu on usu.usu_codigo = cli.usu_codigo";

            $statement_sql = ConPDO::getInstance()->prepare($sql);
            $statement_sql->execute();


            return $this->fetch_array_clientes($statement_sql);
        } catch (PDOException $e) {
            print "Erro em M_buscaTodosClientes :: " . $e->getMessage();
        }
    }

    public function M_buscaTodosClientes(ClientesBean $cliente) {
        try {
            $sql = "select 
            cli.ID_CPF_EMPRESA,cli.cli_codigo,cli.cli_nome, 
            cli.cli_fantasia,cli.cli_endereco,cli.cli_bairro, 
            cli.cli_cep,ifnull(cid.cid_codigo,0) as cid_codigo, 
            ifnull(cid.cid_nome,'nulo') as cid_nome,             
            ifnull(usu.usu_codigo,0) as usu_codigo, 
            ifnull(usu.usu_nome,'nulo') as usu_nome,       
            cli.cli_senha,cli.cli_chave,cli.cli_contato1,cli.cli_contato2, 
            cli.cli_contato3,cli.cli_nascimento,cli.cli_cpfcnpj, 
            cli.cli_rginscricaoest,cli.cli_observacao,cli.cli_limite, 
            cli.cli_email  FROM clientes cli 
            left outer join cidades cid on cid.cid_codigo = cli.cid_codigo
            left outer join usuarios usu on usu.usu_codigo = cli.usu_codigo  where cli.ID_CPF_EMPRESA = :ID_CPF_EMPRESA ";
            $statement_sql = ConPDO::getInstance()->prepare($sql);
            $statement_sql->bindValue(":ID_CPF_EMPRESA", $cliente->getID_CPF_EMPRESA());
            $statement_sql->execute();
            return $this->fetch_array_todos_clientes_nfe($statement_sql);
        } catch (PDOException $e) {
            print "Erro em M_buscaTodosClientes :: " . $e->getMessage();
        }
    }

    public function M_buscaClientesDoVendedorUsuario(ClientesBean $cliente) {
        try {

            $sql = "select 
            cli.ID_CPF_EMPRESA,cli.cli_codigo,cli.cli_nome, 
            cli.cli_fantasia,cli.cli_endereco,cli.cli_bairro, 
            cli.cli_cep,ifnull(cid.cid_codigo,0) as cid_codigo, 
            ifnull(cid.cid_nome,'nulo') as cid_nome,             
            ifnull(usu.usu_codigo,0) as usu_codigo, 
            ifnull(usu.usu_nome,'nulo') as usu_nome,       
            cli.cli_senha,cli.cli_chave,cli.cli_contato1,cli.cli_contato2, 
            cli.cli_contato3,cli.cli_nascimento,cli.cli_cpfcnpj, 
            cli.cli_rginscricaoest,cli.cli_observacao,cli.cli_limite, 
            cli.cli_email  FROM clientes cli 
            left outer join cidades cid on cid.cid_codigo = cli.cid_codigo
            left outer join usuarios usu on usu.usu_codigo = cli.usu_codigo  where cli.ID_CPF_EMPRESA = :ID_CPF_EMPRESA  and usu.usu_codigo = :usu_codigo ";

            $statement_sql = ConPDO::getInstance()->prepare($sql);
            $statement_sql->bindValue(":ID_CPF_EMPRESA", $cliente->getID_CPF_EMPRESA());
            $statement_sql->bindValue(":usu_codigo", $cliente->getUsu_codigo());
            $statement_sql->execute();


            return $this->fetch_array_clientes($statement_sql);
        } catch (PDOException $e) {
            print "Erro em M_buscaTodosClientes :: " . $e->getMessage();
        }
    }

    public function M_excluirCliente(ClientesBean $cliente) {
        try {
            $sql = "delete from clientes where ID_CPF_EMPRESA = :ID_CPF_EMPRESA and cli_codigo = :cli_codigo ";
            $statement_sql = ConPDO::getInstance()->prepare($sql);
            $statement_sql->bindValue(":ID_CPF_EMPRESA", $cliente->getID_CPF_EMPRESA());
            $statement_sql->bindValue(":cli_codigo", $cliente->getCli_codigo());
            $statement_sql->execute();
        } catch (PDOException $e) {
            Util::getErrorPDOException($e, 'CLIENTES', 'CHEQUES,RECEBER,VENDA', $cliente->getCli_codigo(), $cliente->getID_CPF_EMPRESA(), 'https://dev.mysql.com/doc/refman/5.5/en/error-messages-server.html#error_er_row_is_referenced_2');
        }
    }

    public function M_buscarCliente_Where(ClientesBean $cliente) {
        try {

            $valor_campo = (isset($_POST ["valor_campo"]) ? $_POST ["valor_campo"] : "");

            $sql = "select 
            cli.ID_CPF_EMPRESA,cli.cli_codigo,cli.cli_nome, 
            cli.cli_fantasia,cli.cli_endereco,cli.cli_bairro, 
            cli.cli_cep,ifnull(cid.cid_codigo,0) as cid_codigo, 
            ifnull(cid.cid_nome,'nulo') as cid_nome,             
            ifnull(usu.usu_codigo,0) as usu_codigo, 
            ifnull(usu.usu_nome,'nulo') as usu_nome,       
            cli.cli_senha,cli.cli_contato1,cli.cli_contato2, 
            cli.cli_contato3,cli.cli_nascimento,cli.cli_cpfcnpj, 
            cli.cli_rginscricaoest,cli.cli_observacao,cli.cli_limite, 
            cli.cli_email  FROM clientes cli 
            left outer join cidades cid on cid.cid_codigo = cli.cid_codigo
            left outer join usuarios usu on usu.usu_codigo = cli.usu_codigo where  cli.cli_nome  like  '%" . $valor_campo . "%'   and cli.ID_CPF_EMPRESA = :ID_CPF_EMPRESA ";

            $statement_sql = ConPDO::getInstance()->prepare($sql);
            $statement_sql->bindValue(":ID_CPF_EMPRESA", $cliente->getID_CPF_EMPRESA());
            $statement_sql->execute();



            return $this->fetch_array_clientes($statement_sql);
        } catch (PDOException $e) {
            print "Erro em M_buscarClienteWhere :: " . $e->getMessage();
        }
    }

    private function fetch_array_clientes($statement_sql) {
        $results = array();

        if ($statement_sql) {
            while ($linha = $statement_sql->fetch(PDO::FETCH_OBJ)) {

                $cliente = new ClientesBean ();

                $cliente->setCli_codigo($linha->cli_codigo);
                $cliente->setCli_nascimento($linha->cli_nascimento);
                $cliente->setCli_nome($linha->cli_nome);
                $cliente->setCli_fantasia($linha->cli_fantasia);
                $cliente->setCli_endereco($linha->cli_endereco);
                $cliente->setCli_bairro($linha->cli_bairro);
                $cliente->setCli_cep($linha->cli_cep);
                $cliente->setCid_codigo($linha->cid_codigo);
                $cliente->setCid_nome($linha->cid_nome);
                $cliente->setCli_contato1($linha->cli_contato1);
                $cliente->setCli_contato2($linha->cli_contato2);
                $cliente->setCli_contato3($linha->cli_contato3);
                $cliente->setCli_cpfcnpj($linha->cli_cpfcnpj);
                $cliente->setCli_rginscricaoest($linha->cli_rginscricaoest);
                $cliente->setCli_limite($linha->cli_limite);
                $cliente->setCli_email($linha->cli_email);
                $cliente->setCli_observacao($linha->cli_observacao);
                $cliente->setUsu_codigo($linha->usu_codigo);
                $cliente->setUsu_nome($linha->usu_nome);
                $cliente->setCli_senha($linha->cli_senha);
                $cliente->setCli_chave($linha->cli_chave);
                $cliente->setID_CPF_EMPRESA($linha->ID_CPF_EMPRESA);
                $results [] = $cliente;
            }
        }

        return $results;
    }

    private function fetch_array_todos_clientes_nfe($statement_sql) {
        $results = array();

        if ($statement_sql) {
            while ($linha = $statement_sql->fetch(PDO::FETCH_OBJ)) {

                $cliente = new ClientesBean ();

                $cliente->setCli_codigo($linha->cli_codigo);
                $cliente->setCli_nascimento($linha->cli_nascimento);
                $cliente->setCli_nome($linha->cli_nome);
                $cliente->setCli_fantasia($linha->cli_fantasia);
                $cliente->setCli_endereco($linha->cli_endereco);
                $cliente->setCli_bairro($linha->cli_bairro);
                $cliente->setCli_cep($linha->cli_cep);
                $cliente->setCid_codigo($linha->cid_codigo);
                $cliente->setCid_nome($linha->cid_nome);
                $cliente->setCli_contato1($linha->cli_contato1);
                $cliente->setCli_contato2($linha->cli_contato2);
                $cliente->setCli_contato3($linha->cli_contato3);
                $cliente->setCli_cpfcnpj($linha->cli_cpfcnpj);
                $cliente->setCli_rginscricaoest($linha->cli_rginscricaoest);
                $cliente->setCli_limite($linha->cli_limite);
                $cliente->setCli_email($linha->cli_email);
                $cliente->setCli_observacao($linha->cli_observacao);
                $cliente->setUsu_codigo($linha->usu_codigo);
                $cliente->setUsu_nome($linha->usu_nome);
                $cliente->setCli_senha($linha->cli_senha);
                $cliente->setCli_chave($linha->cli_chave);
                $cliente->setID_CPF_EMPRESA($linha->ID_CPF_EMPRESA);

                $results [] = $cliente;
            }
        }

        return $results;
    }

    public function m_imprime_relatorio_clientes_por_bairro(ClientesBean $cliente) {

        try {

            $sql = "select 
            cli.ID_CPF_EMPRESA,cli.cli_codigo,cli.cli_nome, 
            cli.cli_fantasia,cli.cli_endereco,cli.cli_bairro, 
            cli.cli_cep,ifnull(cid.cid_codigo,0) as cid_codigo, 
            ifnull(cid.cid_nome,'nulo') as cid_nome,             
            ifnull(usu.usu_codigo,0) as usu_codigo, 
            ifnull(usu.usu_nome,'nulo') as usu_nome,       
            cli.cli_senha,cli.cli_contato1,cli.cli_contato2, 
            cli.cli_contato3,cli.cli_nascimento,cli.cli_cpfcnpj, 
            cli.cli_rginscricaoest,cli.cli_observacao,cli.cli_limite, 
            cli.cli_email  FROM clientes cli 
            left outer join cidades cid on cid.cid_codigo = cli.cid_codigo
            left outer join usuarios usu on usu.usu_codigo = cli.usu_codigo where cid.cid_nome like '%" . $cliente->getCid_nome() . "%'  and  cli.cli_bairro  like  '%" . $cliente->getCli_bairro() . "%'  and cli.ID_CPF_EMPRESA = " . $cliente->getID_CPF_EMPRESA() . " order by cli.cli_nome ";

            $statement_sql = ConPDO::getInstance()->prepare($sql);
            $statement_sql->execute();
            return $this->fetch_array_clientes($statement_sql);
        } catch (PDOException $e) {
            print "Erro em m_imprime_relatorio_clientes_por_bairro :: " . $e->getMessage();
        }
    }

    public function m_imprime_relatorio_cliente(ClientesBean $cliente) {

        try {

            $sql = "select 
            cli.ID_CPF_EMPRESA,cli.cli_codigo,cli.cli_nome, 
            cli.cli_fantasia,cli.cli_endereco,cli.cli_bairro, 
            cli.cli_cep,ifnull(cid.cid_codigo,0) as cid_codigo, 
            ifnull(cid.cid_nome,'nulo') as cid_nome,             
            ifnull(usu.usu_codigo,0) as usu_codigo, 
            ifnull(usu.usu_nome,'nulo') as usu_nome,       
            cli.cli_senha,cli.cli_contato1,cli.cli_contato2, 
            cli.cli_contato3,cli.cli_nascimento,cli.cli_cpfcnpj, 
            cli.cli_rginscricaoest,cli.cli_observacao,cli.cli_limite, 
            cli.cli_email  FROM clientes cli 
            left outer join cidades cid on cid.cid_codigo = cli.cid_codigo
            left outer join usuarios usu on usu.usu_codigo = cli.usu_codigo where  " . $cliente->getBuscar_por() . "  like  '%" . $cliente->getValor_campo() . "%'   and cli.ID_CPF_EMPRESA = :ID_CPF_EMPRESA order by cli.cli_bairro,cli.cli_nome ";

            $statement_sql = ConPDO::getInstance()->prepare($sql);
            $statement_sql->bindValue(":ID_CPF_EMPRESA", $cliente->getID_CPF_EMPRESA());
            $statement_sql->execute();
            //echo $sql;
            return $this->fetch_array_clientes($statement_sql);
        } catch (PDOException $e) {
            print "Erro em m_imprime_relatorio_cliente :: " . $e->getMessage();
        }
    }

    public function m_imprime_relatorio_cliente_por_cidade(ClientesBean $cliente) {

        try {

            $sql = "select 
            cli.ID_CPF_EMPRESA,cli.cli_codigo,cli.cli_nome, 
            cli.cli_fantasia,cli.cli_endereco,cli.cli_bairro, 
            cli.cli_cep,ifnull(cid.cid_codigo,0) as cid_codigo, 
            ifnull(cid.cid_nome,'nulo') as cid_nome,             
            ifnull(usu.usu_codigo,0) as usu_codigo, 
            ifnull(usu.usu_nome,'nulo') as usu_nome,       
            cli.cli_senha,cli.cli_contato1,cli.cli_contato2, 
            cli.cli_contato3,cli.cli_nascimento,cli.cli_cpfcnpj, 
            cli.cli_rginscricaoest,cli.cli_observacao,cli.cli_limite, 
            cli.cli_email  FROM clientes cli 
            left outer join cidades cid on cid.cid_codigo = cli.cid_codigo
            left outer join usuarios usu on usu.usu_codigo = cli.usu_codigo where cid.cid_nome like  '%" . $cliente->getCid_nome() . "%'   and cli.ID_CPF_EMPRESA = '" . $cliente->getID_CPF_EMPRESA() . "' order by cli.cli_bairro,cli.cli_nome ";
            $statement_sql = ConPDO::getInstance()->prepare($sql);
            $statement_sql->execute();
            return $this->fetch_array_clientes($statement_sql);
        } catch (PDOException $e) {
            print "Erro em m_imprime_relatorio_cliente :: " . $e->getMessage();
        }
    }

    public function m_imprime_relatorio_cliente_por_vendedor(ClientesBean $cliente) {

        try {

            $sql = "select 
            cli.ID_CPF_EMPRESA,cli.cli_codigo,cli.cli_nome, 
            cli.cli_fantasia,cli.cli_endereco,cli.cli_bairro, 
            cli.cli_cep,ifnull(cid.cid_codigo,0) as cid_codigo, 
            ifnull(cid.cid_nome,'nulo') as cid_nome,             
            ifnull(usu.usu_codigo,0) as usu_codigo, 
            ifnull(usu.usu_nome,'nulo') as usu_nome,       
            cli.cli_senha,cli.cli_contato1,cli.cli_contato2, 
            cli.cli_contato3,cli.cli_nascimento,cli.cli_cpfcnpj, 
            cli.cli_rginscricaoest,cli.cli_observacao,cli.cli_limite, 
            cli.cli_email  FROM clientes cli 
            left outer join cidades cid on cid.cid_codigo = cli.cid_codigo
            left outer join usuarios usu on usu.usu_codigo = cli.usu_codigo where usu.usu_nome like  '%" . $cliente->getUsu_nome() . "%'   and cli.ID_CPF_EMPRESA = '" . $cliente->getID_CPF_EMPRESA() . "' order by cli.cli_bairro,cli.cli_nome ";
            $statement_sql = ConPDO::getInstance()->prepare($sql);
            $statement_sql->execute();
            return $this->fetch_array_clientes($statement_sql);
        } catch (PDOException $e) {
            print "Erro em m_imprime_relatorio_cliente :: " . $e->getMessage();
        }
    }

    public function m_EXCLUIR_CLIENTES_ID_CPF_EMPRESA($ID_CPF_EMPRESA) {
        try {
            $sql = "delete from clientes where ID_CPF_EMPRESA=:ID_CPF_EMPRESA";
            $statement_sql = ConPDO::getInstance()->prepare($sql);
            $statement_sql->bindValue(":ID_CPF_EMPRESA", $ID_CPF_EMPRESA);
            return $statement_sql->execute();
        } catch (PDOException $e) {
            print "Erro em m_EXCLUIR_CLIENTES_ID_CPF_EMPRESA :: " . $e->getMessage();
        }
    }

}

?>
