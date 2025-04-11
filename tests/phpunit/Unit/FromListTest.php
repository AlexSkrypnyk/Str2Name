<?php

declare(strict_types=1);

namespace AlexSkrypnyk\Str2Name\Tests\Unit;

use AlexSkrypnyk\Str2Name\Str2Name;
use PHPUnit\Framework\Attributes\CoversMethod;
use PHPUnit\Framework\TestCase;

#[CoversMethod(Str2Name::class, 'fromList')]
class FromListTest extends TestCase {

  public function testFromList(): void {
    $this->assertEquals(['a', 'b', 'c'], Str2Name::fromList('a,b,c'));
    $this->assertEquals(['a', 'b', 'c'], Str2Name::fromList('a, b, c'));
    $this->assertEquals(['a', 'b', 'c'], Str2Name::fromList('a,  b,   c'));
    $this->assertEquals(['a'], Str2Name::fromList('a'));
    $this->assertEquals([], Str2Name::fromList(''));
    $this->assertEquals([], Str2Name::fromList(','));
    $this->assertEquals([], Str2Name::fromList(', ,'));

    $this->assertEquals(['a', 'b', 'c'], Str2Name::fromList('a;b;c', ';'));
    $this->assertEquals(['a', 'b', 'c'], Str2Name::fromList('a; b; c', ';'));

    $this->assertEquals(['a;b;c'], Str2Name::fromList('a;b;c', ''));

    $this->assertEquals(['a', 'b', 'c'], Str2Name::fromList('a,,b,,,c'));

    $this->assertEquals(['ä', 'ö', 'ü'], Str2Name::fromList('ä,ö,ü'));
  }

}
