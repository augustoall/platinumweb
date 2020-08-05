<?php

class ProdutoDao {

    public static $instance;

    public function __construct() {
        
    }

    static public function getInstance() {
        if (!isset(self::$instance))
            self::$instance = new ProdutoDao();
        return self::$instance;
    }

    public function M_gravarProduto(ProdutoBean $produto) {

        try {

            $sql = "INSERT INTO produtos (
            ID_CPF_EMPRESA,prd_ativo,prd_EAN, 
            prd_descricao,prd_descr_red,prd_custo, 
            prd_preco,prd_unmed,prd_quant, 
            prd_obs,for_codigo,cat_codigo) 
            VALUES (:ID_CPF_EMPRESA,:prd_ativo,:prd_EAN,:prd_descricao, 
            :prd_descr_red,:prd_custo,:prd_preco,:prd_unmed, 
            :prd_quant,:prd_obs,:for_codigo,:cat_codigo)";

            $statement_sql = ConPDO::getInstance()->prepare($sql);
            $statement_sql->bindValue(":ID_CPF_EMPRESA", $produto->getID_CPF_EMPRESA());
            $statement_sql->bindValue(":prd_ativo", $produto->getPrd_ativo());
            $statement_sql->bindValue(":prd_EAN", $produto->getPrd_EAN());
            $statement_sql->bindValue(":prd_descricao", $produto->getPrd_descricao());
            $statement_sql->bindValue(":prd_descr_red", $produto->getPrd_descr_red());
            $statement_sql->bindValue(":prd_custo", $produto->getPrd_custo());
            $statement_sql->bindValue(":prd_preco", $produto->getPrd_preco());
            $statement_sql->bindValue(":prd_unmed", $produto->getPrd_unmed());
            $statement_sql->bindValue(":prd_quant", $produto->getPrd_quant());
            $statement_sql->bindValue(":prd_obs", $produto->getPrd_obs());
            $statement_sql->bindValue(":for_codigo", $produto->getFor_codigo());
            $statement_sql->bindValue(":cat_codigo", $produto->getCat_codigo());
            return $statement_sql->execute();
            
        } catch (PDOException $e) {

            print "Erro em M_gravarProduto :: " . $e->getMessage();
        }
    }

    public function m_altera_quantidade_estoque(ProdutoBean $produto) {
        try {
            $sql = "update produtos set prd_quant=:prd_quant  where ID_CPF_EMPRESA=:ID_CPF_EMPRESA and prd_codigo = :prd_codigo";

            $statement_sql = ConPDO::getInstance()->prepare($sql);
            $statement_sql->bindValue(":ID_CPF_EMPRESA", $produto->getID_CPF_EMPRESA());
            $statement_sql->bindValue(":prd_codigo", $produto->getPrd_codigo());
            $statement_sql->bindValue(":prd_quant", $produto->getPrd_quant());
            return $statement_sql->execute();
        } catch (PDOException $e) {
            print "Erro em m_altera_quantidade_estoque :: " . $e->getMessage();
        }
    }

    public function M_alterarProduto(ProdutoBean $produto) {
        try {
            $sql = "update produtos set
            ID_CPF_EMPRESA=:ID_CPF_EMPRESA,prd_ativo=:prd_ativo,prd_EAN=:prd_EAN, 
            prd_descricao=:prd_descricao,prd_descr_red=:prd_descr_red,prd_custo=:prd_custo, 
            prd_preco=:prd_preco,prd_unmed=:prd_unmed,prd_quant=:prd_quant, 
            prd_obs=:prd_obs,for_codigo=:for_codigo,cat_codigo=:cat_codigo where
            ID_CPF_EMPRESA=:ID_CPF_EMPRESA and prd_codigo = :prd_codigo";

            $statement_sql = ConPDO::getInstance()->prepare($sql);
            $statement_sql->bindValue(":ID_CPF_EMPRESA", $produto->getID_CPF_EMPRESA());
            $statement_sql->bindValue(":prd_ativo", $produto->getPrd_ativo());
            $statement_sql->bindValue(":prd_EAN", $produto->getPrd_EAN());
            $statement_sql->bindValue(":prd_descricao", $produto->getPrd_descricao());
            $statement_sql->bindValue(":prd_descr_red", $produto->getPrd_descr_red());
            $statement_sql->bindValue(":prd_custo", $produto->getPrd_custo());
            $statement_sql->bindValue(":prd_preco", $produto->getPrd_preco());
            $statement_sql->bindValue(":prd_unmed", $produto->getPrd_unmed());
            $statement_sql->bindValue(":prd_quant", $produto->getPrd_quant());
            $statement_sql->bindValue(":prd_obs", $produto->getPrd_obs());
            $statement_sql->bindValue(":for_codigo", $produto->getFor_codigo());
            $statement_sql->bindValue(":cat_codigo", $produto->getCat_codigo());
            $statement_sql->bindValue(":ID_CPF_EMPRESA", $produto->getID_CPF_EMPRESA());
            $statement_sql->bindValue(":prd_codigo", $produto->getPrd_codigo());
            return $statement_sql->execute();
          
        } catch (PDOException $e) {
            print "Erro em M_alterarProduto :: " . $e->getMessage();
        }
    }

    public function M_alterarProdutoPeloCodigoBARRAS(ProdutoBean $produto) {
        try {
            $sql = "update produtos set
            ID_CPF_EMPRESA=:ID_CPF_EMPRESA,prd_ativo=:prd_ativo,prd_EAN=:prd_EAN, 
            prd_descricao=:prd_descricao,prd_descr_red=:prd_descr_red,prd_custo=:prd_custo, 
            prd_preco=:prd_preco,prd_unmed=:prd_unmed,prd_quant=:prd_quant, 
            prd_obs=:prd_obs,for_codigo=:for_codigo,cat_codigo=:cat_codigo where
            ID_CPF_EMPRESA=:ID_CPF_EMPRESA and prd_EAN = :prd_EAN";

            $statement_sql = ConPDO::getInstance()->prepare($sql);

            $statement_sql->bindValue(":prd_ativo", $produto->getPrd_ativo());
            $statement_sql->bindValue(":prd_EAN", $produto->getPrd_EAN());
            $statement_sql->bindValue(":prd_descricao", $produto->getPrd_descricao());
            $statement_sql->bindValue(":prd_descr_red", $produto->getPrd_descr_red());
            $statement_sql->bindValue(":prd_custo", $produto->getPrd_custo());
            $statement_sql->bindValue(":prd_preco", $produto->getPrd_preco());
            $statement_sql->bindValue(":prd_unmed", $produto->getPrd_unmed());
            $statement_sql->bindValue(":prd_quant", $produto->getPrd_quant());
            $statement_sql->bindValue(":prd_obs", $produto->getPrd_obs());
            $statement_sql->bindValue(":for_codigo", $produto->getFor_codigo());
            $statement_sql->bindValue(":cat_codigo", $produto->getCat_codigo());

            // where
            $statement_sql->bindValue(":ID_CPF_EMPRESA", $produto->getID_CPF_EMPRESA());
            $statement_sql->bindValue(":prd_EAN", $produto->getPrd_EAN());
            return $statement_sql->execute();          
        } catch (PDOException $e) {
            print "Erro em M_alterarProduto :: " . $e->getMessage();
        }
    }

    public function M_buscaProdutoPorCodigo(ProdutoBean $produto) {

        try {
            $sql = "select 
                p.prd_codigo,p.prd_ativo,p.prd_EAN,p.prd_descricao,p.prd_descr_red, 
                p.prd_custo,p.prd_preco,p.prd_unmed,p.prd_quant,p.prd_obs, 
                p.for_codigo,f.for_fantasia,p.cat_codigo,c.cat_descricao 
                from produtos p 
                left outer join fornecedores f on f.for_codigo = p.for_codigo 
                left outer join categorias c on c.cat_codigo = p.cat_codigo 
                where p.ID_CPF_EMPRESA=:ID_CPF_EMPRESA and p.prd_codigo = :prd_codigo ";
            $statement_sql = ConPDO::getInstance()->prepare($sql);
            $statement_sql->bindValue(":ID_CPF_EMPRESA", $produto->getID_CPF_EMPRESA());
            $statement_sql->bindValue(":prd_codigo", $produto->getPrd_codigo());

            $statement_sql->execute();

            return $this->pegavaloresproduto($statement_sql->fetch(PDO::FETCH_ASSOC));
        } catch (PDOException $exc) {
            print "Erro em M_buscaProdutoPorCodigo :: " . $e->getMessage();
        }
    }

    public function M_buscaProdutoPorCodigoBARRAS(ProdutoBean $produto) {

        try {
            $sql = "select 
                p.prd_codigo,p.prd_ativo,p.prd_EAN,p.prd_descricao,p.prd_descr_red, 
                p.prd_custo,p.prd_preco,p.prd_unmed,p.prd_quant,p.prd_obs, 
                p.for_codigo,f.for_fantasia,p.cat_codigo,c.cat_descricao 
                from produtos p 
                left outer join fornecedores f on f.for_codigo = p.for_codigo 
                left outer join categorias c on c.cat_codigo = p.cat_codigo 
                where p.ID_CPF_EMPRESA=:ID_CPF_EMPRESA and p.prd_EAN = :prd_EAN ";
            $statement_sql = ConPDO::getInstance()->prepare($sql);
            $statement_sql->bindValue(":ID_CPF_EMPRESA", $produto->getID_CPF_EMPRESA());
            $statement_sql->bindValue(":prd_EAN", $produto->getPrd_EAN());

            $statement_sql->execute();          


            return $this->pegavaloresproduto($statement_sql->fetch(PDO::FETCH_ASSOC));
        } catch (PDOException $exc) {
            print "Erro em M_buscaProdutoPorCodigoBARRAS :: " . $e->getMessage();
        }
    }

    public function pegavaloresproduto($prod) {
        $produto = new ProdutoBean();
        $produto->setPrd_codigo($prod["prd_codigo"]);
        $produto->setPrd_ativo($prod["prd_ativo"]);
        $produto->setPrd_EAN($prod["prd_EAN"]);
        $produto->setPrd_descricao($prod["prd_descricao"]);
        $produto->setPrd_descr_red($prod["prd_descr_red"]);
        $produto->setPrd_custo($prod["prd_custo"]);
        $produto->setPrd_preco($prod["prd_preco"]);
        $produto->setPrd_unmed($prod["prd_unmed"]);
        $produto->setPrd_quant($prod["prd_quant"]);
        $produto->setPrd_obs($prod["prd_obs"]);
        $produto->setFor_codigo($prod["for_codigo"]);
        $produto->setFor_fantasia($prod["for_fantasia"]);
        $produto->setCat_codigo($prod["cat_codigo"]);
        $produto->setCat_descricao($prod["cat_descricao"]);
        return $produto;
    }

    public function M_buscarTodosProdutos_ATIVOS(ProdutoBean $produto) {
        try {

            $sql = "select
            prd.ID_CPF_EMPRESA,
            prd.prd_codigo,
            prd.prd_ativo,
            prd.prd_EAN,
            prd.prd_descricao,
            prd.prd_descr_red, 
            prd.prd_custo,
            prd.prd_preco,
            prd.prd_unmed,
            prd.prd_quant,
            prd.prd_obs, 
            prd.for_codigo,
            forn.for_fantasia,
            prd.cat_codigo,
            cat.cat_descricao 
            from produtos prd 
            left outer join fornecedores forn on forn.for_codigo = prd.for_codigo 
            left outer join categorias cat on cat.cat_codigo = prd.cat_codigo where prd.ID_CPF_EMPRESA=:ID_CPF_EMPRESA  and prd.prd_ativo = 'S' ";

            $statement_sql = ConPDO::getInstance()->prepare($sql);
            $statement_sql->bindValue(":ID_CPF_EMPRESA", $produto->getID_CPF_EMPRESA());
            $statement_sql->execute();
          

            return $this->fetch_array($statement_sql);
        } catch (PDOException $e) {
            print "Erro em M_buscarTodosProdutos :: " . $e->getMessage();
        }
    }

    public function m_buscarTodosProdutos_INATIVOS(ProdutoBean $produto) {
        try {

            $sql = "select
            prd.ID_CPF_EMPRESA,
            prd.prd_codigo,
            prd.prd_ativo,
            prd.prd_EAN,
            prd.prd_descricao,
            prd.prd_descr_red, 
            prd.prd_custo,
            prd.prd_preco,
            prd.prd_unmed,
            prd.prd_quant,
            prd.prd_obs, 
            prd.for_codigo,
            forn.for_fantasia,
            prd.cat_codigo,
            cat.cat_descricao 
            from produtos prd 
            left outer join fornecedores forn on forn.for_codigo = prd.for_codigo 
            left outer join categorias cat on cat.cat_codigo = prd.cat_codigo where prd.ID_CPF_EMPRESA=:ID_CPF_EMPRESA  and prd.prd_ativo = 'N' ";

            $statement_sql = ConPDO::getInstance()->prepare($sql);
            $statement_sql->bindValue(":ID_CPF_EMPRESA", $produto->getID_CPF_EMPRESA());
            $statement_sql->execute();
                        return $this->fetch_array($statement_sql);
        } catch (PDOException $e) {
            print "Erro em M_buscarTodosProdutos :: " . $e->getMessage();
        }
    }

    public function m_buscarTodosProdutosPorCategoria(ProdutoBean $produto) {
        try {

            $sql = "select
            prd.ID_CPF_EMPRESA,
            prd.prd_codigo,
            prd.prd_ativo,
            prd.prd_EAN,
            prd.prd_descricao,
            prd.prd_descr_red, 
            prd.prd_custo,
            prd.prd_preco,
            prd.prd_unmed,
            prd.prd_quant,
            prd.prd_obs, 
            prd.for_codigo,
            forn.for_fantasia,
            prd.cat_codigo,
            cat.cat_descricao 
            from produtos prd 
            left outer join fornecedores forn on forn.for_codigo = prd.for_codigo 
            left outer join categorias cat on cat.cat_codigo = prd.cat_codigo where prd.ID_CPF_EMPRESA= ? and prd.cat_codigo= ?  order by prd.prd_descricao ";

            $statement_sql = ConPDO::getInstance()->prepare($sql);
            $statement_sql->bindValue(1, $produto->getID_CPF_EMPRESA());
            $statement_sql->bindValue(2, $produto->getCat_codigo());
            $statement_sql->execute();            
            return $this->fetch_array($statement_sql);
        } catch (PDOException $e) {
            print "Erro em M_buscarTodosProdutos :: " . $e->getMessage();
        }
    }

    public function m_buscarTodosProdutosSemEstoque(ProdutoBean $produto) {
        try {

            $sql = "select
            prd.ID_CPF_EMPRESA,
            prd.prd_codigo,
            prd.prd_ativo,
            prd.prd_EAN,
            prd.prd_descricao,
            prd.prd_descr_red, 
            prd.prd_custo,
            prd.prd_preco,
            prd.prd_unmed,
            prd.prd_quant,
            prd.prd_obs, 
            prd.for_codigo,
            forn.for_fantasia,
            prd.cat_codigo,
            cat.cat_descricao 
            from produtos prd 
            left outer join fornecedores forn on forn.for_codigo = prd.for_codigo 
            left outer join categorias cat on cat.cat_codigo = prd.cat_codigo where prd.ID_CPF_EMPRESA= ? and  prd.prd_quant <=0  order by prd.prd_descricao ";

            $statement_sql = ConPDO::getInstance()->prepare($sql);
            $statement_sql->bindValue(1, $produto->getID_CPF_EMPRESA());
            $statement_sql->execute();          
            return $this->fetch_array($statement_sql);
        } catch (PDOException $e) {
            print "Erro em M_buscarTodosProdutos :: " . $e->getMessage();
        }
    }

    public function M_buscarTodosProdutos(ProdutoBean $produto) {
        try {

            $sql = "select
            prd.ID_CPF_EMPRESA,
            prd.prd_codigo,
            prd.prd_ativo,
            prd.prd_EAN,
            prd.prd_descricao,
            prd.prd_descr_red, 
            prd.prd_custo,
            prd.prd_preco,
            prd.prd_unmed,
            prd.prd_quant,
            prd.prd_obs, 
            prd.for_codigo,
            forn.for_fantasia,
            prd.cat_codigo,
            cat.cat_descricao 
            from produtos prd 
            left outer join fornecedores forn on forn.for_codigo = prd.for_codigo 
            left outer join categorias cat on cat.cat_codigo = prd.cat_codigo where prd.ID_CPF_EMPRESA=:ID_CPF_EMPRESA  order by prd.prd_descricao ";

            $statement_sql = ConPDO::getInstance()->prepare($sql);
            $statement_sql->bindValue(":ID_CPF_EMPRESA", $produto->getID_CPF_EMPRESA());
            $statement_sql->execute();         

            return $this->fetch_array($statement_sql);
        } catch (PDOException $e) {
            print "Erro em M_buscarTodosProdutos :: " . $e->getMessage();
        }
    }

    private function fetch_array($statement_sql) {

        $results = array();

        if ($statement_sql) {
            while ($linha = $statement_sql->fetch(PDO::FETCH_OBJ)) {

                $produto = new ProdutoBean();
                $produto->setPrd_codigo($linha->prd_codigo);
                $produto->setPrd_ativo($linha->prd_ativo);
                $produto->setPrd_EAN($linha->prd_EAN);
                $produto->setPrd_descricao($linha->prd_descricao);
                $produto->setPrd_descr_red($linha->prd_descr_red);
                $produto->setPrd_custo($linha->prd_custo);
                $produto->setPrd_preco($linha->prd_preco);
                $produto->setPrd_unmed($linha->prd_unmed);
                $produto->setPrd_quant($linha->prd_quant);
                $produto->setPrd_obs($linha->prd_obs);
                $produto->setFor_codigo($linha->for_codigo);
                $produto->setFor_fantasia($linha->for_fantasia);
                $produto->setCat_codigo($linha->cat_codigo);
                $produto->setCat_descricao($linha->cat_descricao);

                $results[] = $produto;
            }
        }

        return $results;
    }

    public function M_buscaProdutosFiltroCombo(ProdutoBean $produto) {

        $buscar_por = (isset($_POST["buscar_por"]) ? $_POST["buscar_por"] : "buscar_por");
        $valor_campo = (isset($_POST["valor_campo"]) ? $_POST["valor_campo"] : "buscar_por");



        try {

            $sql = "select 
                p.prd_codigo,p.prd_ativo,p.prd_EAN,p.prd_descricao,p.prd_descr_red, 
                p.prd_custo,p.prd_preco,p.prd_unmed,p.prd_quant,p.prd_obs, 
                p.for_codigo,f.for_fantasia,p.cat_codigo,c.cat_descricao 
                from produtos p 
                left outer join fornecedores f on f.for_codigo = p.for_codigo 
                left outer join categorias c on c.cat_codigo = p.cat_codigo  
                where  p.prd_descricao  like '%" . $valor_campo . "%'   and p.ID_CPF_EMPRESA = :ID_CPF_EMPRESA  order by p.prd_descricao";

            $statement_sql = ConPDO::getInstance()->prepare($sql);
            $statement_sql->bindValue(":ID_CPF_EMPRESA", $produto->getID_CPF_EMPRESA());
            $statement_sql->execute();            
            return $this->fetch_array($statement_sql);
        } catch (PDOException $e) {
            print "Erro em M_buscaProdutosFiltroCombo :: " . $e->getMessage();
        }
    }

    public function M_excluirProduto(ProdutoBean $produto) {
        try {
            $sql = "delete from produtos  where ID_CPF_EMPRESA=:ID_CPF_EMPRESA and prd_codigo = :prd_codigo";
            $statement_sql = ConPDO::getInstance()->prepare($sql);
            $statement_sql->bindValue(":ID_CPF_EMPRESA", $produto->getID_CPF_EMPRESA());
            $statement_sql->bindValue(":prd_codigo", $produto->getPrd_codigo());
            return $statement_sql->execute();
        } catch (PDOException $e) {
            Util::getErrorPDOException($e, 'PRODUTOS', 'ENRTADA DE PRODUTOS , VENDA , IMGAGENS DE PRODUTOS', $produto->getPrd_codigo(), $produto->getID_CPF_EMPRESA(),'https://dev.mysql.com/doc/refman/5.5/en/error-messages-server.html#error_er_row_is_referenced_2');
        }
    }

    public function M_buscaProdutosFiltroCombo_ComPaginacao($inicio, $quantidade_itens_por_pagina, ProdutoBean $produto) {



        try {

            $sql = "select 
                p.prd_codigo,p.prd_ativo,p.prd_EAN,p.prd_descricao,p.prd_descr_red, 
                p.prd_custo,p.prd_preco,p.prd_unmed,p.prd_quant,p.prd_obs, 
                p.for_codigo,f.for_fantasia,p.cat_codigo,c.cat_descricao 
                from produtos p 
                left outer join fornecedores f on f.for_codigo = p.for_codigo 
                left outer join categorias c on c.cat_codigo = p.cat_codigo  
                where   p.ID_CPF_EMPRESA = :ID_CPF_EMPRESA  order by p.prd_descricao asc limit $inicio,$quantidade_itens_por_pagina  ";

            $statement_sql = ConPDO::getInstance()->prepare($sql);
            $statement_sql->bindValue(":ID_CPF_EMPRESA", $produto->getID_CPF_EMPRESA());
            $statement_sql->execute();           
            return $this->fetch_array($statement_sql);
        } catch (PDOException $e) {
            print "Erro em M_buscaProdutosFiltroCombo :: " . $e->getMessage();
        }
    }

    public function m_EXCLUIR_PRODUTOS_ID_CPF_EMPRESA($ID_CPF_EMPRESA) {
        try {
            $sql = "delete from produtos where ID_CPF_EMPRESA=:ID_CPF_EMPRESA";
            $statement_sql = ConPDO::getInstance()->prepare($sql);
            $statement_sql->bindValue(":ID_CPF_EMPRESA", $ID_CPF_EMPRESA);
            return $statement_sql->execute();
        } catch (PDOException $e) {
            print "Erro em m_EXCLUIR_PRODUTOS_ID_CPF_EMPRESA :: " . $e->getMessage();
        }
    }

}
