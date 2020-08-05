<?php

class FornecedoresDao {

    public static $instance;

    public function __construct() {
        
    }

    static public function getInstance() {
        if (!isset(self::$instance))
            self::$instance = new FornecedoresDao();
        return self::$instance;
    }

    public function M_gravarFornecedores(FornecedoresBean $fornecedor) {

        try {
            $sql = "insert into fornecedores (		
                ID_CPF_EMPRESA, for_razaosocial, for_fantasia, for_endereco, for_cep,  
                for_bairro,for_contato1, for_contato2, for_representante, for_email,
                for_cnpjcpf,cid_codigo) 
                VALUES (:ID_CPF_EMPRESA,:for_razaosocial,:for_fantasia,
                :for_endereco,:for_cep,:for_bairro,:for_contato1,:for_contato2,
                :for_representante,:for_email,:for_cnpjcpf,:cid_codigo)";

            $statement_sql = ConPDO::getInstance()->prepare($sql);
            $statement_sql->bindValue(":ID_CPF_EMPRESA", $fornecedor->getID_CPF_EMPRESA());
            $statement_sql->bindValue(":for_razaosocial", $fornecedor->getFor_razaosocial());
            $statement_sql->bindValue(":for_fantasia", $fornecedor->getFor_fantasia());
            $statement_sql->bindValue(":for_endereco", $fornecedor->getFor_endereco());
            $statement_sql->bindValue(":for_cep", $fornecedor->getFor_cep());
            $statement_sql->bindValue(":for_bairro", $fornecedor->getFor_bairro());
            $statement_sql->bindValue(":for_contato1", $fornecedor->getFor_contato1());
            $statement_sql->bindValue(":for_contato2", $fornecedor->getFor_contato2());
            $statement_sql->bindValue(":for_representante", $fornecedor->getFor_representante());
            $statement_sql->bindValue(":for_email", $fornecedor->getFor_email());
            $statement_sql->bindValue(":for_cnpjcpf", $fornecedor->getFor_cnpjcpf());
            $statement_sql->bindValue(":cid_codigo", $fornecedor->getCid_codigo());

            return $statement_sql->execute();
        } catch (PDOException $e) {
            print "Erro em M_gravarFornecedores :: " . $e->getMessage();
        }
    }

    public function M_editarFornecedores(FornecedoresBean $fornecedor) {
        try {
            $sql = "update fornecedores set		
                ID_CPF_EMPRESA=:ID_CPF_EMPRESA, 
                for_razaosocial=:for_razaosocial, 
                for_fantasia=:for_fantasia, 
                for_endereco=:for_endereco,
                for_cep=:for_cep,  
                for_bairro=:for_bairro,
                for_contato1=:for_contato1, 
                for_contato2=:for_contato2, 
                for_representante=:for_representante, 
                for_email=:for_email,
                for_cnpjcpf=:for_cnpjcpf,
                cid_codigo=:cid_codigo where for_codigo = :for_codigo and ID_CPF_EMPRESA=:ID_CPF_EMPRESA ";

            $statement_sql = ConPDO::getInstance()->prepare($sql);
            $statement_sql->bindValue(":ID_CPF_EMPRESA", $fornecedor->getID_CPF_EMPRESA());
            $statement_sql->bindValue(":for_razaosocial", $fornecedor->getFor_razaosocial());
            $statement_sql->bindValue(":for_fantasia", $fornecedor->getFor_fantasia());
            $statement_sql->bindValue(":for_endereco", $fornecedor->getFor_endereco());
            $statement_sql->bindValue(":for_cep", $fornecedor->getFor_cep());
            $statement_sql->bindValue(":for_bairro", $fornecedor->getFor_bairro());
            $statement_sql->bindValue(":for_contato1", $fornecedor->getFor_contato1());
            $statement_sql->bindValue(":for_contato2", $fornecedor->getFor_contato2());
            $statement_sql->bindValue(":for_representante", $fornecedor->getFor_representante());
            $statement_sql->bindValue(":for_email", $fornecedor->getFor_email());
            $statement_sql->bindValue(":for_cnpjcpf", $fornecedor->getFor_cnpjcpf());
            $statement_sql->bindValue(":cid_codigo", $fornecedor->getCid_codigo());

            //where
            $statement_sql->bindValue(":ID_CPF_EMPRESA", $fornecedor->getID_CPF_EMPRESA());
            $statement_sql->bindValue(":for_codigo", $fornecedor->getFor_codigo());

            return $statement_sql->execute();
        } catch (PDOException $e) {
            print "Erro em M_editarFornecedores :: " . $e->getMessage() . " Codigo :: " . $e->getCode() . " linha :: " . $e->getLine();
        }
    }

    public function M_excluirFornecedor(FornecedoresBean $fornecedor) {
        try {
            $sql = "delete from fornecedores where ID_CPF_EMPRESA = :ID_CPF_EMPRESA  and for_codigo = :for_codigo";
            $statement_sql = ConPDO::getInstance()->prepare($sql);
            $statement_sql->bindValue(":ID_CPF_EMPRESA", $fornecedor->getID_CPF_EMPRESA());
            $statement_sql->bindValue(":for_codigo", $fornecedor->getFor_codigo());
            return $statement_sql->execute();
        } catch (PDOException $e) {
            Util::getErrorPDOException($e, 'FORNECEDOR', 'ENRTADA DE PRODUTOS , CADASTRO DE PRODUTOS', $fornecedor->getFor_codigo(), $fornecedor->getID_CPF_EMPRESA(), 'https://dev.mysql.com/doc/refman/5.5/en/error-messages-server.html#error_er_row_is_referenced_2');
        }
    }

    public function M_BuscarFornecedorPorCodigo(FornecedoresBean $fornecedor) {
        try {
            $sql = "select * from fornecedores where for_codigo = :for_codigo and ID_CPF_EMPRESA = :ID_CPF_EMPRESA";
            $statement_sql = ConPDO::getInstance()->prepare($sql);
            $statement_sql->bindValue(":ID_CPF_EMPRESA", $fornecedor->getID_CPF_EMPRESA());
            $statement_sql->bindValue(":for_codigo", $fornecedor->getFor_codigo());
            $statement_sql->execute();
            return $this->populaFornecedor($statement_sql->fetch(PDO::FETCH_ASSOC));
        } catch (PDOException $e) {
            print "Erro em M_BuscarFornecedorPorCodigo :: " . $e->getMessage() . " Codigo :: " . $e->getCode() . " linha :: " . $e->getLine();
        }
    }

    private function populaFornecedor($linha) {

        $fornBean = new FornecedoresBean();
        $fornBean->setFor_codigo($linha["for_codigo"]);
        $fornBean->setID_CPF_EMPRESA($linha["ID_CPF_EMPRESA"]);
        $fornBean->setFor_razaosocial($linha["for_razaosocial"]);
        $fornBean->setFor_fantasia($linha["for_fantasia"]);
        $fornBean->setFor_endereco($linha["for_endereco"]);
        $fornBean->setFor_cep($linha["for_cep"]);
        $fornBean->setFor_bairro($linha["for_bairro"]);
        $fornBean->setFor_contato1($linha["for_contato1"]);
        $fornBean->setFor_contato2($linha["for_contato2"]);
        $fornBean->setFor_representante($linha["for_representante"]);
        $fornBean->setFor_email($linha["for_email"]);
        $fornBean->setFor_cnpjcpf($linha["for_cnpjcpf"]);
        $fornBean->setCid_codigo($linha["cid_codigo"]);

        return $fornBean;
    }

    public function M_buscaTodosFornecedores(FornecedoresBean $fornecedor) {
        $sql = "SELECT f.ID_CPF_EMPRESA,f.for_codigo,f.for_razaosocial,f.for_fantasia,
                f.for_endereco,c.cid_nome,f.for_cep,f.for_bairro,
                f.for_contato1,f.for_contato2,f.for_representante,
                f.for_email,f.for_cnpjcpf FROM fornecedores f 
                left outer join cidades c on c.cid_codigo = f.cid_codigo where f.ID_CPF_EMPRESA = :ID_CPF_EMPRESA";
        $statement_sql = ConPDO::getInstance()->prepare($sql);
        $statement_sql->bindValue(":ID_CPF_EMPRESA", $fornecedor->getID_CPF_EMPRESA());
        $statement_sql->execute();

        //retorna objetos beans
        return $this->processResults($statement_sql);
    }

    private function processResults($statement) {

        $results = array();

        if ($statement) {
            while ($row = $statement->fetch(PDO::FETCH_OBJ)) {
                $fornBean = new FornecedoresBean();
                $fornBean->setID_CPF_EMPRESA($row->ID_CPF_EMPRESA);
                $fornBean->setFor_codigo($row->for_codigo);
                $fornBean->setFor_razaosocial($row->for_razaosocial);
                $fornBean->setFor_fantasia($row->for_fantasia);
                $fornBean->setFor_endereco($row->for_endereco);
                $fornBean->setFor_cep($row->for_cep);
                $fornBean->setFor_bairro($row->for_bairro);
                $fornBean->setFor_contato1($row->for_contato1);
                $fornBean->setFor_contato2($row->for_contato2);
                $fornBean->setFor_representante($row->for_representante);
                $fornBean->setFor_email($row->for_email);
                $fornBean->setFor_cnpjcpf($row->for_cnpjcpf);
                $fornBean->setCid_codigo($row->cid_codigo);
                $fornBean->setCid_nome($row->cid_nome);
                $results[] = $fornBean;
            }
        }

        return $results;
    }

    public function M_buscarFornecedorFiltrosCombo(FornecedoresBean $fornecedor) {

        $buscar_por = (isset($_POST["buscar_por"]) ? $_POST["buscar_por"] : "for_codigo");
        $valor_campo = (isset($_POST["valor_campo"]) ? $_POST["valor_campo"] : "");
        $tipo_busca = (isset($_POST["tipo_busca"]) ? $_POST["tipo_busca"] : "");


        $field_value = str_replace(" ", "%", $valor_campo);


        $sql = "SELECT f.for_codigo,f.for_razaosocial,f.for_fantasia,
                f.for_endereco,c.cid_nome,f.for_cep,f.for_bairro,
                f.for_contato1,f.for_contato2,f.for_representante,
                f.for_email,f.for_cnpjcpf FROM fornecedores f 
                left outer join cidades c on c.cid_codigo = f.cid_codigo where   $buscar_por  like '%$field_value%'  and f.ID_CPF_EMPRESA = :ID_CPF_EMPRESA ";



        $statement_sql = ConPDO::getInstance()->prepare($sql);
        $statement_sql->bindValue(":ID_CPF_EMPRESA", $fornecedor->getID_CPF_EMPRESA());
        $statement_sql->execute();

        return $this->fetch_array($statement_sql);
    }

    private function fetch_array($statement) {

        $results = array();

        if ($statement) {
            while ($row = $statement->fetch(PDO::FETCH_OBJ)) {
                $fornBean = new FornecedoresBean();
                $fornBean->setID_CPF_EMPRESA($row->ID_CPF_EMPRESA);
                $fornBean->setFor_codigo($row->for_codigo);
                $fornBean->setFor_razaosocial($row->for_razaosocial);
                $fornBean->setFor_fantasia($row->for_fantasia);
                $fornBean->setFor_endereco($row->for_endereco);
                $fornBean->setFor_cep($row->for_cep);
                $fornBean->setFor_bairro($row->for_bairro);
                $fornBean->setFor_contato1($row->for_contato1);
                $fornBean->setFor_contato2($row->for_contato2);
                $fornBean->setFor_representante($row->for_representante);
                $fornBean->setFor_email($row->for_email);
                $fornBean->setFor_cnpjcpf($row->for_cnpjcpf);
                $fornBean->setCid_nome($row->cid_nome);
                $results[] = $fornBean;
            }
        }
        return $results;
    }

    public function m_EXCLUIR_FORNECEDORES_ID_CPF_EMPRESA($ID_CPF_EMPRESA) {
        try {
            $sql = "delete from fornecedores where ID_CPF_EMPRESA=:ID_CPF_EMPRESA";
            $statement_sql = ConPDO::getInstance()->prepare($sql);
            $statement_sql->bindValue(":ID_CPF_EMPRESA", $ID_CPF_EMPRESA);
            return $statement_sql->execute();
        } catch (PDOException $e) {
            print "Erro em m_EXCLUIR_FORNECEDORES_ID_CPF_EMPRESA :: " . $e->getMessage();
        }
    }

}
