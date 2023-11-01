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
    <h1>Bem-vindo à página inicial de suporte!</h1>
    <!-- Conteúdo da página inicial aqui -->
    <a href="lista.php">Dash Geral</a> </br>
    </br>
    <a href="logout.php">Sair</a>
</body>
</html>
