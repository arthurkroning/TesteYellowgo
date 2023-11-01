<?php
session_start(); // Inicie a sessão

// Verifique se o usuário está autenticado
if (!isset($_SESSION['user_authenticated']) || $_SESSION['user_authenticated'] !== true) {
    // Se não estiver autenticado, exiba uma mensagem de erro e um link para retornar ao login
    echo "Login Expirou. <a href='../Projeto/login.html'>Voltar para o login</a>";
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['protocol'])) {
    // Conexão com o banco de dados (substitua pelas suas configurações)
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "avaliacao";

    $conn = mysqli_connect($servername, $username, $password, $database);

    if (!$conn) {
        die("Erro na conexão com o banco de dados: " . mysqli_connect_error());
    }

    $protocol = $_POST['protocol'];

    // Consulta SQL para excluir o protocolo com base no número do protocolo
    $sql = "DELETE FROM tickets WHERE protocol = '$protocol'";
    
    if (mysqli_query($conn, $sql)) {
        echo "Protocolo $protocol foi excluído com sucesso!";
    } else {
        echo "Erro ao excluir o protocolo: " . mysqli_error($conn);
    }

    mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Excluir Protocolo</title>
</head>
<body>
    <h1>Excluir Protocolo</h1>

    <a href="lista.php">Voltar para a lista de protocolos</a>
</body>
</html>
