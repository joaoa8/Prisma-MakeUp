<?php 
$host = 'localhost';
$bdnome = 'prisma';
$usuario = 'root';
$senha = '';

try{
    $dsn = "mysql:host=" . $host . ";dbname=" . $bdnome . ";charset=utf8mb4";
    $pdo = new PDO($dsn, $usuario, $senha);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}catch(PDOException $erro){
    echo "Erro de conexão: " . $erro->getMessage();
    exit;
}
?>