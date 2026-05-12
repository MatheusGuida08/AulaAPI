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
}