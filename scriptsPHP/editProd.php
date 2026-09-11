<?php
require 'conexao.php';

$id        = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
$nome      = trim($_POST['nome'] ?? '');
$categoria = trim($_POST['categoria'] ?? '');
$preco     = trim($_POST['preco'] ?? '');
$estoque   = filter_input(INPUT_POST, 'estoque', FILTER_VALIDATE_INT);
$conteudo  = trim($_POST['conteudo'] ?? '');
$validade  = trim($_POST['validade'] ?? '');
$descricao = trim($_POST['descricao'] ?? '');
$indicacao = trim($_POST['indicacao'] ?? '');
$cuidados  = trim($_POST['cuidados'] ?? '');
$informacoes = trim($_POST['informacoes'] ?? '');

if (!$id || $nome === '' || $preco === '') {
    header('Location: ../pages/CRUD/admin.php');
    exit;
}

try {
    $stmt = $pdo->prepare("UPDATE produtos SET nome=:nome, categoria=:categoria, preco=:preco, estoque=:estoque,
        conteudo=:conteudo, validade=:validade, descricao=:descricao, indicacao=:indicacao,
        cuidados=:cuidados, informacoes=:informacoes WHERE id=:id");
    $stmt->execute([
        ':id' => $id, ':nome' => $nome, ':categoria' => $categoria,
        ':preco' => $preco, ':estoque' => $estoque, ':conteudo' => $conteudo,
        ':validade' => $validade, ':descricao' => $descricao, ':indicacao' => $indicacao,
        ':cuidados' => $cuidados, ':informacoes' => $informacoes,
    ]);
    header('Location: ../pages/CRUD/admin.php');
} catch (PDOException $e) {
    echo "Erro: " . $e->getMessage();
}
exit;
