<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../components/home/index.php';

final class HomeTest extends TestCase
{
    public function testHomeConteudoEstruturaCorreta(): void
    {
        $data = homeConteudo();

        $this->assertIsArray($data);
        $this->assertArrayHasKey('title', $data);
        $this->assertArrayHasKey('sections', $data);

        $this->assertIsString($data['title']);
        $this->assertIsArray($data['sections']);
        $this->assertNotEmpty($data['sections']);
    }

    public function testRenderHomeGeraMainH1ParagrafosEImagens(): void
    {
        $html = renderHome([
            'title' => 'Moda Plus Size',
            'sections' => [
                ['type' => 'image', 'src' => './img/a.jpg', 'title' => 'A', 'alt' => 'AA'],
                ['type' => 'text', 'text' => 'Texto 1'],
                ['type' => 'text', 'text' => 'Texto 2'],
            ],
        ]);

        $this->assertStringContainsString('<main>', $html);
        $this->assertStringContainsString('<h1>Moda Plus Size</h1>', $html);
        $this->assertStringContainsString('<img', $html);
        $this->assertStringContainsString('<p>Texto 1</p>', $html);
        $this->assertStringContainsString('<p>Texto 2</p>', $html);
        $this->assertStringContainsString('</main>', $html);
    }

    public function testRenderHomeEscapaHtmlContraXss(): void
    {
        $html = renderHome([
            'title' => '<b>T</b>',
            'sections' => [
                ['type' => 'text', 'text' => '<script>alert(1)</script> oi'],
                ['type' => 'image', 'src' => './img/"x.jpg', 'title' => '" onload="x', 'alt' => '<script>x</script>'],
            ],
        ]);

        $this->assertStringNotContainsString('<script>', $html);
        $this->assertStringContainsString('&lt;b&gt;T&lt;/b&gt;', $html);
        $this->assertStringContainsString('&lt;script&gt;alert(1)&lt;/script&gt; oi', $html);
        $this->assertStringContainsString('alt="&lt;script&gt;x&lt;/script&gt;"', $html);
    }
}
