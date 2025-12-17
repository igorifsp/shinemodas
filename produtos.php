<?php

declare(strict_types=1);

require_once __DIR__ . '/components/produtos/index.php';
require_once __DIR__ . '/layout/index.php';


$produtos = listarProdutos();
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>SHINE Modas Corp. - Produtos</title>
    <meta name="description" content="Essa página apresenta a Shinemodas como uma grande loja de roupas plus size" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="./_estilos/layout/index.css">
    <link rel="stylesheet" href="./_estilos/produtos/index.css">
</head>

<body>
    <?= renderNavbar('produtos') ?>

    <main>
        <h1>Moda Plus Size</h1>
        <p>Conheça nosso catálogo de produtos!</p>

        <?= renderGaleriaProdutos($produtos) ?>

        <div id="modal">
            <span class="close">&times;</span>
            <img id="modal-img" src="" alt="">
        </div>
    </main>

    <?= renderFooter() ?>

    <script src="./_js/script.js"></script>
</body>

</html>