<html>
    <head>
        <title></title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="shortcut icon" href="//www.gstatic.com/mobilesdk/160503_mobilesdk/logo/favicon.ico">
        <link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.6.0/pure-min.css">

        <style type="text/css">
            body{
            }
            div.container{
                width: 1000px;
                margin: 0 auto;
                position: relative;
            }
            legend{
                font-size: 30px;
                color: #555;
            }
            .btn_send{
                background: #00bcd4;
            }
            label{
                margin:10px 0px !important;
            }
            textarea{
                resize: none !important;
            }
            .fl_window{
                width: 400px;
                position: absolute;
                right: 0;
                top:100px;
            }
            pre, code {
                padding:10px 0px;
                box-sizing:border-box;
                -moz-box-sizing:border-box;
                webkit-box-sizing:border-box;
                display:block; 
                white-space: pre-wrap;  
                white-space: -moz-pre-wrap; 
                white-space: -pre-wrap; 
                white-space: -o-pre-wrap; 
                word-wrap: break-word; 
                width:100%; overflow-x:auto;
            }

        </style>
    </head>
    <body>
        <?php
        require_once '../../FCM/Firebase.php';
        require_once '../../FCM/Push.php';
        require_once '../../includes/load__class__file_path_2.php';

        $firebase = new Firebase();
        $push = new Push();
        $chlicencaBean = new ChaveLicencaBean();
        $chave_licenca = new ChaveLicencaInstance();
        $log = new LogInstance();

        $usubean = new UsuariosBean();
        $usuario = new UsuariosInstance();


        $registration_id = (isset($_POST["registration_id"])) ? $_POST["registration_id"] : ((isset($_GET["registration_id"])) ? $_GET["registration_id"] : "");

        $title = isset($_GET['title']) ? $_GET['title'] : '';
        $message = isset($_GET['message']) ? $_GET['message'] : '';
        $push_type = isset($_GET['push_type']) ? $_GET['push_type'] : '';
        $img = isset($_GET['img']) ? $_GET['img'] : '';
        $fbs_type = isset($_GET['fbs_type']) ? $_GET['fbs_type'] : '';

        // var pra uso no log
        $emp_celkey = isset($_GET['emp_celularkey']) ? $_GET['emp_celularkey'] : '';
        $numero_celular = isset($_GET['numero_celular']) ? $_GET['numero_celular'] : '';
        $usu_codigo = isset($_GET['usu_codigo']) ? $_GET['usu_codigo'] : '';
        $ID_CPF_EMPRESA = isset($_GET['ID_CPF_EMPRESA']) ? $_GET['ID_CPF_EMPRESA'] : '';
        $email = isset($_GET['email']) ? $_GET['email'] : '';


        $usubean = $usuario->c_busca_usuario_por_celkey($emp_celkey);


        $push->setTitle($title);
        $push->setMessage($message);
        $push->setImage($img);
        $push->setFbs_type($fbs_type);


        $json = '';
        $response = '';

        if ($push_type == 'individual') {
            $json = $push->getPush();
            $response = $firebase->send($registration_id, $json);

            if ($response != '') {
                $log->c_inserir_log("LICENCA", "ENVIO DA LICENÇA [[ " . $message . " ]] PARA  ::: " . $numero_celular, $numero_celular, $usu_codigo, date('Y-m-d H:i:s'), $email, $ID_CPF_EMPRESA);
            }
        }
        ?>
        <div class="container">
            <div class="fl_window">
                <div><img src="http://api.androidhive.info/images/firebase_logo.png" width="200" alt="Firebase"/></div>
                <br/>
                <?php if ($json != '') { ?>
                    <label><b>Request:</b></label>
                    <div class="json_preview">
                        <pre><?php echo json_encode($json) ?></pre>
                    </div>
                <?php } ?>
                <br/>
                <?php if ($response != '') { ?>
                    <label><b>Response:</b></label>
                    <div class="json_preview">
                        <pre><?php echo json_encode($response) ?></pre>
                    </div>
                <?php } ?>

            </div>

            <form class="pure-form pure-form-stacked" method="get">
                <fieldset>
                    <legend>Envio de mensagem única com base no registro ID</legend>

                    <label for="redId">Firebase Registro Id</label>
                    <input type="text" id="registration_id" readonly name="registration_id" class="pure-input-1-2" value="<?php echo ($registration_id) ? $registration_id : 0 ?>" >

                    <label for="title">Título da Mensagem</label>
                    <input type="text" readonly id="title" value="CHAVE DE ACESSO" name="title" class="pure-input-1-2" placeholder="Enter title">

                    
                     <label for="title">Licenças</label>
                    <select  name="message" >
                        <?php
                        $chlicencaBean = $chave_licenca->c_buscar_chaves_licencas_nao_usadas();
                        foreach ($chlicencaBean as $licenca) {
                            ?>
                            <option value="<?php echo $licenca->getLic_chave() ?>"> <?php echo $licenca->getLic_chave() . '  dias ' . $licenca->getLic_dias() . '  status ' . $licenca->getLic_status() ?></option>
                        <?php } ?>
                    </select>

                    <label for="title">Url da imagem</label>
                    <input type="text" id="img" name="img" class="pure-input-1-2" placeholder="Url Ex: http://seusite.com.br/minha_imagem.png">

                    <input type="hidden" name="fbs_type" value="LIC"/>
                    <input type="hidden" name="email" value="<?php echo $usubean->getUsu_email() ?>"/>
                    <input type="hidden" name="emp_celularkey" value="<?php echo $usubean->getUsu_celularkey() ?>"/>
                    <input type="hidden" name="numero_celular" value="<?php echo $usubean->getUsu_numerocelular() ?>"/>
                    <input type="hidden" name="usu_codigo" value="<?php echo $usubean->getUsu_codigo() ?>"/>
                    <input type="hidden" name="ID_CPF_EMPRESA" value="<?php echo $usubean->getID_CPF_EMPRESA() ?>"/>
                    <input type="hidden" name="push_type" value="individual"/>
                    <button type="submit" class="pure-button pure-button-primary btn_send">Enviar</button>
                </fieldset>
            </form>   
        </div>
    </body>
</html>