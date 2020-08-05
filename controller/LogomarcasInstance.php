<?php

class LogomarcasInstance {

    function __construct() {
        
    }

    public function c_gravar_logomarca($ID_CPF_EMPRESA) {

        $logo = new LogomarcasBean();
        $pasta = "../view/LOGOMARCAS/img_logos/";
        $permitidos = array(".jpg", ".jpeg", ".png", ".bmp");
        $nome_imagem = $_FILES['logomarca']['name'];
        $tamanho_imagem = $_FILES['logomarca']['size'];
        $ext = strtolower(strrchr($nome_imagem, "."));

        if (in_array($ext, $permitidos)) {

            $tamanho = round($tamanho_imagem / 1024);

            if ($tamanho < 1024) { //se imagem for até 1MB envia
              
                $tmp = $_FILES['logomarca']['tmp_name']; //caminho temporário da imagem  

                if (move_uploaded_file($tmp, $pasta . trim($nome_imagem))) {

                    $image = WideImage::load($pasta . trim($nome_imagem));
                    $resized = $image->resize(250, 90, 'inside');
                    $resized->saveToFile($pasta . trim($nome_imagem));
                    $logo->setID_CPF_EMPRESA($ID_CPF_EMPRESA);
                    $logo->setLgm_nomelogo($nome_imagem);


                    return LogomarcasDao::getInstance()->m_gravar_logomarca($logo);
                } else {
                    echo "Falha ao enviar";
                }
            } else {
                echo "A imagem deve ser de no máximo 1MB";
            }
        } else {
            echo "Somente são aceitos arquivos do tipo Imagem";
        }
    }

    public function c_buscar_logomarca($ID_CPF_EMPRESA) {
        $logo = new LogomarcasBean();
        $logo->setID_CPF_EMPRESA($ID_CPF_EMPRESA);
        return LogomarcasDao::getInstance()->m_buscar_logomarca($logo);
    }

}

?>
