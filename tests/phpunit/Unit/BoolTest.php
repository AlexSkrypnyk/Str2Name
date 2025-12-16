<?php

declare(strict_types=1);

namespace AlexSkrypnyk\Str2Name\Tests\Unit;

use AlexSkrypnyk\Str2Name\Str2Name;
use PHPUnit\Framework\Attributes\CoversMethod;
use PHPUnit\Framework\TestCase;

#[CoversMethod(Str2Name::class, 'bool')]
final class BoolTest extends TestCase {

  public function testBoolDefault(): void {
    $this->assertSame('Yes', Str2Name::bool(TRUE));
    $this->assertSame('Yes', Str2Name::bool(1));
    $this->assertSame('Yes', Str2Name::bool('1'));

    $this->assertSame('No', Str2Name::bool(FALSE));
    $this->assertSame('No', Str2Name::bool(0));
    $this->assertSame('No', Str2Name::bool('0'));
    $this->assertSame('No', Str2Name::bool(''));
    $this->assertSame('No', Str2Name::bool('anything else'));
  }

  public function testBoolCustom(): void {
    $this->assertSame('True', Str2Name::bool(TRUE, 'True', 'False'));
    $this->assertSame('True', Str2Name::bool(1, 'True', 'False'));
    $this->assertSame('False', Str2Name::bool(0, 'True', 'False'));

    $this->assertSame('On', Str2Name::bool(TRUE, 'On', 'Off'));
    $this->assertSame('Off', Str2Name::bool(FALSE, 'On', 'Off'));

    $this->assertSame('Oui', Str2Name::bool('1', 'Oui', 'Non'));
    $this->assertSame('Non', Str2Name::bool('0', 'Oui', 'Non'));

    $this->assertSame('✅', Str2Name::bool(TRUE, '✅', '❌'));
    $this->assertSame('❌', Str2Name::bool(FALSE, '✅', '❌'));

    $this->assertSame('No', Str2Name::bool(42));
    $this->assertSame('No', Str2Name::bool(-1));

    $this->assertSame('Yes', Str2Name::bool('true'));
    $this->assertSame('Yes', Str2Name::bool('yes'));
  }

}
