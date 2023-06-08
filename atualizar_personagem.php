<?php
session_start();

// Verifica se o usuário está logado
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}

// Verifica se o formulário de atualização do personagem foi submetido
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $selectedClothingId = $_POST['roupa'];

    // Atualiza os dados do personagem no banco de dados ou em outra fonte de dados
    atualizarRoupaPersonagem($_SESSION['username'], $selectedClothingId);

    // Redireciona para a página principal
    header('Location: index.php');
    exit();
}
?>
