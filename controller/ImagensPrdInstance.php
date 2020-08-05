<?php

class ImagensPrdInstance {

    public function c_busca_imagens_produto($ID_CPF_EMPRESA, $prd_codigo) {
        $imagem = new ImagensPrdBean();
        $imagem->setID_CPF_EMPRESA($ID_CPF_EMPRESA);
        $imagem->setPrd_codigo($prd_codigo);
        return ImagensPrdDao::getInstance()->m_busca_imagens_produto($imagem);
    }

    public function c_busca_todas_imagens_prd($ID_CPF_EMPRESA) {
        $imagem = new ImagensPrdBean();
        $imagem->setID_CPF_EMPRESA($ID_CPF_EMPRESA);
        return ImagensPrdDao::getInstance()->m_busca_todas_imagens_prd($imagem);
    }

    public function c_excluir_imagem($ID_CPF_EMPRESA) {
        $imagem = new ImagensPrdBean();
        $imagem->setID_CPF_EMPRESA($ID_CPF_EMPRESA);
        $imagem->setImg_codigo($_GET["img_codigo"]);
        return ImagensPrdDao::getInstance()->m_excluir_imagem($imagem);
    }

    public function c_gravar_imagem($ID_CPF_EMPRESA, $nome_imagem, $prd_codigo) {
        $imagem = new ImagensPrdBean();
        $imagem->setID_CPF_EMPRESA($ID_CPF_EMPRESA);
        $imagem->setImg_descricao(trim($nome_imagem));
        $imagem->setPrd_codigo($prd_codigo);
        return ImagensPrdDao::getInstance()->m_gravar_imagem($imagem);
    }

}

?>
