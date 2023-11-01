<?php
// Inicie a sessão
session_start();

// Verifique se o usuário está autenticado e é um superadmin
if (!isset($_SESSION['user_authenticated']) || $_SESSION['user_authenticated'] !== true || $_SESSION['user_type'] !== 'superadmin') {
    // Se não estiver autenticado como superadmin, exiba uma mensagem de erro
    echo "Você não tem permissão para acessar esta página.";
    exit();
}

// Lógica para inserir o novo domínio no banco de dados após o envio do formulário
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Conexão com o banco de dados (substitua pelas suas configurações)
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "avaliacao";

    $conn = mysqli_connect($servername, $username, $password, $database);

    if (!$conn) {
        die("Erro na conexão com o banco de dados: " . mysqli_connect_error());
    }

    // Coletar os dados do formulário
    $domain = $_POST['domain'];
    $status = $_POST['status'];

    // Verifique se o domínio já existe na tabela domains
    $check_duplicate_sql = "SELECT domain FROM domains WHERE domain = '$domain'";
    $result = mysqli_query($conn, $check_duplicate_sql);

    if ($result && mysqli_num_rows($result) > 0) {
        echo "Domínio já existe. Por favor, escolha um domínio único.";
    } else {
        // Recupere o email do usuário autenticado a partir da sessão
        $email = $_SESSION['user_email'];

        // Consulta SQL para obter o 'name' com base no email
        $sql_user = "SELECT name FROM users WHERE email = '$email'";
        $result = mysqli_query($conn, $sql_user);

        if ($result && mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $created_by = $row['name'];
            $created_at = date("Y-m-d H:i:s");
            $updated_at = date("Y-m-d H:i:s");

            // Inserir os dados na tabela domains
            $sql = "INSERT INTO domains (domain, status, created_by, created_at, updated_at) 
                    VALUES ('$domain', '$status', '$created_by', '$created_at', '$updated_at')";

            if (mysqli_query($conn, $sql)) {
                // Redirecionamento após a inserção bem-sucedida
                header("Location: criar_dominio.php?success=1");
                exit();
            } else {
                echo "Erro ao criar o domínio: " . mysqli_error($conn);
            }
        } else {
            echo "Erro ao obter informações do usuário.";
        }
    }

    mysqli_close($conn);
}

// Verifique se há um parâmetro de sucesso na URL após o redirecionamento
$success = isset($_GET['success']) ? (int)$_GET['success'] : 0;
?>

<!DOCTYPE html>
<html>
<head>
    <title>Criar Domínio</title>
</head>
<body>
    <h1>Criar Domínio</h1>

    <?php
    if ($success === 1) {
        echo "Domínio criado com sucesso.";
    }
    ?>

    <!-- Formulário para criar um novo domínio -->
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <label for="domain">Domínio:</label>
        <input type="text" name="domain" id="domain" required><br><br>

        <label for="status">Status:</label>
        <select name="status" id="status">
            <option value="ativo">Ativo</option>
            <option value="inativo">Inativo</option>
        </select><br><br>

        <input type="submit" value="Criar Domínio">
    </form>

    <a href="gerenciar_dominios.php">Voltar para Gerenciar Domínios</a>
</body>
</html>
