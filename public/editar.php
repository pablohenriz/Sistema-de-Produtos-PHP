<?php
$sql = "
    SELECT
        p.id,
        p.nome,
        p.preco,
        p.imagem,
        c.nome AS categoria
    FROM produtos p
    INNER JOIN categorias c
        ON c.id = p.categoria_id
    WHERE p.id = :id
";

$stmt = $pdo->prepare($sql);

$stmt->execute([
    ':id' => $id
]);

$produto = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1>
        Editar Produto
    </h1>
    <form method="GET">
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