<!DOCTYPE html>
<html>
<head>
    <title>Gerenciar Domínios</title>
</head>
<body>
    <h1>Gerenciar Domínios</h1>

    <?php
    // Inicie a sessão
    session_start();

    // Verifique se o usuário está autenticado
    if (!isset($_SESSION['user_authenticated']) || $_SESSION['user_authenticated'] !== true) {
        // Se não estiver autenticado, exiba uma mensagem de erro e um link para retornar ao login
        echo "Login Expirou. <a href='../Projeto/login.html'>Voltar para o login</a>";
        exit();
    }

    // Verifique o user_type do usuário autenticado
    $user_type = $_SESSION['user_type'];

    // Verifique se o usuário é do tipo "superadmin"
    if ($user_type !== "superadmin") {
        // Se não for "superadmin", exiba uma mensagem de falta de autorização
        echo "Você não tem permissão para acessar esta página.";
        exit();
    }
    ?>

    <h2>Bem-vindo!</h2>

    <!-- Link para criar domínios -->
    <a href="criar_dominio.php">Criar Domínio</a>
    </br>
    <!-- Link para gerenciar domínios existentes -->
    <a href="gerenciar_dominios_existentes.php">Gerenciar Domínios Existentes</a>
    </br>
    <a href="home_superadmin.php">voltar</a>


</body>
</html>
