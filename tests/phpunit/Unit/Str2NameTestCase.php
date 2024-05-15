<?php

declare(strict_types=1);

namespace AlexSkrypnyk\Str2Name\Tests\Unit;

use AlexSkrypnyk\Str2Name\Str2Name;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

abstract class Str2NameTestCase extends TestCase {

  /**
   * The test cases.
   */
  protected static array $cases;

  #[DataProvider('dataProvider')]
  public function testMethod(string $input, string $expected): void {
    $test_class = basename(str_replace('\\', '/', static::class));
    $method = lcfirst(str_replace('Test', '', $test_class));
    if (!method_exists(Str2Name::class, $method)) {
      throw new \RuntimeException(sprintf('Method %s does not exist in %s', $method, Str2Name::class));
    }
    $this->assertSame($expected, Str2Name::{$method}($input), sprintf('> %s: %s', $test_class, $input));
  }

  public static function dataProvider(): array {
    return static::$cases;
  }

}
