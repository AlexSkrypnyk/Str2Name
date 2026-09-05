<?php

declare(strict_types=1);

namespace AlexSkrypnyk\Str2Name\Tests\Unit;

use AlexSkrypnyk\Str2Name\Str2Name;
use PHPUnit\Framework\Attributes\CoversMethod;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

#[CoversMethod(Str2Name::class, 'fromList')]
final class FromListTest extends TestCase {

  #[DataProvider('dataProviderFromList')]
  public function testFromList(string $input, array $expected): void {
    $this->assertSame($expected, Str2Name::fromList($input));
  }

  public static function dataProviderFromList(): \Iterator {
    yield ['a,b,c', ['a', 'b', 'c']];
    yield ['a, b, c', ['a', 'b', 'c']];
    yield ['a,  b,   c', ['a', 'b', 'c']];
    yield ['a', ['a']];
    yield ['', []];
    yield [',', []];
    yield [', ,', []];
    yield ['a,,b,,,c', ['a', 'b', 'c']];
    yield ['ä,ö,ü', ['ä', 'ö', 'ü']];
  }

  #[DataProvider('dataProviderFromListCustom')]
  public function testFromListCustom(string $input, string $delimiter, array $expected): void {
    $this->assertSame($expected, Str2Name::fromList($input, $delimiter));
  }

  public static function dataProviderFromListCustom(): \Iterator {
    yield ['a;b;c', ';', ['a', 'b', 'c']];
    yield ['a; b; c', ';', ['a', 'b', 'c']];
    yield ['a;b;c', '', ['a;b;c']];
  }

}
