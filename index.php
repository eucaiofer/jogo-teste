<?php
session_start();

// Verifica se o usuário está logado
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}

// Obtém os dados do personagem do usuário (do banco de dados ou de outra fonte de dados)
$characterData = obterDadosPersonagem($_SESSION['username']);

// Obtém as roupas disponíveis (do banco de dados ou de outra fonte de dados)
$clothesData = obterDadosRoupas();

// Obtém os itens disponíveis na loja (do banco de dados ou de outra fonte de dados)
$shopItems = obterItensLoja();

// Função para exibir as roupas disponíveis
function exibirRoupasDisponiveis($clothesData) {
    foreach ($clothesData as $clothing) {
        echo '<img src="' . $clothing['imagem'] . '" alt="' . $clothing['nome'] . '">';
        echo '<input type="radio" name="roupa" value="' . $clothing['id'] . '"> ' . $clothing['nome'] . '<br>';
    }
}

// Função para exibir os itens disponíveis na loja
function exibirItensLoja($shopItems) {
    foreach ($shopItems as $item) {
        echo '<img src="' . $item['imagem'] . '" alt="' . $item['nome'] . '">';
        echo '<input type="radio" name="item" value="' . $item['id'] . '"> ' . $item['nome'] . ' - Preço: ' . $item['preco'] . '<br>';
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Jogo de Personalização de Personagens</title>
</head>
<body>
    <h1>Jogo de Personalização de Personagens</h1>

    <h3>Bem-vindo, <?php echo $_SESSION['username']; ?></h3>

    <a href="logout.php">Sair</a>

    <hr>

    <h2>Seu Personagem</h2>

    <img src="<?php echo $characterData['imagem']; ?>" alt="Personagem">

    <hr>

    <h2>Personalizar</h2>

    <form action="atualizar_personagem.php" method="POST">
        <h3>Roupas:</h3>
        <?php exibirRoupasDisponiveis($clothesData); ?>
        <input type="submit" name="submit_roupa" value="Atualizar Roupa">
    </form>

    <hr>

    <h2>Loja</h2>

    <form action="comprar_item.php" method="POST">
        <h3>Itens Disponíveis:</h3>
        <?php exibirItensLoja($shopItems); ?>
        <input type="submit" name="submit_item" value="Comprar">
    </form>
</body>
</html>
