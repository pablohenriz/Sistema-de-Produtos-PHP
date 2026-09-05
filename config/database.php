<?php 

//Informacoes base para acessar o banco de dados
$host = 'localhost';
$dbname = 'cadastrador_produtos';
$username = 'root';
$password = '';

try {
    //Criando um objeto para poder acessar o banco
    $pdo = new PDO (
        "mysql:host=$host;dbname=$dbname;charset=utf8mb4",
        $username,
        $password
    );
    
    //Permite mostrar falhas e erros no sql em alguma consulta
    $pdo->setAttribute(
        // o :: permite acessar a estrutura de uma classe sem ter que criar um objeto com comando new
        PDO::ATTR_ERRMODE, //O que faz: Informa ao método setAttribute() qual é a regra de comportamento que você deseja alterar na sua conexão. (define as regras)
        PDO::ERRMODE_EXCEPTION //O que faz: Define que o comportamento escolhido para os erros será lançar uma exceção (PDOException) imediatamente quando qualquer falha em comandos SQL acontecer. (para tudo se der ruim)
    );
} catch (PDOException $e) {
    die("Erro ao conectar ao banco de dados.");
}
?>