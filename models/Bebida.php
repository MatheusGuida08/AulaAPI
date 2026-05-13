<?php

class Bebida {
    private $conn;
    private $tabela = 'bebidas';

    public $idBebida;   // ← sem "s"
    public $nome;
    public $tamanho;
    public $valor;
    public $categoria;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function getall() {
        $query = "SELECT idBebida, nome, tamanho, valor, categoria FROM " . $this->tabela;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
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

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->idBebida);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            $this->nome      = $row['nome'];
            $this->tamanho   = $row['tamanho'];
            $this->valor     = $row['valor'];
            $this->categoria = $row['categoria'];
            return true;  // ← adiciona
        }

        return false; // ← adiciona
    }

    public function add(){
    $query = 'INSERT INTO ' . $this->tabela . ' SET nome = :nome, tamanho = :tamanho, valor = :valor, categoria = :categoria';
 
        // Preparar a query
        $stmt = $this->conn->prepare($query);
 
        // Limpar os dados
        $this->nome = htmlspecialchars(strip_tags($this->nome));
        $this->tamanho = htmlspecialchars(strip_tags($this->tamanho));
        $this->valor = htmlspecialchars(strip_tags($this->valor));
        $this->categoria = htmlspecialchars(strip_tags($this->categoria));
 
        // Vincular os parâmetros
        $stmt->bindParam(':nome', $this->nome);
        $stmt->bindParam(':tamanho', $this->tamanho);
        $stmt->bindParam(':valor', $this->valor);
        $stmt->bindParam(':categoria', $this->categoria);
 
        // Executar a query
        if ($stmt->execute()) {
            return true;
        }        
        return false;
}

}