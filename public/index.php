<?php
//Conectando o banco de dados
//require_once: É um comando do PHP que carrega e executa um arquivo externo
//__DIR__: É uma variável mágica do PHP que retorna o caminho absoluto da pasta onde o arquivo atual está salvo no computador.
require_once __DIR__ . '/../config/database.php';

echo "Banco conectado!";

//Consulta sql
$sql = "SELECT * FROM `produtos`";
$stmt = $pdo->query($sql); // vai guardar o resultado da consulta sql
$produtos = $stmt->fetchAll(PDO::FETCH_ASSOC /*indica que cada linha do banco deve vir como um array associativo, onde as chaves do array têm exatamente o mesmo nome das colunas da tabela no banco (ex: $produtos[0]['nome'], $produtos[0]['preco']). */); //pegar todas as linhas do banco de dados e transformar em uma Array
?>

<?php foreach ($produtos as $produto): ?>

<h2><?= $produto['nome'] ?></h2>

<p>
    R$ <?= $produto['preco'] ?>
</p>

<?php endforeach; ?>
<br>
<br>
<br>
<a href="criar.php"><button>Criar um produto</button></a>