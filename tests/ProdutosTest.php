<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../components/produtos/index.php';

final class ProdutosTest extends TestCase
{
    public function testListarProdutosRetornaArrayComEstruturaCorreta(): void
    {
        $produtos = listarProdutos();

        $this->assertIsArray($produtos);
        $this->assertNotEmpty($produtos);

        $primeiro = $produtos[0];
        $this->assertArrayHasKey('title', $primeiro);
        $this->assertArrayHasKey('src', $primeiro);
        $this->assertArrayHasKey('alt', $primeiro);

        $this->assertIsString($primeiro['title']);
        $this->assertIsString($primeiro['src']);
        $this->assertIsString($primeiro['alt']);
    }

    public function testRenderGaleriaProdutosGeraDivGaleriaEImagens(): void
    {
        $html = renderGaleriaProdutos([
            ['title' => 'ProdutoX', 'src' => './img/x.jpg', 'alt' => 'Produto X']
        ]);

        $this->assertStringContainsString('id="galeria"', $html);
        $this->assertStringContainsString('<img', $html);
        $this->assertStringContainsString('title="ProdutoX"', $html);
        $this->assertStringContainsString('src="./img/x.jpg"', $html);
        $this->assertStringContainsString('alt="Produto X"', $html);
    }

    public function testRenderGaleriaProdutosEscapaHtmlContraXss(): void
    {
        $html = renderGaleriaProdutos([
            [
                'title' => '" onmouseover="alert(1)',
                'src'   => './img/"x.jpg',
                'alt'   => '<script>alert(1)</script>'
            ]
        ]);

        $this->assertStringNotContainsString('<script>', $html);

        $this->assertStringContainsString('alt="&lt;script&gt;alert(1)&lt;/script&gt;"', $html);
        $this->assertStringContainsString('title="&quot; onmouseover=&quot;alert(1)', $html);
    }
}
