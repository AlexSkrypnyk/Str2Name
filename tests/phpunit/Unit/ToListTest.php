<?php

declare(strict_types=1);

namespace AlexSkrypnyk\Str2Name\Tests\Unit;

use AlexSkrypnyk\Str2Name\Str2Name;
use PHPUnit\Framework\Attributes\CoversMethod;
use PHPUnit\Framework\TestCase;

/**
 * Tests for toList() method.
 */
#[CoversMethod(Str2Name::class, 'toList')]
final class ToListTest extends TestCase {

  public function testToList(): void {
    $this->assertSame('a,b,c', Str2Name::toList(['a', 'b', 'c']));
    $this->assertSame('a', Str2Name::toList(['a']));
    $this->assertSame('', Str2Name::toList([]));

    $this->assertSame('a,b,c,', Str2Name::toList(['a', 'b', 'c'], ',', TRUE));
    $this->assertSame('a,', Str2Name::toList(['a'], ',', TRUE));
    $this->assertSame(',', Str2Name::toList([], ',', TRUE));

    $this->assertSame('a;b;c', Str2Name::toList(['a', 'b', 'c'], ';'));
    $this->assertSame('a;b;c;', Str2Name::toList(['a', 'b', 'c'], ';', TRUE));

    $this->assertSame('ä,ö,ü', Str2Name::toList(['ä', 'ö', 'ü']));
  }

}
