<?php
session_start();

// Remova todas as variáveis de sessão
session_unset();

// Destrua a sessão
session_destroy();

// Redirecione para a página de login
header("Location: /Projeto/login.html");
exit();
?>
