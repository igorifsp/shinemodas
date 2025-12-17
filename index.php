<?php

declare(strict_types=1);

require_once __DIR__ . '/layout/index.php';
require_once __DIR__ . '/components/home/index.php';

$data = homeConteudo();
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>SHINE Modas Corp.</title>
    <meta name="description" content="Essa página apresenta a Shinemodas como uma grande loja de roupas plus size" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="./_estilos/layout/index.css">
    <link rel="stylesheet" href="./_estilos/index.css">
</head>

<body>
    <?= renderNavbar('home') ?>

    <?= renderHome($data) ?>

    <?= renderFooter() ?>

    <script src="./_js/script.js"></script>
</body>

</html>