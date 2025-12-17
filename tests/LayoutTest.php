<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../layout/index.php';

final class LayoutTest extends TestCase
{
    public function testNavbarMarcaLinkAtivoHome(): void
    {
        $html = renderNavbar('home');

        $this->assertStringContainsString('class="active"', $html);
        $this->assertStringContainsString('href="./index.php"', $html);
        $this->assertStringContainsString('<img', $html);
    }

    public function testNavbarMarcaLinkAtivoProdutos(): void
    {
        $html = renderNavbar('produtos');

        $this->assertStringContainsString('href="./produtos.php" class="active"', $html);
    }

    public function testFooterContemRedesSociais(): void
    {
        $html = renderFooter();

        $this->assertStringContainsString('twitter.com/shinemodas', $html);
        $this->assertStringContainsString('facebook.com/shinemodas', $html);
        $this->assertStringContainsString('<footer>', $html);
        $this->assertStringContainsString('</footer>', $html);
    }

    public function testHelperHEscapaCaracteres(): void
    {
        $this->assertSame('&lt;b&gt;X&lt;/b&gt;', h('<b>X</b>'));
        $this->assertSame('&quot;teste&quot;', h('"teste"'));
    }
}
