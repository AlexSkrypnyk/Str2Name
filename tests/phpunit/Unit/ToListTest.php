<?php

declare(strict_types=1);

namespace AlexSkrypnyk\Str2Name\Tests\Unit;

use AlexSkrypnyk\Str2Name\Str2Name;
use PHPUnit\Framework\Attributes\CoversMethod;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

#[CoversMethod(Str2Name::class, 'toList')]
final class ToListTest extends TestCase {

  #[DataProvider('dataProviderToList')]
  public function testToList(array $input, string $expected): void {
    $this->assertSame($expected, Str2Name::toList($input));
  }

  public static function dataProviderToList(): \Iterator {
    yield [['a', 'b', 'c'], 'a,b,c'];
    yield [['a'], 'a'];
    yield [[], ''];
    yield [['ä', 'ö', 'ü'], 'ä,ö,ü'];
  }

  #[DataProvider('dataProviderToListCustom')]
  public function testToListCustom(array $input, string $delimiter, bool $append_end, string $expected): void {
    $this->assertSame($expected, Str2Name::toList($input, $delimiter, $append_end));
  }

  public static function dataProviderToListCustom(): \Iterator {
    yield [['a', 'b', 'c'], ',', TRUE, 'a,b,c,'];
    yield [['a'], ',', TRUE, 'a,'];
    yield [[], ',', TRUE, ','];
    yield [['a', 'b', 'c'], ';', FALSE, 'a;b;c'];
    yield [['a', 'b', 'c'], ';', TRUE, 'a;b;c;'];
  }

}
