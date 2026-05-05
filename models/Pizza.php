<?php

class Pizza{
    private $conn;
    private $tabela = 'pizzas';

    public $idPizza;
    public $nome;
    public $ingredientes;
    public $valor;

    public function __construct($db) {
        $this-> conn = $db;
    }

    public function getall(){
        //Salvando a query SQL em uma variável
        $query = "SELECT idPizza, nome, ingredientes, valor FROM " . $this->tabela;

        //Preparando a query para ser executada, usando a conexão com o banco de dados
        $stmt = $this->conn->prepare($query);

        //Executando a query no Banco de Dados
        $stmt->execute();

        //Retornando o resultado da query
        return $stmt;
    }
}