<?php
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

$bebida->idBebida = isset($_GET['id']) ? $_GET['id'] : null;

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if ($bebida->idBebida) {
        // Busca a bebida e verifica se foi encontrada
        if ($bebida->get()) {
            $bebidas_arr = array(
                "id"       => $bebida->idBebida,
                "nome"     => $bebida->nome,
                "categoria"=> $bebida->categoria,
                "tamanho"  => $bebida->tamanho,
                "valor"    => $bebida->valor
            );
            echo json_encode($bebidas_arr, JSON_PRETTY_PRINT);
        } else {
            http_response_code(404);
            echo json_encode(
                array("Erro" => "Bebida não encontrada.")
            );
        }
    } else {
        http_response_code(400);
        echo json_encode(
            array("Erro" => "Id não informado.")
        );
    }
} else {
    http_response_code(405);
    echo json_encode(
        array("Mensagem" => "Método não permitido.")
    );
}