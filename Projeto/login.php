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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["username"];
    $password = $_POST["password"];

    // Execute uma consulta SQL para verificar o email e a senha no banco de dados
    $sql = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        $user_type = $row['user_type'];

        // Defina uma variável de sessão para o user_type
        $_SESSION['user_authenticated'] = true;
        $_SESSION['user_email'] = $email;
        $_SESSION['user_type'] = $user_type;

        // Redirecione o usuário com base no user_type
        if ($user_type == 'cliente') {
            header("Location: home/home_cliente.php");
        } elseif ($user_type == 'suporte') {
            header("Location: home/home_suporte.php");
        } elseif ($user_type == 'superadmin') {
            header("Location: home/home_superadmin.php");
        } else {
            echo "Tipo de usuário não reconhecido. <a href='login.html'>Voltar para o login</a>";
        }
        exit();
    } else {
        // Credenciais inválidas, exiba uma mensagem de erro
        echo "Credenciais inválidas. Tente novamente. <a href='login.html'>Voltar para o login</a>";
    }
}

mysqli_close($conn);
?>
