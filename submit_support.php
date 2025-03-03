<?php
include 'SQL/Database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    $sql = "INSERT INTO support_requests (name, email, message) VALUES ('$name', '$email', '$message')";

    if ($conn->query($sql) === TRUE) {
        echo "Mensagem enviada com sucesso!";
    } else {
        echo "Erro: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Suporte</title>
    <link rel="stylesheet" href="css/index.css">
</head>
<body>
    <div class="container">
        <h2>Suporte</h2>
        <p>Obrigado por entrar em contato conosco! Nós respondemos sua mensagem o mais breve possível.</p>
        <a href="index.php">Voltar à Página Inicial</a>
    </div>
</body>
</html>
