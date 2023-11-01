<!DOCTYPE html>
<meta charset="UTF-8"/>
<html>
<head>
    <title>Criar Novo Usuário</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <div class="register-container">
        <h1>Criar Novo Usuário</h1>
        <form action="process_register.php" method="post">
            <div class="form-group">
                <label for="name">Nome:</label>
                <input type="text" name="name" id="name" required>
            </div>
            <div class="form-group">
                <label for="email_domain">Domínio de E-mail:</label>
                <select name="email_domain" id="email_domain" required>
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

                    // Consulta SQL para obter domínios ativos
                    $sql_domains = "SELECT domain FROM domains WHERE status = 'ativo'";
                    $result_domains = mysqli_query($conn, $sql_domains);

                    if ($result_domains && mysqli_num_rows($result_domains) > 0) {
                        while ($row = mysqli_fetch_assoc($result_domains)) {
                            $domain = $row['domain'];
                            echo "<option value='$domain'>$domain</option>";
                        }
                    }

                    mysqli_close($conn);
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="user_type">Tipo de Usuário:</label>
                <select name="user_type" id="user_type">
                    <option value="cliente">cliente</option>
                    <option value="suporte">suporte</option>
                    <option value="superadmin">Superadmin</option>
                </select>
            </div>
            <div class="form-group">
                <label for="password">Senha: (apenas números inteiros)</label>
                <input type="password" name="password" id="password" required>
            </div>
            <button type="submit">Registrar</button>
        </form>
    </div>
</body>
</html>
