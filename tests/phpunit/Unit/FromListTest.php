<?php

declare(strict_types=1);

namespace AlexSkrypnyk\Str2Name\Tests\Unit;

use AlexSkrypnyk\Str2Name\Str2Name;
use PHPUnit\Framework\Attributes\CoversMethod;
use PHPUnit\Framework\TestCase;

#[CoversMethod(Str2Name::class, 'fromList')]
final class FromListTest extends TestCase {

  public function testFromList(): void {
    $this->assertSame(['a', 'b', 'c'], Str2Name::fromList('a,b,c'));
    $this->assertSame(['a', 'b', 'c'], Str2Name::fromList('a, b, c'));
    $this->assertSame(['a', 'b', 'c'], Str2Name::fromList('a,  b,   c'));
    $this->assertSame(['a'], Str2Name::fromList('a'));
    $this->assertSame([], Str2Name::fromList(''));
    $this->assertSame([], Str2Name::fromList(','));
    $this->assertSame([], Str2Name::fromList(', ,'));

    $this->assertSame(['a', 'b', 'c'], Str2Name::fromList('a;b;c', ';'));
    $this->assertSame(['a', 'b', 'c'], Str2Name::fromList('a; b; c', ';'));

    $this->assertSame(['a;b;c'], Str2Name::fromList('a;b;c', ''));

    $this->assertSame(['a', 'b', 'c'], Str2Name::fromList('a,,b,,,c'));

    $this->assertSame(['ä', 'ö', 'ü'], Str2Name::fromList('ä,ö,ü'));
  }

}
