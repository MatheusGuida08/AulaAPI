<?php
 
require_once 'models/Bebida.php';
require_once 'config/Database.php';
//inserir referência para as classes que serão usadas
 
echo "<h1>Testando Conexão e Modelo Bebida</h1>";
 
$database = new Database();
$db = $database->getConnection();
 
if (!$db) {
    echo "<p style='color: red;'>Falha na conexão.</p>";
    die(); // Encerra o script se não houver conexão
}
 
echo "<p style='color: green;'>Conexão bem-sucedida!</p>";
 
echo "<h2>Criando um objeto Bebida...</h2>";
 
// Criamos uma instância da classe Pizza, passando a conexão com o banco
$bebida = new Bebida($db);
 
// Atribuímos valores às suas propriedades públicas
$bebida->nome = 'Coca-Cola';
$bebida->tamanho = '350ml';
$bebida->valor = 8.50;
$bebida->categoria = 'NAO_ALCOOLICO';
 
// Vamos inspecionar o objeto!
echo "<pre>"; // A tag <pre> ajuda a formatar a saída do print_r
print_r($bebida);
echo "</pre>";