<?php
// Criação da rota getall.php

// Headers obrigatórios
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// Incluir arquivos de banco de dados e modelo
include_once '../../config/Database.php';
include_once '../../models/Bebida.php';

// Instanciar o objeto Database e obter a conexão
$database = new Database();
$db = $database->getConnection();

// Instanciar o objeto Bebida
$bebida = new Bebida($db);

if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    // try{ colocar para demonstrar erro com coluna errada mas lá no método getall em bebida
    // Chamar o método getall() para buscar as bebidas
    $stmt = $bebida->getall();
    $num = $stmt->rowCount();

    // Verificar se mais de 0 registros foram encontrados
    if ($num > 0) {
        // Array de bebidas
        $bebidas_arr = array();

        // Percorrer o resultado da consulta
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            // A função extract transforma $row['nome'] em apenas $nome
            extract($row);

            //Um array que representará um assoc com um elemento para cada bebida
            $bebida_item = array(
                "id" => $idBebida,
                "nome" => $nome,
                "tamanho" => $tamanho,
                "valor" => $valor,
                "categoria" => $categoria
            );

            //array no formato assoc
            array_push($bebidas_arr, $bebida_item);
        }

        // Definir o código de resposta como 200 OK
        http_response_code(200);

        // Mostrar os dados das bebidas em formato JSON
        echo json_encode($bebidas_arr);
    } else {
        // Se nenhuma bebida for encontrada, definir o código de resposta como 404 Not Found
        http_response_code(404);

        // Informar ao usuário que nenhuma bebida foi encontrada
        echo json_encode(
            array("Mensagem" => "Nenhuma bebida encontrada.")
        );
    }
}else {
    // Se o método de requisição não for GET, definir o código de resposta como 405 Method Not Allowed
    http_response_code(405);

    // Informar ao usuário que o método não é permitido
    echo json_encode(
        array("Mensagem" => "Método não permitido.")
    );
}
    // }
// catch (Exception $e) {
//  echo json_encode(array("erro" => $e->getMessage()));
// }