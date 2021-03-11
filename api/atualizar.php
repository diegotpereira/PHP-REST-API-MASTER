<?php
    header("Access-Control-Allow-Orgin: *");
    header("Access-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    include_once '../config/database.php';
    include_once '../class/funcionario.php';

    $database = new Database();
    $db = $database->getConnetion();

    $item = new Funcionario($db);

    $data = json_decode(file_get_contents("php://input"));

    $item->id = $data->id;

    $item->nome = $data->nome;
    $item->email = $data->email;
    $item->idade = $data->idade;
    $item->funcao = $data->funcao;
    $item->criado = date('Y-m-d H:i:s');

    if ($item->atualizarFuncionario()) {
        # code...
        echo json_encode("Dados do funcionário atualizado!.");
    } else {
        # code...
        echo json_encode("Não foi possível atualizar os dados do funcionário!.");
    }
    

?>