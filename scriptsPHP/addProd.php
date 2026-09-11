<?php 
require 'conexao.php';

$categoria  = $_POST['category'];
$nome       = $_POST['name'];
$descricao  = $_POST['description'] ?? null;
$conteudo   = $_POST['conteudo'] . ' ' . $_POST['conteudo_unidade'];
$preco      = $_POST['price'];
$estoque    = $_POST['stock'];
$indicacao  = $_POST['indicacao'] ?? null;
$cuidados   = $_POST['cuidados'] ?? null;
$validade   = $_POST['validade'];
$informacoes = $_POST['informacoes'] ?? null;

$check = $pdo->prepare("SELECT id FROM produtos WHERE nome = :nome");
$check->bindParam(':nome', $nome);
$check->execute();

if ($check->fetch()) {
    header('Location: ../pages/CRUD/cadProd.php?erro=produto_existente');
    exit;
}

try{
    $sql = "INSERT INTO produtos (categoria, nome, descricao, conteudo, preco, estoque, indicacao, cuidados, validade, informacoes) 
            VALUES (:categoria, :nome, :descricao, :conteudo, :preco, :estoque, :indicacao, :cuidados, :validade, :informacoes)";
    $stmt = $pdo->prepare($sql);

    $stmt->bindParam(':categoria', $categoria);
    $stmt->bindParam(':nome', $nome);
    $stmt->bindParam(':descricao', $descricao);
    $stmt->bindParam(':conteudo', $conteudo);
    $stmt->bindParam(':preco', $preco);
    $stmt->bindParam(':estoque', $estoque, PDO::PARAM_INT);
    $stmt->bindParam(':indicacao', $indicacao);
    $stmt->bindParam(':cuidados', $cuidados);
    $stmt->bindParam(':validade', $validade);
    $stmt->bindParam(':informacoes', $informacoes);

    $stmt->execute();
    header('Location: ../pages/CRUD/cadProd.php?sucesso=cadastro');
    exit;
} catch(PDOException $erro){
    echo "Erro: " . $erro->getMessage();
    exit;
}


?>