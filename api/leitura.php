<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");

    include_once '../config/database.php';
    include_once '../class/funcionario.php';

    $database = new Database();
    $db = $database->getConnetion();

    $items = new Funcionario($db);

    $stmt = $items->getFuncionarios();
    $itemCount = $stmt->rowCount();

    echo json_encode($itemCount);

    if ($itemCount >0 ) {
        # code...
        $funcionarioArr =  array();
        $funcionarioArr ["body"] = array();
        $funcionarioArr["itemCount"] = $itemCount;

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            # code...
            extract($row);
            $e = array(
                "id" => $id,
                "nome" => $nome,
                "email" => $email,
                "idade" => $idade,
                "funcao" => $funcao,
                "criado" => $criado
            );
            array_push($funcionarioArr["body"], $e);
        }
        echo json_encode($funcionarioArr);
    } else {
        # code...
        http_response_code(404);
        echo json_encode(
            array("message" => "Nenhuma gravação encontrada.")
        );
    }
    

?>