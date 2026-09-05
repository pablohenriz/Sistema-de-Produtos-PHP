<?php

require_once __DIR__ . '/../config/database.php';

// Buscar categorias do banco
$sql = "SELECT id, nome FROM categorias ORDER BY nome";

$stmt = $pdo->query($sql);

$categorias = $stmt->fetchAll(PDO::FETCH_ASSOC);


// Verificar se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Receber dados
    $nome = trim($_POST['nome'] ?? '');
    $preco = $_POST['preco'] ?? '';
    $categoriaId = $_POST['categoria_id'] ?? '';

    // Validar nome
    if ($nome === '') {
        die('O nome do produto é obrigatório.');
    }

    // Validar preço
    if (!is_numeric($preco) || $preco <= 0) {
        die('O preço precisa ser um número maior que zero.');
    }

    // Validar categoria
    if (!filter_var($categoriaId, FILTER_VALIDATE_INT)) {
        die('Categoria inválida.');
    }

    // SQL
    $sql = "
        INSERT INTO produtos
        (nome, preco, categoria_id)
        VALUES
        (:nome, :preco, :categoria_id)
    ";

    // Preparar SQL
    $stmt = $pdo->prepare($sql);

    // Executar SQL
    $stmt->execute([
        ':nome' => $nome,
        ':preco' => $preco,
        ':categoria_id' => $categoriaId
    ]);

    // Redirecionar depois do cadastro
    header('Location: index.php');
    exit;
}

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">

    <title>Novo Produto</title>
</head>

<body>

    <h1>Novo Produto</h1>

    <form method="POST">

        <div>

            <label for="nome">
                Nome
            </label>

            <input type="text" id="nome" name="nome" required>

        </div>

        <br>

        <div>

            <label for="preco">
                Preço
            </label>

            <input type="number" id="preco" name="preco" step="0.01" min="0.01" required>

        </div>

        <br>

        <div>

            <label for="categoria">
                Categoria
            </label>

            <select id="categoria" name="categoria_id" required>

                <option value="">
                    Selecione
                </option>

                <?php foreach ($categorias as $categoria): ?>

                <option value="<?= $categoria['id'] ?>">
                    <?= htmlspecialchars($categoria['nome']) ?>
                </option>

                <?php endforeach; ?>

            </select>

        </div>

        <br>

        <button type="submit">
            Cadastrar
        </button>

    </form>

</body>

</html>