<?php

declare(strict_types=1);

function sobreConteudo(): array
{
    return [
        'title' => 'Moda Plus Size',
        'image' => [
            'src' => './_imagens/people_03.jpg',
            'title' => 'Foto_Capa_03',
            'alt' => '[Foto_Capa_03]',
        ],
        'text' => 'Shine Modas é uma empresa que nasceu na cidade de Guarulhos com objetivo de democratizar a moda
trazendo os mais variados modelos de roupas direcionadas ao público plus size com variados estilos e
modelos.',
    ];
}

function renderSobre(array $data): string
{
    $title = htmlspecialchars((string)$data['title'], ENT_QUOTES, 'UTF-8');

    $imgSrc   = htmlspecialchars((string)$data['image']['src'], ENT_QUOTES, 'UTF-8');
    $imgTitle = htmlspecialchars((string)$data['image']['title'], ENT_QUOTES, 'UTF-8');
    $imgAlt   = htmlspecialchars((string)$data['image']['alt'], ENT_QUOTES, 'UTF-8');

    $text = trim((string)$data['text']);
    $text = preg_replace("/\s+/", " ", $text);
    $text = htmlspecialchars($text, ENT_QUOTES, 'UTF-8');

    return '
    <main>
        <h1>' . $title . '</h1>
        <img title="' . $imgTitle . '" alt="' . $imgAlt . '" src="' . $imgSrc . '" />
        <p>' . $text . '</p>
    </main>';
}
