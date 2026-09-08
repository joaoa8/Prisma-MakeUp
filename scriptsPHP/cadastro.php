<?php 
require 'conexao.php';

$nome  = $_POST['name'];
$email = $_POST['email'];
$senha = $_POST['password'];

$check = $pdo->prepare("SELECT id FROM usuarios WHERE email = :email");
$check->bindParam(':email', $email);
$check->execute();

if ($check->fetch()) {
    echo "Email já cadastrado.";
    exit;
}


try{
    $sql = "INSERT INTO usuarios (nome, email, senha) VALUES (:nome, :email, :senha)";
    $stmt = $pdo->prepare($sql);

    $stmt->bindParam(':nome', $nome);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':senha', $senha);

    $stmt->execute();
    header('Location: ../index.php');
    exit;
} catch(PDOException $erro){
    echo "Erro ao salvar: " . $erro->getMessage();
}
?>