<?php

declare(strict_types=1);

namespace AlexSkrypnyk\Str2Name\Tests\Unit;

use AlexSkrypnyk\Str2Name\Str2Name;
use PHPUnit\Framework\Attributes\CoversMethod;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

#[CoversMethod(Str2Name::class, 'snake')]
#[CoversMethod(Str2Name::class, 'camel')]
#[CoversMethod(Str2Name::class, 'pascal')]
#[CoversMethod(Str2Name::class, 'kebab')]
#[CoversMethod(Str2Name::class, 'label')]
#[CoversMethod(Str2Name::class, 'machine')]
#[CoversMethod(Str2Name::class, 'phpFunction')]
#[CoversMethod(Str2Name::class, 'phpNamespace')]
#[CoversMethod(Str2Name::class, 'phpClass')]
#[CoversMethod(Str2Name::class, 'phpClassStrict')]
#[CoversMethod(Str2Name::class, 'phpMethod')]
class CommentsTest extends TestCase {

  #[DataProvider('dataProvider')]
  public function testMethod(string $method, string $input, string $expected): void {
    $this->assertSame($expected, Str2Name::{$method}($input), sprintf('> %s: %s', $method, $input));
  }

  public static function dataProvider(): array {
    $cases = [];

    $reflection = new \ReflectionClass(Str2Name::class);
    foreach ($reflection->getMethods(\ReflectionMethod::IS_PUBLIC) as $method) {
      $method_name = $method->getName();
      $comment = $reflection->getMethod($method_name)->getDocComment();
      if ($comment === FALSE) {
        throw new \RuntimeException(sprintf('Method %s does not have a comment', $method));
      }
      $tokens = static::extractTokens($comment);
      $method_cases = array_map(static function (array $token) use ($method_name): array {
        return [$method_name, $token['from'], $token['to']];
      }, $tokens);
      $cases = array_merge($cases, $method_cases);
    }

    return $cases;
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
