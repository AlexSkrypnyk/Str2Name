<?php

/**
 * @file
 * Documentation generator.
 */

declare(strict_types=1);

use AlexSkrypnyk\Str2Name\Str2Name;

require_once __DIR__ . '/Str2Name.php';

$tokens = parse_tokens(Str2Name::class);

if (empty($tokens)) {
  echo "No PHPDoc comments found in the file.\n";
  exit(1);
}

$generic_formatters = [
  'camel',
  'cobol',
  'flat',
  'kebab',
  'pascal',
  'snake',
  'train',
];

$generic_formatter_tokens = array_intersect_key($tokens, array_flip($generic_formatters));

$markdown = "\n";
$markdown .= tokens_to_markdown_table($generic_formatter_tokens);
$markdown .= "\n";

$generic_converters_tokens = array_diff_key($tokens, array_flip($generic_formatters));
$generic_converters_tokens = array_filter($generic_converters_tokens, static function (string $token): bool {
  return str_contains($token, '2');
}, ARRAY_FILTER_USE_KEY);

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
  echo "Failed to read README.md.\n";
  exit(1);
}

$readme_replaced = replace_content($readme, '## Generic formatters', '## Maintenance', $markdown);

if ($readme_replaced === $readme) {
  echo "Documentation is up to date. No changes were made.\n";
  exit(0);
}

$fail_on_change = ($argv[1] ?? '') === '--fail-on-change';
if ($fail_on_change && $readme_replaced !== $readme) {
  echo "Documentation is outdated. No changes were made.\n";
  exit(1);
}
else {
  file_put_contents(__DIR__ . '/README.md', $readme_replaced);
  echo "Documentation updated.\n";
}

/**
 * Parse tokens from the class.
 *
 * @param class-string $class_name
 *   The class name.
 *
 * @return array<string, array<string, string>>
 *   Array of tokens with 'method', 'from', and 'to' keys.
 *
 * @throws \ReflectionException
 */
function parse_tokens(string $class_name): array {
  $reflection = new ReflectionClass($class_name);
  $methods = $reflection->getMethods(ReflectionMethod::IS_PUBLIC);

  $result = [];

  foreach ($methods as $method) {
    $comment = $method->getDocComment();

    if ($comment) {
      $from = '';
      $to = '';

      if (preg_match('/@from (.*)/', $comment, $fromMatch)) {
        $from = $fromMatch[1];
      }

      if (preg_match('/@to (.*)/', $comment, $toMatch)) {
        $to = $toMatch[1];
      }

      if (!empty($from) && !empty($to)) {
        $result[$method->getName()] = [
          'method' => $method->getName(),
          'from' => $from,
          'to' => $to,
        ];
      }
    }
  }

  return $result;
}

/**
 * Convert tokens to markdown table.
 *
 * @param array<string, array<string, string>> $tokens
 *   Array of tokens with 'method', 'from', and 'to' keys.
 *
 * @return string
 *   Markdown table.
 */
function tokens_to_markdown_table(array $tokens): string {
  $markdown = "| Method | Conversion|\n";
  $markdown .= "| --- | --- |\n";

  foreach ($tokens as $token) {
    $markdown .= "| `" . $token['method'] . "` | `" . $token['from'] . "` <br/> `" . $token['to'] . "` |\n";
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
 */
function replace_content(string $haystack, string $start, string $end, string $replacement): string {
  $pattern = '/' . preg_quote($start, '/') . '.*?' . preg_quote($end, '/') . '/s';
  $replacement = $start . "\n" . $replacement . "\n" . $end;

  return (string) preg_replace($pattern, $replacement, $haystack);
}
