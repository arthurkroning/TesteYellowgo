<!DOCTYPE html>
<html>
<head>
    <title>Formulário de Novo Ticket</title>
</head>
<body>
    <h1>Formulário de Novo Ticket</h1>

    <?php
session_start(); // Inicie a sessão

// Conexão com o banco de dados (substitua pelas suas configurações)
$servername = "localhost";
$username = "root";
$password = "";
$database = "avaliacao";

$conn = mysqli_connect($servername, $username, $password, $database);

if (!$conn) {
    die("Erro na conexão com o banco de dados: " . mysqli_connect_error());
}

// Verifique se o usuário está autenticado
if (!isset($_SESSION['user_authenticated']) || !$_SESSION['user_authenticated']) {
    // Se o usuário não estiver autenticado, redirecione para a página de login
    header("Location: login.html");
    exit();
}

if (isset($_POST['submit'])) {
    // Coleta os dados do formulário
    $title = $_POST["title"];
    $type = $_POST["type"];
    $description = $_POST["description"];

    // Recupere o email do usuário autenticado a partir da sessão
    $email = $_SESSION['user_email'];

    // Consulta SQL para obter o 'name' e 'user_type' com base no email
    $sql_user = "SELECT name, user_type FROM users WHERE email = '$email'";
    $result = mysqli_query($conn, $sql_user);

    if ($result && mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        $user_name = $row['name'];
        $user_type = $row['user_type'];

        // Obtenha o próximo número de protocolo
        $next_protocol = 1;
        do {
            // Verifique se o número de protocolo já está em uso
            $sql_check_protocol = "SELECT * FROM tickets WHERE protocol = '$next_protocol'";
            $result_check_protocol = mysqli_query($conn, $sql_check_protocol);
            if (mysqli_num_rows($result_check_protocol) == 0) {
                // Número de protocolo disponível
                break;
            } else {
                // Número de protocolo em uso, tente o próximo
                $next_protocol++;
            }
        } while (true);

        $status = "aberto";

        // Insira os dados na tabela 'tickets', incluindo 'name', 'user_type' e 'email' obtidos
        $sql = "INSERT INTO tickets (protocol, title, type, description, user_id, created_at, updated_at, responsable_id, status)
                VALUES ('$next_protocol', '$title', '$type', '$description', '$user_name', NOW(), NOW(), '$user_type', '$status')";

        if (mysqli_query($conn, $sql)) {
            // Redirecione para uma página de confirmação após o processamento
            header("Location: confirmacao.php");
            exit();
        } else {
            echo "Erro ao criar o ticket: " . mysqli_error($conn);
        }
    } else {
        // Trate o caso em que o email não foi encontrado na tabela 'users'
        echo "Erro: O email não foi encontrado na tabela 'users'.";
    }
}

mysqli_close($conn);
?>

<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <label for="title">Título:</label>
    <input type="text" name="title" required><br><br>

    <label for="type">Tipo de Solicitação:</label>
    <select name="type">
        <option value="bug">Bug</option>
        <option value="erro">Erro</option>
        <option value="suporte">Suporte</option>
    </select><br><br>

    <label for="description">Descrição:</label>
    <textarea name="description" rows="4" cols="50" required></textarea><br><br>

    <input type="submit" name="submit" value="Criar Ticket">
</form>

<a href="home_cliente.php">Voltar para o menu</a> </br>
</body>
</html>
