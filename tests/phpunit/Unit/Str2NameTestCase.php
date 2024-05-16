<?php

declare(strict_types=1);

namespace AlexSkrypnyk\Str2Name\Tests\Unit;

use AlexSkrypnyk\Str2Name\Str2Name;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

abstract class Str2NameTestCase extends TestCase {

  /**
   * Additional test cases.
   *
   * By default, the test cases are taken from the comments of the class method.
   */
  protected static array $cases = [];

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
    $test_class = basename(str_replace('\\', '/', static::class));
    $method = lcfirst(str_replace('Test', '', $test_class));
    $reflection = new \ReflectionClass(Str2Name::class);
    $comment = $reflection->getMethod($method)->getDocComment();
    if ($comment === FALSE) {
      throw new \RuntimeException(sprintf('Method %s does not have a comment', $method));
    }
    $tokens = static::extractTokens($comment);
    $cases = array_map(static fn($token): array => [$token['from'], $token['to']], $tokens);

    return array_merge($cases, static::$cases);
  }

  protected static function extractTokens(string $comment): array {
    $result = [];

    $froms = [];
    $tos = [];

    if (preg_match_all('/@from (.*)/', $comment, $matches1)) {
      $froms = $matches1[1];
    }

    if (preg_match_all('/@to (.*)/', $comment, $matches2)) {
      $tos = $matches2[1];
    }

    $froms = array_filter(array_map('trim', $froms));
    $tos = array_filter(array_map('trim', $tos));

    if (count($froms) !== count($tos)) {
      throw new \RuntimeException('The number of @from and @to annotations must be equal');
    }

    foreach ($froms as $i => $from) {
      $result[] = [
        'from' => $from,
        'to' => $tos[$i],
      ];
    }

    return $result;
  }

}
