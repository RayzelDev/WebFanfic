<?php
include '../SQL/Database.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT id, username, password FROM users WHERE username = '$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['username'] = $row['username'];
            echo "<div class='success-msg'>Login bem-sucedido! Seja bem-vindo(a), " . $row['username'] . ".</div>";
        } else {
            echo "<div class='error-msg'>Senha incorreta.</div>";
        }
    } else {
        echo "<div class='error-msg'>Usuário não encontrado.</div>";
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="../css/login.css">
    <style>
        
    </style>
</head>
<body>
    <div class="container">
        <h3>Login</h3>
        <form action="" method="post">
            <label for="username">Nome de Usuário:</label>
            <input type="text" id="username" name="username" required>

            <label for="password">Senha:</label>
            <input type="password" id="password" name="password" required>

            <input type="submit" value="Login">
        </form>
    </div>
</body>
</html>
