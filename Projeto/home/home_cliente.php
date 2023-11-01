<?php
session_start(); // Inicie a sessão

// Verifique se o usuário está autenticado
if (!isset($_SESSION['user_authenticated']) || $_SESSION['user_authenticated'] !== true) {
    // Se não estiver autenticado, exiba uma mensagem de erro e um link para retornar ao login
    echo "Login Expirou. <a href='../Projeto/login.html'>Voltar para o login</a>";
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Página Inicial</title>
</head>
<body>
    <h1>Bem-vindo à página inicial de Cliente!</h1>
    <a href="ticket.php">Criar Ticket</a> </br>
    <a href="lista.php">Dash Pessoal</a> </br>
    <a href="logout.php">Sair</a>
</html>