<?php

declare(strict_types=1);

namespace AlexSkrypnyk\Str2Name;

/**
 * Convert strings to named formats.
 */
class Str2Name {

  /**
   * @from I am a_string-With spaces 14
   * @to I am a string With spaces 14
   */
  public static function label(string $string): string {
    return str_replace(['_', '-'], ' ', $string);
  }

  /**
   * @from I am a_string-With spaces 14
   * @to i_am_a_string-with_spaces_14
   */
  public static function machine(string $string): string {
    return strtolower(str_replace([' '], '_', $string));
  }

  /**
   * @from I am a_string-With spaces 14
   * @to i_am_a_string_with_spaces_14
   */
  public static function machineStrict(string $string): string {
    return strtolower(str_replace([' ', '-'], '_', $string));
  }

  /**
   * @from I am a_string-With spaces 14
   * @to i_am_a_string_with_spaces_14
   */
  public static function snake(string $string): string {
    return strtolower(str_replace([' ', '-'], '_', $string));
  }

}
