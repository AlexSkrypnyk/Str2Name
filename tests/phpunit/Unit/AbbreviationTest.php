<?php

declare(strict_types=1);

namespace AlexSkrypnyk\Str2Name\Tests\Unit;

use AlexSkrypnyk\Str2Name\Str2Name;
use PHPUnit\Framework\Attributes\CoversMethod;
use PHPUnit\Framework\TestCase;

#[CoversMethod(Str2Name::class, 'abbreviation')]
class AbbreviationTest extends TestCase {

  public function testAbbreviation(): void {
    $this->assertSame('Te', Str2Name::abbreviation('Test'));
    $this->assertSame('TW', Str2Name::abbreviation('Two Words'));
    $this->assertSame('', Str2Name::abbreviation(''));
    $this->assertSame('', Str2Name::abbreviation('   '));

    $this->assertSame('tW', Str2Name::abbreviation('two Words'));
    $this->assertSame('Tw', Str2Name::abbreviation('Two words'));
    $this->assertSame('tw', Str2Name::abbreviation('two words'));
    $this->assertSame('TW', Str2Name::abbreviation('TWO WORDS'));

    $this->assertSame('tWE', Str2Name::abbreviation('two Words Example', 3));
    $this->assertSame('FWEH', Str2Name::abbreviation('FOUR WORD EXAMPLE HERE', 4));

    $this->assertSame('wW', Str2Name::abbreviation('word-Word', 2, ['-']));
    $this->assertSame('wW', Str2Name::abbreviation('word_Word', 2, ['_']));
    $this->assertSame('wWpT', Str2Name::abbreviation('word-Word_proper.Test', 4, ['-', '_', '.']));

    $this->assertSame('ÄÖ', Str2Name::abbreviation('Äpfel Öl'));

    $this->assertSame('AB', Str2Name::abbreviation('A B C D E F G H I J K L M N O P Q R S T U V W X Y Z'));
  }

}
