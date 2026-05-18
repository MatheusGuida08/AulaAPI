<?php

class Pizza
{
    private $conn;
    private $tabela = 'pizzas';

    public $idPizza;
    public $nome;
    public $ingredientes;
    public $valor;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function getall()
    {
        //Salvando a query SQL em uma variável
        $query = "SELECT idPizza, nome, ingredientes, valor FROM " . $this->tabela;

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
        idPizza,
        nome,
        ingredientes,
        valor
    FROM
        ' . $this->tabela . '
    WHERE
        idPizza = ?
    LIMIT 1';

    // Prepara a query
    $stmt = $this->conn->prepare($query);

    // Vincula o ID
    $stmt->bindParam(1, $this->idPizza);

    // Executa a query
    $stmt->execute();

    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    // Verifica se encontrou a pizza
    if ($row) {
        $this->nome         = $row['nome'];
        $this->ingredientes = $row['ingredientes'];
        $this->valor        = $row['valor'];
        return true;
    }
    return false;
}

public function add(){
    $query = 'INSERT INTO ' . $this->tabela . ' SET nome = :nome, ingredientes = :ingredientes, valor = :valor';
 
        // Preparar a query
        $stmt = $this->conn->prepare($query);
 
        // Limpar os dados
        $this->nome = htmlspecialchars(strip_tags($this->nome));
        $this->ingredientes = htmlspecialchars(strip_tags($this->ingredientes));
        $this->valor = htmlspecialchars(strip_tags($this->valor));
 
        // Vincular os parâmetros
        $stmt->bindParam(':nome', $this->nome);
        $stmt->bindParam(':ingredientes', $this->ingredientes);
        $stmt->bindParam(':valor', $this->valor);
 
        // Executar a query
        if ($stmt->execute()) {
            return true;
        }        
        return false;
}

public function update() {
        // Query de atualização
        $query = 'UPDATE ' . $this->tabela . ' SET nome=:nome, ingredientes=:ingredientes, valor=:valor WHERE idPizza=:id';
 
        // Preparar a query
        $stmt = $this->conn->prepare($query);
 
        // Limpar os dados
        $this->nome = htmlspecialchars(strip_tags($this->nome));
        $this->ingredientes = htmlspecialchars(strip_tags($this->ingredientes));
        $this->valor = htmlspecialchars(strip_tags($this->valor));
        $this->idPizza = htmlspecialchars(strip_tags($this->idPizza));
 
        // Vincular os parâmetros
        $stmt->bindParam(':nome', $this->nome);
        $stmt->bindParam(':ingredientes', $this->ingredientes);
        $stmt->bindParam(':valor', $this->valor);
        $stmt->bindParam(':id', $this->idPizza);
 
        // Executar a query
        if($stmt->execute()) {
            return true;
        }
     
        return false;
    }

}