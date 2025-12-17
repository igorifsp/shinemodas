<?php

declare(strict_types=1);

function listarProdutos(): array
{
    return [
        ["title" => "Produto01", "src" => "./_imagens/look_fem_02.jpg", "alt" => "Produto 1"],
        ["title" => "Produto02", "src" => "./_imagens/look_fem_03.jpg", "alt" => "Produto 2"],
        ["title" => "Produto03", "src" => "./_imagens/look_fem_04.jpg", "alt" => "Produto 3"],
        ["title" => "Produto04", "src" => "./_imagens/look_mas_01.jpg", "alt" => "Produto 4"],
        ["title" => "Produto05", "src" => "./_imagens/look_mas_02.jpg", "alt" => "Produto 5"],
        ["title" => "Produto06", "src" => "./_imagens/look_mas_03.jpg", "alt" => "Produto 6"],
    ];
}

function renderGaleriaProdutos(array $produtos): string
{
    $html = '<div id="galeria">';

    foreach ($produtos as $p) {
        $title = htmlspecialchars((string)$p['title'], ENT_QUOTES, 'UTF-8');
        $src   = htmlspecialchars((string)$p['src'],   ENT_QUOTES, 'UTF-8');
        $alt   = htmlspecialchars((string)$p['alt'],   ENT_QUOTES, 'UTF-8');
        $html .= "<img title=\"{$title}\" src=\"{$src}\" alt=\"{$alt}\">";
    }

    $html .= '</div>';
    return $html;
}
