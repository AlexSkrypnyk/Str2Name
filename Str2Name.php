<?php

declare(strict_types=1);

namespace AlexSkrypnyk\Str2Name;

/**
 * Convert strings to named formats.
 *
 * @SuppressWarnings(PHPMD.TooManyPublicMethods )
 */
class Str2Name {

  /**
   * @from I am a_string-With spaces 14
   * @to i_am_a_string_with_spaces_14
   */
  public static function snake(string $string): string {
    return strtolower(str_replace([' ', '-'], '_', $string));
  }

  /**
   * @from I am a_string-With spaces 14
   * @to iAmAStringWithSpaces14
   */
  public static function camel(string $string): string {
    return lcfirst(self::pascal($string));
  }

  /**
   * @from I am a_string-With spaces 14
   * @to IAmAStringWithSpaces14
   */
  public static function pascal(string $string): string {
    $string = str_replace(['-', '_'], ' ', $string);
    $string = ucwords($string);

    return str_replace(' ', '', $string);
  }

  /**
   * @from I am a_string-With spaces 14
   * @to I-am-a-string-With-spaces-14
   */
  public static function kebab(string $string): string {
    return str_replace([' ', '_'], '-', $string);
  }

  /**
   * @from I am a_string-With spaces 14
   * @to I am a string With spaces 14
   */
  public static function label(string $string): string {
    return str_replace(['_', '-'], ' ', $string);
  }

  /**
   * @from I am a_string-With spaces 14
   * @to i_am_a_string_with_spaces_14
   */
  public static function machine(string $string): string {
    return self::snake(str_replace(['-'], ' ', $string));
  }

  /**
   * @from I am a_string-With spaces 14
   * @to i_am_a_string_with_spaces_14
   */
  public static function phpFunction(string $string): string {
    return self::snake($string);
  }

  /**
   * @from I am a_string-With spaces 14
   * @to IAmAStringWithSpaces14
   */
  public static function phpNamespace(string $string): string {
    return self::pascal($string);
  }

  /**
   * @from I am a_string-With spaces 14
   * @to IAmAStringWithSpaces14
   */
  public static function phpClass(string $string): string {
    return self::pascal($string);
  }

  /**
   * @from I am a_string-With spaces 14
   * @to IamAstringWithSpaces14
   */
  public static function phpClassStrict(string $string): string {
    $string = str_replace(['-', '_'], ' ', $string);
    $words = explode(' ', $string);
    $result = '';
    $prev = '';

    foreach ($words as $word) {
      $word = strlen($prev) === 1 && ctype_upper($prev) ? lcfirst(ucfirst(strtolower($word))) : ucfirst(strtolower($word));
      $result .= $word;
      $prev = $word;
    }

    return str_replace(' ', '', $result);
  }

  /**
   * @from I am a_string-With spaces 14
   * @to iAmAStringWithSpaces14
   */
  public static function phpMethod(string $string): string {
    return self::camel($string);
  }

}
