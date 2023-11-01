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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $email_domain = $_POST["email_domain"];
    $user_type = $_POST["user_type"];
    $password = $_POST["password"];
    $email = $name . $email_domain;
    $created_at = date("Y-m-d H:i:s"); // Obtém a data atual

    // Execute uma consulta SQL para inserir o novo usuário na tabela "Users"
    $sql = "INSERT INTO Users (name, email, user_type, created_at, password) 
            VALUES ('$name', '$email', '$user_type', '$created_at', '$password')";

    if (mysqli_query($conn, $sql)) {
        // Registro bem-sucedido, redirecione o usuário para a página de login
        header("Location: login.html");
    } else {
        echo "Erro ao registrar o usuário: " . mysqli_error($conn);
    }
}

mysqli_close($conn);
?>
