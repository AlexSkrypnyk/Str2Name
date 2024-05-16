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
   * @to i-am-a-string-with-spaces-14
   */
  public static function kebab(string $string): string {
    return strtolower(str_replace([' ', '_'], '-', $string));
  }

  /**
   * @from I am a_string-With spaces 14
   * @to I-Am-A-String-With-Spaces-14
   */
  public static function train(string $string): string {
    return ucwords(self::kebab($string), '-');
  }

  /**
   * @from I am a_string-With spaces 14
   * @to iamastringwithspaces14
   */
  public static function flat(string $string): string {
    return str_replace('_', '', strtolower(self::snake($string)));
  }

  /**
   * @from I am a_string-With spaces 14
   * @to I am a string-with spaces 14
   */
  public static function sentence(string $string): string {
    return ucfirst(strtolower(str_replace(['_'], ' ', $string)));
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
   * @to I_AM_A_STRING_WITH_SPACES_14
   */
  public static function constant(string $string): string {
    return strtoupper(self::snake($string));
  }

  /**
   * @from I am a_string-With spaces 14
   * @to I-AM-A-STRING-WITH-SPACES-14
   */
  public static function cobol(string $string): string {
    return strtoupper(self::kebab($string));
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

  /**
   * @from I am a_string-With spaces 14
   * @to i_am_a_stringwith_spaces_14
   */
  public static function domain(string $string): string {
    return self::snake(str_replace('-', '', $string));
  }

  /**
   * @from I am a_string-With spaces 14
   * @to I-Am-A-String-With-Spaces-14
   */
  public static function httpHeader(string $string): string {
    return self::train($string);
  }

  /**
   * @from I am a_string-With spaces 14
   * @to i_am_a_string-with_spaces_14
   */
  public static function cssClass(string $string): string {
    return strtolower(str_replace([' '], '_', $string));
  }

  /**
   * @from I am a_string-With spaces 14
   * @to i-am-a-string-with-spaces-14
   * @see http://www.w3.org/TR/html4/types.html#type-name
   * @see https://api.drupal.org/api/drupal/core%21lib%21Drupal%21Component%21Utility%21Html.php/function/Html%3A%3AgetId/10
   */
  public static function cssId(string $string): string {
    $string = str_replace([' ', '_', '[', ']'], ['-', '-', '-', ''], strtolower($string));
    $string = (string) preg_replace('/[^A-Za-z0-9\-_]/', '', $string);

    return (string) preg_replace('/-+/', '-', $string);
  }

  /**
   * @from I am a_string-With spaces 14
   * @to iamastringwithspaces14
   */
  public static function id(string $string): string {
    return self::flat($string);
  }

  /**
   * @from I am a_string-With spaces 14
   * @to IAMASTRINGWITHSPACES14
   */
  public static function idUpper(string $string): string {
    return strtoupper(self::flat($string));
  }

}
