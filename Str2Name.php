<?php

declare(strict_types=1);

namespace AlexSkrypnyk\Str2Name;

/**
 * Convert string to machine name.
 */
class Str2Name {

  /**
   * Convert string to machine name.
   *
   * @from I am a_string-With spaces 14
   * @to i_am_a_string-with_spaces_14
   */
  public static function machine(string $string): string {
    return self::snakeCase($string);
  }

  /**
   * Convert string to snake case.
   *
   * @from I am a_string-With spaces 14
   * @to i_am_a_string-with_spaces_14
   */
  public static function snakeCase(string $string): string {
    $string_out = str_replace(' ', '_', $string);

    return strtolower($string_out);
  }

}
