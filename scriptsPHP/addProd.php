<?php 
require 'conexao.php';

$categoria = $_POST['categoria'];
$nome = $_POST['nome'];
$descricao = $_POST['descricao'];
$conteudo = $_POST['conteudo'];
$preco = $_POST['preco'];
$indicacao = $_POST['indicacao'];
$cuidados = $_POST['cuidados'];
$validade = $_POST['validade'];
$informacoes = $_POST['informacoes'];

$check = $pdo->prepare("SELECT id FROM produtos WHERE nome = :nome");
$check->bindParam(':nome', $nome);
$check->execute();

if ($check->fetch()) {
    header('Location: ../pages/cadProd.php?erro=produto_existente');
    exit;
}

try{
    $sql = "INSERT INTO produtos (categoria, nome, descricao, conteudo, preco, indicacao, cuidados, validade, informacoes) 
            VALUES (:categoria, :nome, :descricao, :conteudo, :preco, :indicacao, :cuidados, :validade, :informacoes)";
    $stmt = $pdo->prepare($sql);

    $stmt->bindParam(':categoria', $categoria);
    $stmt->bindParam(':nome', $nome);
    $stmt->bindParam(':descricao', $descricao);
    $stmt->bindParam(':conteudo', $conteudo);
    $stmt->bindParam(':preco', $preco);
    $stmt->bindParam(':indicacao', $indicacao);
    $stmt->bindParam(':cuidados', $cuidados);
    $stmt->bindParam(':validade', $validade);
    $stmt->bindParam(':informacoes', $informacoes);

    $stmt->execute();
    header('Location: ../pages/cadProd.php?sucesso=cadastro');
    exit;
} catch(PDOException $erro){
    header('Location: ../pages/cadProd.php?erro=servidor');
    exit;
}


?>