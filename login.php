<?php
session_start();

// Verifica se o usuário já está logado
if (isset($_SESSION['username'])) {
    header('Location: index.php');
    exit();
}

// Verifica se o formulário de login foi submetido
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Verifique as credenciais do usuário (por exemplo, em um banco de dados)
    // Se as credenciais estiverem corretas, inicie a sessão e redirecione para a página principal
    if ($username === 'usuario' && $password === 'senha') {
        $_SESSION['username'] = $username;
        header('Location: index.php');
        exit();
    } else {
        $error = 'Credenciais inválidas';
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>
    <h1>Login</h1>

    <?php if (isset($error)) { echo $error; } ?>

    <form action="login.php" method="POST">
        <input type="text" name="username" placeholder="Usuário" required><br>
        <input type="password" name="password" placeholder="Senha" required><br>
        <input type="submit" value="Login">
    </form>
</body>
</html>
