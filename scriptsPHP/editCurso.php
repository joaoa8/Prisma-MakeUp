<?php
require 'conexao.php';

$id           = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
$nome         = trim($_POST['nome'] ?? '');
$categoria    = trim($_POST['categoria'] ?? '');
$nivel        = trim($_POST['nivel'] ?? '');
$carga_horaria = filter_input(INPUT_POST, 'carga_horaria', FILTER_VALIDATE_INT);
$preco        = trim($_POST['preco'] ?? '');
$prerequisitos = trim($_POST['prerequisitos'] ?? '');
$descricao    = trim($_POST['descricao'] ?? '');

if (!$id || $nome === '') {
    header('Location: ../pages/CRUD/admin.php');
    exit;
}

try {
    $stmt = $pdo->prepare("UPDATE cursos SET nome=:nome, categoria=:categoria, nivel=:nivel,
        carga_horaria=:carga_horaria, preco=:preco, prerequisitos=:prerequisitos, descricao=:descricao
        WHERE id=:id");
    $stmt->execute([
        ':id' => $id, ':nome' => $nome, ':categoria' => $categoria,
        ':nivel' => $nivel, ':carga_horaria' => $carga_horaria,
        ':preco' => $preco, ':prerequisitos' => $prerequisitos, ':descricao' => $descricao,
    ]);
    header('Location: ../pages/CRUD/admin.php');
} catch (PDOException $e) {
    echo "Erro: " . $e->getMessage();
}
exit;
