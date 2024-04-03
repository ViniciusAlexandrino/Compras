<!DOCTYPE html>
<html>
<head>
    <title>Lista de Compras</title>
</head>
<body>
    <h2>Lista de Compras</h2>

    <?php
    // Função para carregar e exibir uma lista de compras
    function exibirListaCompras($nomeLista) {
        $nomeArquivo = $nomeLista . '.txt';
        if (file_exists($nomeArquivo)) {
            echo "<h3>$nomeLista:</h3>";
            echo "<ul>";
            $itens = file($nomeArquivo, FILE_IGNORE_NEW_LINES);
            foreach ($itens as $item) {
                echo "<li>$item</li>";
            }
            echo "</ul>";
        } else {
            echo "<p>A lista de compras '$nomeLista' ainda não foi criada.</p>";
        }
    }

    // Função para adicionar um item à lista de compras
    function adicionarItem($nomeLista, $item) {
        $nomeArquivo = $nomeLista . '.txt';
        file_put_contents($nomeArquivo, $item . PHP_EOL, FILE_APPEND);
    }

    // Função para criar uma nova lista de compras
    function criarListaCompras($nomeLista) {
        $nomeArquivo = $nomeLista . '.txt';
        if (!file_exists($nomeArquivo)) {
            file_put_contents($nomeArquivo, '');
        }
    }

    // Verifica se o formulário foi enviado para adicionar um item à lista
    if (isset($_POST['adicionar'])) {
        $nomeLista = $_POST['nome_lista'];
        $item = $_POST['item'];
        adicionarItem($nomeLista, $item);
    }

    // Verifica se o formulário foi enviado para criar uma nova lista
    if (isset($_POST['criar_lista'])) {
        $nomeLista = $_POST['nome_lista'];
        criarListaCompras($nomeLista);
    }

    // Verifica se o formulário foi enviado para exibir uma lista existente
    if (isset($_POST['exibir_lista'])) {
        $nomeLista = $_POST['nome_lista'];
        exibirListaCompras($nomeLista);
    }
    ?>

    <h3>Criar Nova Lista de Compras:</h3>
    <form method="post">
        <label for="nome_lista">Nome da Lista:</label>
        <input type="text" id="nome_lista" name="nome_lista" required><br><br>
        <button type="submit" name="criar_lista">Criar Lista</button>
    </form>

    <h3>Adicionar Item à Lista:</h3>
    <form method="post">
        <label for="nome_lista">Nome da Lista:</label>
        <input type="text" id="nome_lista" name="nome_lista" required><br><br>
        <label for="item">Item:</label>
        <input type="text" id="item" name="item" required><br><br>
        <button type="submit" name="adicionar">Adicionar Item</button>
    </form>

    <h3>Exibir Lista de Compras:</h3>
    <form method="post">
        <label for="nome_lista">Nome da Lista:</label>
        <input type="text" id="nome_lista" name="nome_lista" required><br><br>
        <button type="submit" name="exibir_lista">Exibir Lista</button>
    </form>
</body>
</html>
