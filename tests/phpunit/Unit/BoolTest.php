<?php

declare(strict_types=1);

namespace AlexSkrypnyk\Str2Name\Tests\Unit;

use AlexSkrypnyk\Str2Name\Str2Name;
use PHPUnit\Framework\Attributes\CoversMethod;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

#[CoversMethod(Str2Name::class, 'bool')]
final class BoolTest extends TestCase {

  #[DataProvider('dataProviderBoolDefault')]
  public function testBoolDefault(string|bool|int $input, string $expected): void {
    $this->assertSame($expected, Str2Name::bool($input));
  }

  public static function dataProviderBoolDefault(): \Iterator {
    yield [TRUE, 'Yes'];
    yield [1, 'Yes'];
    yield ['1', 'Yes'];
    yield ['true', 'Yes'];
    yield ['yes', 'Yes'];
    yield [FALSE, 'No'];
    yield [0, 'No'];
    yield ['0', 'No'];
    yield ['', 'No'];
    yield ['anything else', 'No'];
    yield [42, 'No'];
    yield [-1, 'No'];
  }

  #[DataProvider('dataProviderBoolCustom')]
  public function testBoolCustom(string|bool|int $input, string $true, string $false, string $expected): void {
    $this->assertSame($expected, Str2Name::bool($input, $true, $false));
  }

  public static function dataProviderBoolCustom(): \Iterator {
    yield [TRUE, 'True', 'False', 'True'];
    yield [1, 'True', 'False', 'True'];
    yield [0, 'True', 'False', 'False'];
    yield [TRUE, 'On', 'Off', 'On'];
    yield [FALSE, 'On', 'Off', 'Off'];
    yield ['1', 'Oui', 'Non', 'Oui'];
    yield ['0', 'Oui', 'Non', 'Non'];
    yield [TRUE, '✅', '❌', '✅'];
    yield [FALSE, '✅', '❌', '❌'];
  }

}
