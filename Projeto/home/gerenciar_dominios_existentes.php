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

// Conexão com o banco de dados (substitua pelas suas configurações)
$servername = "localhost";
$username = "root";
$password = "";
$database = "avaliacao";

$conn = mysqli_connect($servername, $username, $password, $database);

if (!$conn) {
    die("Erro na conexão com o banco de dados: " . mysqli_connect_error());
}

// Consulta SQL para obter todos os domínios da tabela domains
$sql = "SELECT * FROM domains";

$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Gerenciar Domínios Existentes</title>
</head>
<body>
    <h1>Gerenciar Domínios Existentes</h1>

    <?php
    if ($result && mysqli_num_rows($result) > 0) {
        echo "<h2>Lista de Domínios:</h2>";
        echo "<table border='1'>";
        echo "<tr><th>Domínio</th><th>Status</th><th>Criado Por</th><th>Criado Em</th><th>Atualizado Em</th><th>Ações</th></tr>";
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $row['domain'] . "</td>";
            echo "<td>" . $row['status'] . "</td>";
            echo "<td>" . $row['created_by'] . "</td>";
            echo "<td>" . $row['created_at'] . "</td>";
            echo "<td>" . $row['updated_at'] . "</td>";
            echo "<td>";
            echo "<form method='post' action='".$_SERVER['PHP_SELF']."'>";
            echo "<input type='hidden' name='domain' value='" . $row['domain'] . "'>";
            if ($row['status'] === 'ativo') {
                echo "<input type='submit' name='change_status' value='Desativar'>";
            } else {
                echo "<input type='submit' name='change_status' value='Ativar'>";
            }
            echo "<input type='submit' name='delete_domain' value='Excluir'>";
            echo "</form>";
            echo "</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "Nenhum domínio encontrado.";
    }

    mysqli_close($conn);

    // Lógica para excluir domínio ou alterar o status
    if (isset($_POST['delete_domain'])) {
        $domain_to_delete = $_POST['domain'];

        // Conexão com o banco de dados (substitua pelas suas configurações)
        $conn = mysqli_connect($servername, $username, $password, $database);

        if (!$conn) {
            die("Erro na conexão com o banco de dados: " . mysqli_connect_error());
        }

        // Consulta SQL para excluir o domínio
        $sql = "DELETE FROM domains WHERE domain = '$domain_to_delete'";

        if (mysqli_query($conn, $sql)) {
            echo "Domínio excluído com sucesso.";
            header("Refresh:0");
        } else {
            echo "Erro ao excluir o domínio: " . mysqli_error($conn);
        }

        mysqli_close($conn);
    } elseif (isset($_POST['change_status'])) {
        $domain_to_change = $_POST['domain'];
        
        // Conexão com o banco de dados (substitua pelas suas configurações)
        $conn = mysqli_connect($servername, $username, $password, $database);

        if (!$conn) {
            die("Erro na conexão com o banco de dados: " . mysqli_connect_error());
        }

        // Consulta SQL para alterar o status do domínio
        $current_status = "";
        $sql = "SELECT status FROM domains WHERE domain = '$domain_to_change'";
        $result = mysqli_query($conn, $sql);

        if ($result && mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $current_status = $row['status'];
        }

        // Alterar o status
        if ($current_status === 'ativo') {
            $new_status = 'inativo';
        } else {
            $new_status = 'ativo';
        }

        $sql = "UPDATE domains SET status = '$new_status' WHERE domain = '$domain_to_change'";

        if (mysqli_query($conn, $sql)) {
            echo "Status do domínio alterado com sucesso.";
            header("Refresh:0");
        } else {
            echo "Erro ao alterar o status do domínio: " . mysqli_error($conn);
        }

        mysqli_close($conn);
    }
    ?>

    <a href="home_superadmin.php">Voltar para o menu</a>
</body>
</html>
