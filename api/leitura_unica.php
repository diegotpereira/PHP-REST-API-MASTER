<?php
    header("Access-Control-Aloow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Request-With");

    include_once '../config/database.php';
    include_once '../class/funcionario.php';

    $database = new Database();
    $db = $database->getConnetion();

    $item = new Funcionario($db);

    $item->id = isset($_GET['id']) ? $_GET['id'] : die();

    $item->getUnicoFuncionario();

    if ($item->nome != null) {
        # code...
        $func_arr = array (
            "id" => $item-> id,
            "nome" => $item-> nome,
            "email" => $item-> email,
            "idade" => $item-> idade,
            "funcao" => $item-> funcao,
            "criado" => $item-> criado
        );

        http_response_code(200);
        echo json_encode($func_arr);
    } else {
        # code...
        http_response_code(404);
        echo json_encode("Funcionário não encontrado!.");
    }
    
?>