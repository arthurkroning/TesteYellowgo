<?php
session_start(); // Inicie a sessão

// Verifique se o usuário está autenticado
if (!isset($_SESSION['user_authenticated']) || $_SESSION['user_authenticated'] !== true) {
    // Se não estiver autenticado, redirecione para a página de login
    header("Location: ../Projeto/login.html");
    exit();
}

// O restante do seu código continua aqui
?>

<!DOCTYPE html>
<html>
<head>
    <title>Detalhes do Protocolo</title>
</head>
<body>
    <h1>Detalhes do Protocolo</h1>

    <?php
    // Conexão com o banco de dados (substitua pelas suas configurações)
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "avaliacao";

    $conn = mysqli_connect($servername, $username, $password, $database);

    if (!$conn) {
        die("Erro na conexão com o banco de dados: " . mysqli_connect_error());
    }

    // Verifique se o protocolo foi passado na URL
    if (isset($_GET['protocol'])) {
        $protocol = $_GET['protocol'];

        // Consultar o banco de dados para obter as informações do ticket com base no protocolo
        $sql = "SELECT * FROM tickets WHERE protocol = '$protocol'";
        $result = mysqli_query($conn, $sql);

        if ($result && mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            echo "<h2>Detalhes do Protocolo:</h2>";
            echo "<ul>";
            echo "<li>Protocolo: " . $row['protocol'] . "</li>";
            echo "<li>Título: " . $row['title'] . "</li>";
            echo "<li>Tipo: " . $row['type'] . "</li>";
            echo "<li>Descrição: " . $row['description'] . "</li>";
            echo "<li>Status: " . $row['status'] . "</li>";
            echo "<li>Criado em: " . $row['created_at'] . "</li>";
            echo "<li>Criado por: " . $row['user_id'] . "</li>";
            echo "</ul>";

            // Adicione um botão para excluir o protocolo
            echo "<form method='post' action='excluir_protocolo.php'>";
            echo "<input type='hidden' name='protocol' value='" . $protocol . "'>";
            echo "<input type='submit' value='Excluir Protocolo'>";
            echo "</form>";

            // Adicione um botão para enviar ao suporte
            echo "<form method='post' action='enviar_suporte.php'>";
            echo "<input type='hidden' name='protocol' value='" . $protocol . "'>";
            echo "<input type='submit' value='Enviar ao Suporte'>";
            echo "</form>";
        } else {
            echo "Protocolo não encontrado.";
        }
    } else {
        echo "Protocolo não especificado.";
    }

    mysqli_close($conn);
    ?>

    <a href="lista.php">Voltar para a lista de protocolos</a>
</body>
</html>
