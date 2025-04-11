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
class ToListTest extends TestCase {

  public function testToList(): void {
    $this->assertEquals('a,b,c', Str2Name::toList(['a', 'b', 'c']));
    $this->assertEquals('a', Str2Name::toList(['a']));
    $this->assertEquals('', Str2Name::toList([]));

    $this->assertEquals('a,b,c,', Str2Name::toList(['a', 'b', 'c'], ',', TRUE));
    $this->assertEquals('a,', Str2Name::toList(['a'], ',', TRUE));
    $this->assertEquals(',', Str2Name::toList([], ',', TRUE));

    $this->assertEquals('a;b;c', Str2Name::toList(['a', 'b', 'c'], ';'));
    $this->assertEquals('a;b;c;', Str2Name::toList(['a', 'b', 'c'], ';', TRUE));

    $this->assertEquals('ä,ö,ü', Str2Name::toList(['ä', 'ö', 'ü']));
  }

}
