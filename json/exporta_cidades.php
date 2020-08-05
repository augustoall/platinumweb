<?php

//error_reporting(E_ALL ^ E_NOTICE);



    require_once '../includes/load__class__file_path_1.php';

    $cidadeInstance = new CidadesInstace();
    $cidadeBean = new CidadesBean();

    $cidadeBean = $cidadeInstance->c_busca_todas_cidades();
    
 
    
    
    $cidade['cidade_array'] = $cidadeBean;
    json_encode($cidadeBean);

    $resposta["cidade_array"] = array();
    foreach ($cidadeBean as $cid) {

        $c = array();
        $c["cid_codigo"] = $cid->getCid_codigo();
        $c["cid_nome"] = $cid->getCid_nome();
        $c["cid_uf"] = $cid->getCid_uf();

        array_push($resposta["cidade_array"], $c);
    }

    echo json_encode($resposta);

?>

