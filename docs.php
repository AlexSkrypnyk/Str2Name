<?php

/**
 * @file
 * Documentation generator.
 */

declare(strict_types=1);

use AlexSkrypnyk\Str2Name\Str2Name;

require_once __DIR__ . '/Str2Name.php';

try {
  $tokens = parse_tokens(Str2Name::class);
}
catch (\RuntimeException $exception) {
  fwrite(STDERR, $exception->getMessage() . "\n");
  exit(1);
}

if (empty($tokens)) {
  fwrite(STDERR, "No PHPDoc comments found in the file.\n");
  exit(1);
}

$generic_formatters = [
  'camel',
  'cobol',
  'flat',
  'kebab',
  'lower',
  'pascal',
  'snake',
  'train',
  'upper',
];

$generic_formatters_tokens = array_intersect_key($tokens, array_flip($generic_formatters));

$markdown = "\n";
$markdown .= tokens_to_markdown_table($generic_formatters_tokens);
$markdown .= "\n";

$generic_converters_tokens = array_diff_key($tokens, array_flip($generic_formatters));
$generic_converters_tokens = array_filter($generic_converters_tokens, static fn(string $method_name): bool => str_contains($method_name, '2'), ARRAY_FILTER_USE_KEY);

$markdown .= "\n";
$markdown .= "## Converters between generic formats\n";
$markdown .= "\n";
$markdown .= tokens_to_markdown_table($generic_converters_tokens);
$markdown .= "\n";

$named_formatters_tokens = array_diff_key($tokens, array_flip($generic_formatters), $generic_converters_tokens);
ksort($named_formatters_tokens);

$markdown .= "\n";
$markdown .= "## Named formatters\n";
$markdown .= "\n";
$markdown .= tokens_to_markdown_table($named_formatters_tokens);
$markdown .= "\n";

$readme = file_get_contents(__DIR__ . '/README.md');

if ($readme === FALSE) {
  fwrite(STDERR, "Failed to read README.md.\n");
  exit(1);
}

$readme_replaced = replace_content($readme, '## Generic formatters', '## Maintenance', $markdown);

if ($readme_replaced === $readme) {
  echo "Documentation is up to date. No changes were made.\n";
  exit(0);
}

$fail_on_change = ($argv[1] ?? '') === '--fail-on-change';
if ($fail_on_change) {
  fwrite(STDERR, "Documentation is outdated. No changes were made.\n");
  exit(1);
}
file_put_contents(__DIR__ . '/README.md', $readme_replaced);
echo "Documentation updated.\n";
exit(0);

/**
 * Parse tokens from the class.
 *
 * @param class-string $class_name
 *   The class name.
 *
 * @return array<string, array{method: string, pairs: array<int, array{from: string, to: string}>}>
 *   Array of tokens keyed by method name, each with a 'method' key and a
 *   'pairs' list of 'from'/'to' annotation values.
 *
 * @throws \ReflectionException
 * @throws \RuntimeException
 */
function parse_tokens(string $class_name): array {
  $reflection = new ReflectionClass($class_name);
  $methods = $reflection->getMethods(ReflectionMethod::IS_PUBLIC);

  $result = [];

  foreach ($methods as $method) {
    $method_name = $method->getName();
    $comment = $method->getDocComment();

    if ($comment === FALSE) {
      throw new \RuntimeException(sprintf('Method %s does not have a comment', $method_name));
    }

    preg_match_all('/@from (.*)/', $comment, $from_matches);
    preg_match_all('/@to (.*)/', $comment, $to_matches);

    $froms = array_values(array_filter(array_map(trim(...), $from_matches[1]), static fn(string $v): bool => $v !== ''));
    $tos = array_values(array_filter(array_map(trim(...), $to_matches[1]), static fn(string $v): bool => $v !== ''));

    if (count($froms) !== count($tos)) {
      throw new \RuntimeException(sprintf('The number of @from and @to annotations must be equal for method %s', $method_name));
    }

    if ($froms === []) {
      continue;
    }

    $pairs = [];

    foreach ($froms as $i => $from) {
      $pairs[] = ['from' => $from, 'to' => $tos[$i]];
    }

    $result[$method_name] = [
      'method' => $method_name,
      'pairs' => $pairs,
    ];
  }

  return $result;
}

/**
 * Convert tokens to markdown table.
 *
 * @param array<string, array{method: string, pairs: array<int, array{from: string, to: string}>}> $tokens
 *   Array of tokens keyed by method name, each with a 'method' key and a
 *   'pairs' list of 'from'/'to' annotation values.
 *
 * @return string
 *   Markdown table.
 */
function tokens_to_markdown_table(array $tokens): string {
  $markdown = "| Method | Conversion|\n";
  $markdown .= "| --- | --- |\n";

  foreach ($tokens as $token) {
    foreach ($token['pairs'] as $pair) {
      $markdown .= '| `' . $token['method'] . '` | `' . $pair['from'] . '` <br/> `' . $pair['to'] . "` |\n";
    }
  }

  return trim($markdown);
}

/**
 * Replace content in a string.
 *
 * @param string $haystack
 *   The content to search and replace in.
 * @param string $start
 *   The start of the content to replace.
 * @param string $end
 *   The end of the content to replace.
 * @param string $replacement
 *   The replacement content.
 *
 * @return string
 *   The replaced content.
 */
function replace_content(string $haystack, string $start, string $end, string $replacement): string {
  $pattern = '/' . preg_quote($start, '/') . '.*?' . preg_quote($end, '/') . '/s';
  $replacement = $start . "\n" . $replacement . "\n" . $end;

  return (string) preg_replace($pattern, $replacement, $haystack);
}
