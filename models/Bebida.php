<?php

class Bebida{
    private $conn;
    private $tabela = 'bebidas';

    public $idBebidas;
    public $nome;
    public $tamanho;
    public $valor;

    public $categoria;

    public function __construct($db) {
        $this-> conn = $db;
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
}