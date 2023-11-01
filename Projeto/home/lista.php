<?php
session_start(); // Inicie a sessão

// Verifique se o usuário está autenticado
if (!isset($_SESSION['user_authenticated']) || $_SESSION['user_authenticated'] !== true) {
    // Se não estiver autenticado, exiba uma mensagem de erro e um link para retornar ao login
    echo "Login Expirou. <a href='../Projeto/login.html'>Voltar para o login</a>";
    exit();
}

// Verifique o user_type do usuário autenticado
$user_type = $_SESSION['user_type'];

// Conexão com o banco de dados (substitua pelas suas configurações)
$servername = "localhost";
$username = "root";
$password = "";
$database = "avaliacao";

$conn = mysqli_connect($servername, $username, $password, $database);

if (!$conn) {
    die("Erro na conexão com o banco de dados: " . mysqli_connect_error());
}

// Recupere o nome do usuário autenticado a partir da sessão
$email = $_SESSION['user_email'];

// Consultar o banco de dados com base no user_type
if ($user_type === "cliente") {
    $sql = "SELECT t.* 
            FROM tickets t
            INNER JOIN users u ON t.user_id = u.name
            WHERE u.email = '$email' AND t.responsable_id = 'cliente'";
    $home_page = "home_cliente.php";
} elseif ($user_type === "suporte") {
    $sql = "SELECT t.* 
            FROM tickets t";
    $home_page = "home_suporte.php";
} elseif ($user_type === "superadmin") {
    $sql = "SELECT t.* 
            FROM tickets t";
    $home_page = "home_superadmin.php";
}

$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Lista de Protocolos</title>
</head>
<body>
    <h1>Lista de Protocolos</h1>

    <?php
    if ($result && mysqli_num_rows($result) > 0) {
        echo "<h2>Meus Protocolos:</h2>";
        echo "<ul>";
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<li><a href='verificar_ticket.php?protocol=" . $row['protocol'] . "'>" . $row['protocol'] . "</a></li>";
        }
        echo "</ul>";
    } else {
        echo "Nenhum protocolo encontrado.";
    }

    mysqli_close($conn);
    ?>
    
    <a href="<?php echo $home_page; ?>">Voltar para o menu</a> </br>
</body>
</html>
