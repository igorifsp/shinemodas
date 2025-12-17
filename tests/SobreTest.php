<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../components/sobre/index.php';

final class SobreTest extends TestCase
{
    public function testSobreConteudoTemEstruturaCorreta(): void
    {
        $data = sobreConteudo();

        $this->assertIsArray($data);
        $this->assertArrayHasKey('title', $data);
        $this->assertArrayHasKey('image', $data);
        $this->assertArrayHasKey('text', $data);

        $this->assertIsString($data['title']);
        $this->assertIsArray($data['image']);
        $this->assertIsString($data['text']);

        $this->assertArrayHasKey('src', $data['image']);
        $this->assertArrayHasKey('title', $data['image']);
        $this->assertArrayHasKey('alt', $data['image']);
    }

    public function testRenderSobreGeraMainH1ImgP(): void
    {
        $html = renderSobre([
            'title' => 'Moda Plus Size',
            'image' => ['src' => './img/x.jpg', 'title' => 'Foto', 'alt' => 'Alt'],
            'text'  => 'Texto de teste',
        ]);

        $this->assertStringContainsString('<main>', $html);
        $this->assertStringContainsString('<h1>Moda Plus Size</h1>', $html);
        $this->assertStringContainsString('src="./img/x.jpg"', $html);
        $this->assertStringContainsString('<p>Texto de teste</p>', $html);
        $this->assertStringContainsString('</main>', $html);
    }

    public function testRenderSobreEscapaHtmlContraXss(): void
    {
        $html = renderSobre([
            'title' => '<b>t</b>',
            'image' => [
                'src' => './img/"x.jpg',
                'title' => '" onload="alert(1)',
                'alt' => '<script>alert(1)</script>',
            ],
            'text' => '<script>alert(1)</script> teste',
        ]);

        $this->assertStringNotContainsString('<script>', $html);
        $this->assertStringContainsString('&lt;b&gt;t&lt;/b&gt;', $html);
        $this->assertStringContainsString('alt="&lt;script&gt;alert(1)&lt;/script&gt;"', $html);
        $this->assertStringContainsString('&lt;script&gt;alert(1)&lt;/script&gt; teste', $html);
    }
}
