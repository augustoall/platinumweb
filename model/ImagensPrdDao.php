<?php

class ImagensPrdDao {

    public static $instance;

    public function __construct() {
        
    }

    static public function getInstance() {
        if (!isset(self::$instance))
            self::$instance = new ImagensPrdDao();
        return self::$instance;
    }

    public function m_gravar_imagem(ImagensPrdBean $img) {

        try {
            $sql = "insert into imagensprd (ID_CPF_EMPRESA,img_descricao,prd_codigo) values (:ID_CPF_EMPRESA,:img_descricao,:prd_codigo)  ";
            $statement_sql = ConPDO::getInstance()->prepare($sql);

            $statement_sql->bindValue(":ID_CPF_EMPRESA", $img->getID_CPF_EMPRESA());
            $statement_sql->bindValue(":img_descricao", $img->getImg_descricao());
            $statement_sql->bindValue(":prd_codigo", $img->getPrd_codigo());
            return $statement_sql->execute();
        } catch (PDOException $e) {
            print "Erro em m_gravar_imagem :: " . $e->getMessage();
        }
    }

    public function m_busca_imagens_produto(ImagensPrdBean $img) {

        try {

            $sql = "select * from imagensprd where ID_CPF_EMPRESA= :ID_CPF_EMPRESA  and prd_codigo= :prd_codigo ";

            $statement_sql = ConPDO::getInstance()->prepare($sql);
            $statement_sql->bindValue(":ID_CPF_EMPRESA", $img->getID_CPF_EMPRESA());
            $statement_sql->bindValue(":prd_codigo", $img->getPrd_codigo());
            $statement_sql->execute();
            return $this->fetch_imagens($statement_sql);
        } catch (PDOException $e) {
            print "Erro em m_busca_imagens_produto :: " . $e->getMessage();
        }
    }

    public function m_busca_todas_imagens_prd(ImagensPrdBean $img) {
        try {

            $sql = "SELECT 
                img.ID_CPF_EMPRESA,
                img.img_codigo,
                img.img_descricao, 
                prd.prd_descricao, 
                prd.prd_preco,
                prd.prd_codigo FROM imagensprd img left outer join produtos prd on prd.prd_codigo = img.prd_codigo where img.ID_CPF_EMPRESA= :ID_CPF_EMPRESA ";

            $statement_sql = ConPDO::getInstance()->prepare($sql);
            $statement_sql->bindValue(":ID_CPF_EMPRESA", $img->getID_CPF_EMPRESA());
            $statement_sql->execute();
            return $this->fetch_imagens($statement_sql);
        } catch (PDOException $e) {
            print "Erro em m_busca_imagens_produto :: " . $e->getMessage();
        }
    }

    private function fetch_imagens($statement_sql) {
        $results = array();

        if ($statement_sql) {
            while ($linha = $statement_sql->fetch(PDO::FETCH_OBJ)) {
                $img = new ImagensPrdBean();
                $img->setImg_codigo($linha->img_codigo);
                $img->setID_CPF_EMPRESA($linha->ID_CPF_EMPRESA);
                $img->setImg_descricao($linha->img_descricao);
                $img->setPrd_codigo($linha->prd_codigo);
                $img->setPrd_descricao($linha->prd_descricao);
                $img->setPrd_preco($linha->prd_preco);
                $results [] = $img;
            }
        }

        return $results;
    }

    public function m_EXCLUIR_IMAGENSPRD_ID_CPF_EMPRESA($ID_CPF_EMPRESA) {
        try {
            $sql = "delete from imagensprd where ID_CPF_EMPRESA=:ID_CPF_EMPRESA";
            $statement_sql = ConPDO::getInstance()->prepare($sql);
            $statement_sql->bindValue(":ID_CPF_EMPRESA", $ID_CPF_EMPRESA);
            return $statement_sql->execute();
        } catch (PDOException $e) {
            print "Erro em m_EXCLUIR_IMAGENSPRD_ID_CPF_EMPRESA :: " . $e->getMessage();
        }
    }

    public function m_excluir_imagem(ImagensPrdBean $img) {
        try {
            $sql = "delete from imagensprd where ID_CPF_EMPRESA=? and img_codigo=?";
            $statement_sql = ConPDO::getInstance()->prepare($sql);
            $statement_sql->bindValue(1, $img->getID_CPF_EMPRESA());
            $statement_sql->bindValue(2, $img->getImg_codigo());
            return $statement_sql->execute();
        } catch (PDOException $e) {
            print "Erro em m_excluir_imagem :: " . $e->getMessage();
        }
    }

}
?>

