<?php

declare(strict_types=1);

namespace AlexSkrypnyk\Str2Name\Tests\Unit;

use AlexSkrypnyk\Str2Name\Str2Name;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

/**
 * Class Str2NameTest.
 *
 * Test the Str2Name class.
 */
#[CoversClass(Str2Name::class)]
class Str2NameTest extends TestCase {

  /**
   * Test the machine method.
   *
   * @dataProvider dataProviderMachine
   */
  public function testMachine(string $input, string $expected): void {
    $this->assertSame($expected, Str2Name::machine($input));
  }

  /**
   * Data provider for testMachine.
   */
  public static function dataProviderMachine(): array {
    return [
      ['I am a_string-With spaces 14', 'i_am_a_string-with_spaces_14'],
    ];
  }

  /**
   * Test the snakeCase method.
   *
   * @dataProvider dataProviderSnakeCase
   */
  public function testSnakeCase(string $input, string $expected): void {
    $this->assertSame($expected, Str2Name::snakeCase($input));
  }

  /**
   * Data provider for testSnakeCase.
   */
  public static function dataProviderSnakeCase(): array {
    return [
      ['I am a_string-With spaces 14', 'i_am_a_string-with_spaces_14'],
    ];
  }

}
