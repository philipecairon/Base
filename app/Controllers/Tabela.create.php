<?php
    header ('Content-type: text/html; charset=UTF-8');
    require_once "Connection.php";

    $name   = "Nome da empresa";
    $site   = "http://suaempresa.com";
    $cnpj   = "000000000000000";
    $token  = "jbg8Y9uWjtqHgNVugHP4YwxTxv4ASY9x";
    $path   = "caminho";
    $logo   = "logo";
    $block  = "0";
    $date   = "2015-02-16";

    $data = array(
        'c_name'    =>  $name,
        'c_site'    =>  $site,
        'c_cnpj'    =>  $cnpj,
        'c_token'   =>  $token,
        'c_path'    =>  $path,
        'c_logo'    =>  $logo,
        'c_block'   =>  $block,
        'c_date'    =>  $date
    );

    $exemplo = Tabela::create($data);

    echo "Criado com sucesso!";