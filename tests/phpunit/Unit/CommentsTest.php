<?php

declare(strict_types=1);

namespace AlexSkrypnyk\Str2Name\Tests\Unit;

use AlexSkrypnyk\Str2Name\Str2Name;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

#[CoversClass(Str2Name::class)]
final class CommentsTest extends TestCase {

  #[DataProvider('dataProviderMethod')]
  public function testMethod(string $method, string $input, string $expected): void {
    $this->assertSame($expected, Str2Name::{$method}($input), sprintf('> %s: %s', $method, $input));
  }

  public static function dataProviderMethod(): array {
    $cases = [];

    $reflection = new \ReflectionClass(Str2Name::class);
    foreach ($reflection->getMethods(\ReflectionMethod::IS_PUBLIC) as $reflection_method) {
      $method_name = $reflection_method->getName();
      $comment = $reflection_method->getDocComment();
      if ($comment === FALSE) {
        throw new \RuntimeException(sprintf('Method %s does not have a comment', $method_name));
      }

      $tokens = self::extractTokens($comment, $method_name);

      if (empty($tokens)) {
        continue;
      }

      $method_cases = array_map(static fn(array $token): array => [
        $method_name,
        $token['from'],
        $token['to'],
      ], $tokens);
      $cases = array_merge($cases, $method_cases);
    }

    return $cases;
  }

  protected static function extractTokens(string $comment, string $method_name): array {
    $result = [];

    $froms = [];
    $tos = [];

    if (preg_match_all('/@from (.*)/', $comment, $from_matches)) {
      $froms = $from_matches[1];
    }

    if (preg_match_all('/@to (.*)/', $comment, $to_matches)) {
      $tos = $to_matches[1];
    }

    $froms = array_values(array_filter(array_map(trim(...), $froms), static fn(string $v): bool => $v !== ''));
    $tos = array_values(array_filter(array_map(trim(...), $tos), static fn(string $v): bool => $v !== ''));

    if (count($froms) !== count($tos)) {
      throw new \RuntimeException(sprintf('The number of @from and @to annotations must be equal for method %s', $method_name));
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
