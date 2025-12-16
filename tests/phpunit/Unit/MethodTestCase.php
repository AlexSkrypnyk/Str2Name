<?php

declare(strict_types=1);

namespace AlexSkrypnyk\Str2Name\Tests\Unit;

use AlexSkrypnyk\Str2Name\Str2Name;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

/**
 * Per-method base test class.
 *
 * Allows to provide test cases for each method in a separate test class
 * named as <Method>Test class.
 *
 * This is used for extensive testing of the methods in the Str2Name class.
 */
abstract class MethodTestCase extends TestCase {

  protected static array $cases = [];

  #[DataProvider('dataProviderMethod')]
  public function testMethod(string $input, string $expected): void {
    // Use the class name to determine the method name.
    $test_class = basename(str_replace('\\', '/', static::class));
    $method_name = lcfirst(str_replace('Test', '', $test_class));

    $ref_class = new \ReflectionClass(Str2Name::class);

    if (!$ref_class->hasMethod($method_name)) {
      throw new \RuntimeException(sprintf('Method %s does not exist in %s', $method_name, Str2Name::class));
    }

    $ref_method = new \ReflectionMethod(Str2Name::class, $method_name);
    if (!$ref_method->isStatic()) {
      throw new \RuntimeException(sprintf('Method %s is not static in %s', $method_name, Str2Name::class));
    }

    if (!$ref_method->isPublic()) {
    }

    $result = $ref_method->invoke(NULL, $input);
    $this->assertSame($expected, $result, sprintf('> %s: %s', $test_class, $input));
  }

  public static function dataProviderMethod(): array {
    return static::$cases;
  }

}
