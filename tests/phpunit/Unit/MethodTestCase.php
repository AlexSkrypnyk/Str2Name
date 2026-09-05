<?php

declare(strict_types=1);

namespace AlexSkrypnyk\Str2Name\Tests\Unit;

use AlexSkrypnyk\Str2Name\Str2Name;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

/**
 * Per-method base test class.
 *
 * A subclass named <Method>Test provides $cases for the matching Str2Name
 * method.
 */
abstract class MethodTestCase extends TestCase {

  protected static array $cases = [];

  #[DataProvider('dataProviderMethod')]
  public function testMethod(string $input, string $expected): void {
    $test_class = basename(str_replace('\\', '/', static::class));
    $method_name = lcfirst(str_replace('Test', '', $test_class));

    $reflection = new \ReflectionClass(Str2Name::class);

    if (!$reflection->hasMethod($method_name)) {
      throw new \RuntimeException(sprintf('Method %s does not exist in %s', $method_name, Str2Name::class));
    }

    $reflection_method = new \ReflectionMethod(Str2Name::class, $method_name);
    if (!$reflection_method->isStatic()) {
      throw new \RuntimeException(sprintf('Method %s is not static in %s', $method_name, Str2Name::class));
    }

    $result = $reflection_method->invoke(NULL, $input);
    $this->assertSame($expected, $result, sprintf('> %s: %s', $test_class, $input));
  }

  public static function dataProviderMethod(): array {
    return static::$cases;
  }

}
