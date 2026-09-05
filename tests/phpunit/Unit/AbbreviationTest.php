<?php

declare(strict_types=1);

namespace AlexSkrypnyk\Str2Name\Tests\Unit;

use AlexSkrypnyk\Str2Name\Str2Name;
use PHPUnit\Framework\Attributes\CoversMethod;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

#[CoversMethod(Str2Name::class, 'abbreviation')]
final class AbbreviationTest extends TestCase {

  #[DataProvider('dataProviderAbbreviation')]
  public function testAbbreviation(string $input, string $expected): void {
    $this->assertSame($expected, Str2Name::abbreviation($input));
  }

  public static function dataProviderAbbreviation(): \Iterator {
    yield ['Test', 'Te'];
    yield ['Two Words', 'TW'];
    yield ['', ''];
    yield ['   ', ''];
    yield ['two Words', 'tW'];
    yield ['Two words', 'Tw'];
    yield ['two words', 'tw'];
    yield ['TWO WORDS', 'TW'];
    yield ['Äpfel Öl', 'ÄÖ'];
    yield ['A B C D E F G H I J K L M N O P Q R S T U V W X Y Z', 'AB'];
  }

  #[DataProvider('dataProviderAbbreviationCustom')]
  public function testAbbreviationCustom(string $input, int $length, array $word_delims, string $expected): void {
    $this->assertSame($expected, Str2Name::abbreviation($input, $length, $word_delims));
  }

  public static function dataProviderAbbreviationCustom(): \Iterator {
    yield ['two Words Example', 3, [' '], 'tWE'];
    yield ['FOUR WORD EXAMPLE HERE', 4, [' '], 'FWEH'];
    yield ['word-Word', 2, ['-'], 'wW'];
    yield ['word_Word', 2, ['_'], 'wW'];
    yield ['word-Word_proper.Test', 4, ['-', '_', '.'], 'wWpT'];
  }

  #[DataProvider('dataProviderAbbreviationWithoutDelimiters')]
  public function testAbbreviationWithoutDelimiters(string $input, int $length, array $word_delims, string $expected): void {
    $this->assertSame($expected, Str2Name::abbreviation($input, $length, $word_delims));
  }

  public static function dataProviderAbbreviationWithoutDelimiters(): \Iterator {
    // An empty delimiter list - or one that contains only empty strings - means
    // the string is not split: the whole trimmed value is treated as one word.
    yield ['hello', 2, [], 'he'];
    yield ['a b', 2, [], 'a '];
    yield ['one-two-three', 2, [], 'on'];
    yield ['hello world', 3, [''], 'hel'];
    yield ['ab', 2, ['', ''], 'ab'];
  }

}
