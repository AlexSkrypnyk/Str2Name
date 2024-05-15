<?php

declare(strict_types=1);

namespace AlexSkrypnyk\Str2Name;

/**
 * Convert strings to named formats.
 */
class Str2Name {

  /**
   * @from I am a_string-With spaces 14
   * @to i_am_a_string-with_spaces_14
   */
  public static function machine(string $string): string {
    return self::snake($string);
  }

  /**
   * @from I am a_string-With spaces 14
   * @to i_am_a_string_with_spaces_14
   */
  public static function machineStrict(string $string): string {
    return self::snake($string, ['-']);
  }

  /**
   * @from I am a_string-With spaces 14
   * @to i_am_a_string_with_spaces_14
   */
  public static function snake(string $string, array $replacements = []): string {
    $replacements = array_merge([' '], $replacements);

    $string_out = str_replace($replacements, '_', $string);

    return strtolower($string_out);
  }

}
