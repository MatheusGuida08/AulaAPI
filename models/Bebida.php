<?php

class Bebida{
    private $conn;
    private $tabela = 'bebidas';

    public $idBebida;
    public $nome;
    public $tamanho;
    public $valor;

    public $categoria;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function getall(){
        //Salvando a query SQL em uma variável
        $query = "SELECT idBebida, nome, tamanho, valor, categoria FROM " . $this->tabela;

        //Preparando a query para ser executada, usando a conexão com o banco de dados
        $stmt = $this->conn->prepare($query);

        //Executando a query no Banco de Dados
        $stmt->execute();

        //Retornando o resultado da query
        return $stmt;
    }

    public function get()
    {
        $query = 'SELECT
            idBebida,
            nome,
            tamanho,
            valor,
            categoria           
        FROM
            ' . $this->tabela . '
        WHERE
            idBebida = ?
        LIMIT 1';

        // Prepara a query
        $stmt = $this->conn->prepare($query);

        // Vincula o ID
        $stmt->bindParam(1, $this->idBebida);

        // Executa a query
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            // Define as propriedades
            $this->nome = $row['nome'];
            $this->tamanho = $row['tamanho'];
            $this->valor = $row['valor'];
            $this->categoria = $row['categoria'];
        }
    }
}