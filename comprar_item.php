<?php
session_start();

// Verifica se o usuário está logado
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}

// Verifica se o formulário de compra de item foi submetido
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $selectedItemId = $_POST['item'];

    // Obtém os dados do item selecionado (do banco de dados ou de outra fonte de dados)
    $itemData = obterDadosItem($selectedItemId);

    // Verifica se o jogador possui fundos suficientes para comprar o item
    if ($characterData['dinheiro'] >= $itemData['preco']) {
        // Atualiza os dados do personagem no banco de dados ou em outra fonte de dados
        atualizarDinheiroPersonagem($_SESSION['username'], $characterData['dinheiro'] - $itemData['preco']);

        // Adiciona o item ao inventário do jogador no banco de dados ou em outra fonte de dados
        adicionarItemInventario($_SESSION['username'], $selectedItemId);

        // Redireciona para a página principal
        header('Location: index.php');
        exit();
    } else {
        $error = 'Fundos insuficientes para comprar o item.';
    }
}
?>
