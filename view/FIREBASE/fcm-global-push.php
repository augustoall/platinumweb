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

        $firebase = new Firebase();
        $push = new Push();


        $title = isset($_GET['title']) ? $_GET['title'] : '';
        $message = isset($_GET['message']) ? $_GET['message'] : '';
        $push_type = isset($_GET['push_type']) ? $_GET['push_type'] : '';
        $img = isset($_GET['img']) ? $_GET['img'] : '';

        $push->setTitle($title);
        $push->setMessage($message);
        $push->setImage($img);
        $push->setFbs_type("all");

        $json = '';
        $response = '';

        if ($push_type == 'topic') {
            $json = $push->getPush();
            $response = $firebase->sendToTopic('global', $json);
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
                    <legend>Mensagem Global - Todos os celulares receberão a notificação</legend>

                    <label for="title1">Titulo</label>
                    <input type="text" id="title1" name="title" class="pure-input-1-2" placeholder="titulo da mensagem">

                    <label for="message1">Mensagem</label>
                    <textarea class="pure-input-1-2" name="message" id="message1" rows="5" placeholder="Notificação"></textarea>

                    <label for="title">Url da imagem</label>
                    <input type="text" id="img" name="img" class="pure-input-1-2" placeholder="Url Ex: http://seusite.com.br/minha_imagem.png">

                    <input type="hidden" name="push_type" value="topic"/>
                    <button type="submit" class="pure-button pure-button-primary btn_send">Enviar</button>
                </fieldset>
            </form>
        </div>
    </body>
</html>
