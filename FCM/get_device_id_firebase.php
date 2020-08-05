<?php

if (!isset($_POST["emp_celularkey"]) || !isset($_POST["device_id_firebase"])) {
    $resposta["mensagem"] = "POST ERROR";
    echo json_encode($resposta);
    exit();
}

require_once '../includes/load__class__file_path_1.php';

$fireBean = new FirebaseInstance();

$fireBean->c_delete_device_firebase($_POST["emp_celularkey"]);
$fireBean->c_save_device_firebase('00000000000', $_POST["emp_celularkey"], $_POST["device_id_firebase"]);

$resposta["mensagem"] = "sucesso";
echo json_encode($resposta);
