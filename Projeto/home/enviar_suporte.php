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

// Verifique se o protocolo foi passado por POST
if (isset($_POST['protocol'])) {
    $protocol = $_POST['protocol'];

    // Realize a atualização do campo 'responsable_id' para 'suporte'
    $sql = "UPDATE tickets SET responsable_id = 'suporte' WHERE protocol = '$protocol'";

    if (mysqli_query($conn, $sql)) {
        echo "Protocolo enviado ao suporte com sucesso.";
    } else {
        echo "Erro ao enviar o protocolo ao suporte: " . mysqli_error($conn);
    }
} else {
    echo "Protocolo não especificado.";
}



mysqli_close($conn);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Enviar Protocolo</title>
</head>
<body>
    <a href="lista.php">Voltar para a lista de protocolos</a>
</body>
</html>