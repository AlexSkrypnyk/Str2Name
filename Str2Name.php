<?php

declare(strict_types=1);

namespace AlexSkrypnyk\Str2Name;

/**
 * Convert strings to named formats.
 *
 * @SuppressWarnings(PHPMD.TooManyMethods)
 * @SuppressWarnings(PHPMD.TooManyPublicMethods)
 * @SuppressWarnings(PHPMD.ExcessiveClassComplexity)
 * @SuppressWarnings(PHPMD.ExcessivePublicCount)
 * phpcs:disable Drupal.Commenting.DocComment.MissingShort
 */
class Str2Name {

  // @formatter:off
  // @phpcs:disable Drupal.Arrays.Array.LongLineDeclaration
  const MB_MAP = ['*' => ' ', '?' => ' ', '’' => "'", '.' => ' ', ',' => ', ', '“' => '', '”' => '', 'À' => 'A', 'Á' => 'A', 'Â' => 'A', 'Ã' => 'A', 'Ä' => 'A', 'Å' => 'A', 'Æ' => 'AE', 'Ç' => 'C', 'È' => 'E', 'É' => 'E', 'Ê' => 'E', 'Ë' => 'E', 'Ì' => 'I', 'Í' => 'I', 'Î' => 'I', 'Ï' => 'I', 'Ð' => 'D', 'Ñ' => 'N', 'Ò' => 'O', 'Ó' => 'O', 'Ô' => 'O', 'Õ' => 'O', 'Ö' => 'O', 'Ø' => 'O', 'Ù' => 'U', 'Ú' => 'U', 'Û' => 'U', 'Ü' => 'U', 'Ý' => 'Y', 'ß' => 's', 'à' => 'a', 'á' => 'a', 'â' => 'a', 'ã' => 'a', 'ä' => 'a', 'å' => 'a', 'æ' => 'ae', 'ç' => 'c', 'è' => 'e', 'é' => 'e', 'ê' => 'e', 'ë' => 'e', 'ì' => 'i', 'í' => 'i', 'î' => 'i', 'ï' => 'i', 'ñ' => 'n', 'ò' => 'o', 'ó' => 'o', 'ô' => 'o', 'õ' => 'o', 'ö' => 'o', 'ø' => 'o', 'ù' => 'u', 'ú' => 'u', 'û' => 'u', 'ü' => 'u', 'ý' => 'y', 'ÿ' => 'y', 'Ā' => 'A', 'ā' => 'a', 'Ă' => 'A', 'ă' => 'a', 'Ą' => 'A', 'ą' => 'a', 'Ć' => 'C', 'ć' => 'c', 'Ĉ' => 'C', 'ĉ' => 'c', 'Ċ' => 'C', 'ċ' => 'c', 'Č' => 'C', 'č' => 'c', 'Ď' => 'D', 'ď' => 'd', 'Đ' => 'D', 'đ' => 'd', 'Ē' => 'E', 'ē' => 'e', 'Ĕ' => 'E', 'ĕ' => 'e', 'Ė' => 'E', 'ė' => 'e', 'Ę' => 'E', 'ę' => 'e', 'Ě' => 'E', 'ě' => 'e', 'Ĝ' => 'G', 'ĝ' => 'g', 'Ğ' => 'G', 'ğ' => 'g', 'Ġ' => 'G', 'ġ' => 'g', 'Ģ' => 'G', 'ģ' => 'g', 'Ĥ' => 'H', 'ĥ' => 'h', 'Ħ' => 'H', 'ħ' => 'h', 'Ĩ' => 'I', 'ĩ' => 'i', 'Ī' => 'I', 'ī' => 'i', 'Ĭ' => 'I', 'ĭ' => 'i', 'Į' => 'I', 'į' => 'i', 'İ' => 'I', 'ı' => 'i', 'Ĳ' => 'IJ', 'ĳ' => 'ij', 'Ĵ' => 'J', 'ĵ' => 'j', 'Ķ' => 'K', 'ķ' => 'k', 'Ĺ' => 'L', 'ĺ' => 'l', 'Ļ' => 'L', 'ļ' => 'l', 'Ľ' => 'L', 'ľ' => 'l', 'Ŀ' => 'L', 'ŀ' => 'l', 'Ł' => 'L', 'ł' => 'l', 'Ń' => 'N', 'ń' => 'n', 'Ņ' => 'N', 'ņ' => 'n', 'Ň' => 'N', 'ň' => 'n', 'ŉ' => 'n', 'Ō' => 'O', 'ō' => 'o', 'Ŏ' => 'O', 'ŏ' => 'o', 'Ő' => 'O', 'ő' => 'o', 'Œ' => 'OE', 'œ' => 'oe', 'Ŕ' => 'R', 'ŕ' => 'r', 'Ŗ' => 'R', 'ŗ' => 'r', 'Ř' => 'R', 'ř' => 'r', 'Ś' => 'S', 'ś' => 's', 'Ŝ' => 'S', 'ŝ' => 's', 'Ş' => 'S', 'ş' => 's', 'Š' => 'S', 'š' => 's', 'Ţ' => 'T', 'ţ' => 't', 'Ť' => 'T', 'ť' => 't', 'Ŧ' => 'T', 'ŧ' => 't', 'Ũ' => 'U', 'ũ' => 'u', 'Ū' => 'U', 'ū' => 'u', 'Ŭ' => 'U', 'ŭ' => 'u', 'Ů' => 'U', 'ů' => 'u', 'Ű' => 'U', 'ű' => 'u', 'Ų' => 'U', 'ų' => 'u', 'Ŵ' => 'W', 'ŵ' => 'w', 'Ŷ' => 'Y', 'ŷ' => 'y', 'Ÿ' => 'Y', 'Ź' => 'Z', 'ź' => 'z', 'Ż' => 'Z', 'ż' => 'z', 'Ž' => 'Z', 'ž' => 'z', 'ſ' => 's', 'ƒ' => 'f', 'Ơ' => 'O', 'ơ' => 'o', 'Ư' => 'U', 'ư' => 'u', 'Ǎ' => 'A', 'ǎ' => 'a', 'Ǐ' => 'I', 'ǐ' => 'i', 'Ǒ' => 'O', 'ǒ' => 'o', 'Ǔ' => 'U', 'ǔ' => 'u', 'Ǖ' => 'U', 'ǖ' => 'u', 'Ǘ' => 'U', 'ǘ' => 'u', 'Ǚ' => 'U', 'ǚ' => 'u', 'Ǜ' => 'U', 'ǜ' => 'u', 'Ǻ' => 'A', 'ǻ' => 'a', 'Ǽ' => 'AE', 'ǽ' => 'ae', 'Ǿ' => 'O', 'ǿ' => 'o', 'Ά' => 'Α', 'ά' => 'α', 'Έ' => 'Ε', 'έ' => 'ε', 'Ό' => 'Ο', 'ό' => 'ο', 'Ώ' => 'Ω', 'ώ' => 'ω', 'Ί' => 'Ι', 'ί' => 'ι', 'ϊ' => 'ι', 'ΐ' => 'ι', 'Ύ' => 'Υ', 'ύ' => 'υ', 'ϋ' => 'υ', 'ΰ' => 'υ', 'Ή' => 'Η', 'ή' => 'η'];
  // @formatter:on
  //
  // ===========================================================================
  // GENERIC FORMATTERS
  // ===========================================================================

  /**
   * @from I am a__string-With sp@ce¥s 14 and 😀 unicode élève
   * @to i_am_a__string_with_sp@ce¥s_14_and_😀_unicode_élève
   */
  public static function snake(string $string): string {
    return mb_strtolower(str_replace([' ', '-'], '_', $string));
  }

  /**
   * @from I am a__string-With sp@ce¥s 14 and 😀 unicode élève
   * @to iAmAStringWithSp@ce¥s14And😀UnicodeÉlève
   */
  public static function camel(string $string): string {
    return static::mbLcfirst(static::pascal($string));
  }

  /**
   * @from I am a__string-With sp@ce¥s 14 and 😀 unicode élève
   * @to IAmAStringWithSp@ce¥s14And😀UnicodeÉlève
   */
  public static function pascal(string $string): string {
    $string = str_replace(['-', '_'], ' ', $string);
    $string = static::mbUcwords($string);

    return str_replace(' ', '', $string);
  }

  /**
   * @from I am a__string-With sp@ce¥s 14 and 😀 unicode élève
   * @to i-am-a--string-with-sp@ce¥s-14-and-😀-unicode-élève
   */
  public static function kebab(string $string): string {
    return mb_strtolower(str_replace([' ', '_'], '-', $string));
  }

  /**
   * @from I am a__string-With sp@ce¥s 14 and 😀 unicode élève
   * @to I-Am-A--String-With-Sp@ce¥s-14-And-😀-Unicode-Élève
   */
  public static function train(string $string): string {
    return static::mbUcwords(static::kebab($string), '-');
  }

  /**
   * @from I am a__string-With sp@ce¥s 14 and 😀 unicode élève
   * @to iamastringwithsp@ce¥s14and😀unicodeélève
   */
  public static function flat(string $string): string {
    return str_replace('_', '', mb_strtolower(static::snake($string)));
  }

  /**
   * @from I am a__string-With sp@ce¥s 14 and 😀 unicode élève
   * @to I am a string-with sp@ce¥s 14 and 😀 unicode élève
   */
  public static function sentence(string $string): string {
    $string = str_replace(['_'], ' ', $string);
    $string = (string) preg_replace('/[\s]{2,}/', ' ', $string);

    return static::mbUcfirst(mb_strtolower($string));
  }

  /**
   * @from I am a__string-With sp@ce¥s 14 and 😀 unicode élève
   * @to I am a string With sp@ce¥s 14 and 😀 unicode élève
   */
  public static function label(string $string): string {
    return (string) preg_replace('/[\s]{2,}/', ' ', str_replace(['_', '-'], ' ', $string));
  }

  /**
   * @from I am a__string-With sp@ce¥s 14 and 😀 unicode élève
   * @to i_am_a__string_with_spces_14_and__unicode_eleve
   */
  public static function machine(string $string): string {
    $string = static::strict($string);

    return static::snake(str_replace(['-'], ' ', $string));
  }

  /**
   * @from I am a__string-With sp@ce¥s 14 and 😀 unicode élève
   * @to i_am_a__string_with_sp@ce¥s_14_and_😀_unicode_élève
   */
  public static function machineRaw(string $string): string {
    return static::snake(str_replace(['-'], ' ', $string));
  }

  /**
   * @from I am a__string-With sp@ce¥s 14 and 😀 unicode élève
   * @to I_AM_A__STRING_WITH_SPCES_14_AND__UNICODE_ELEVE
   */
  public static function constant(string $string): string {
    $string = static::strict($string);

    return mb_strtoupper(static::snake($string));
  }

  /**
   * @from I am a__string-With sp@ce¥s 14 and 😀 unicode élève
   * @to I_AM_A__STRING_WITH_SP@CE¥S_14_AND_😀_UNICODE_ÉLÈVE
   */
  public static function constantRaw(string $string): string {
    return mb_strtoupper(static::snake($string));
  }

  /**
   * @from I am a__string-With sp@ce¥s 14 and 😀 unicode élève
   * @to I-AM-A--STRING-WITH-SP@CE¥S-14-AND-😀-UNICODE-ÉLÈVE
   */
  public static function cobol(string $string): string {
    return mb_strtoupper(static::kebab($string));
  }

  /**
   * @from I am a__string-With sp@ce¥s 14 and 😀 unicode élève
   * @to i_am_a__string_with_spces_14_and__unicode_eleve
   */
  public static function phpFunction(string $string): string {
    $string = static::strict($string);

    return static::snake($string);
  }

  /**
   * @from I am a__string-With sp@ce¥s 14 and 😀 unicode élève
   * @to i_am_a__string_with_sp@ce¥s_14_and_😀_unicode_élève
   */
  public static function phpFunctionRaw(string $string): string {
    return static::snake($string);
  }

  /**
   * @from I am a__string-With sp@ce¥s 14 and 😀 unicode élève
   * @to IAmAStringWithSpces14AndUnicodeEleve
   */
  public static function phpNamespace(string $string): string {
    $string = static::strict($string);

    return static::pascal($string);
  }

  /**
   * @from I am a__string-With sp@ce¥s 14 and 😀 unicode élève
   * @to IAmAStringWithSp@ce¥s14And😀UnicodeÉlève
   */
  public static function phpNamespaceRaw(string $string): string {
    return static::pascal($string);
  }

  /**
   * @from I am a__string-With sp@ce¥s 14 and 😀 unicode élève
   * @to IamAStringWithSpces14AndUnicodeEleve
   */
  public static function phpClass(string $string): string {
    $string = static::strict($string);

    $string = str_replace(['-', '_'], ' ', $string);

    $words = explode(' ', $string);
    $result = '';
    $prev = '';

    foreach ($words as $word) {
      $word = strlen($prev) === 1 && ctype_upper($prev) ? static::mbLcfirst(static::mbUcfirst(mb_strtolower($word))) : static::mbUcfirst(mb_strtolower($word));
      $result .= $word;
      $prev = $word;
    }

    $string = str_replace(' ', '', $result);

    return static::emojiRemove($string);
  }

  /**
   * @from I am a__string-With sp@ce¥s 14 and 😀 unicode élève
   * @to IAmAStringWithSp@ce¥s14And😀UnicodeÉlève
   */
  public static function phpClassRaw(string $string): string {
    return static::pascal($string);
  }

  /**
   * @from I am a__string-With sp@ce¥s 14 and 😀 unicode élève
   * @to iAmAStringWithSpces14AndUnicodeEleve
   */
  public static function phpMethod(string $string): string {
    $string = static::strict($string);

    return static::camel($string);
  }

  /**
   * @from I am a__string-With sp@ce¥s 14 and 😀 unicode élève
   * @to iAmAStringWithSp@ce¥s14And😀UnicodeÉlève
   */
  public static function phpMethodRaw(string $string): string {
    return static::camel($string);
  }

  /**
   * @from I am a__string-W/ith sp@ce¥s 14 and 😀 unicode élève
   * @to i-am-a__string-w/ith-sp-ce-s-14-and-unicode-l-ve
   */
  public static function phpPackage(string $string): string {
    $parts = explode('/', $string);

    if (count($parts) !== 2) {
      return '';
    }

    $namespace = (string) preg_replace('/[^a-z0-9_.-]+/', '-', mb_strtolower($parts[0]));
    $name = (string) preg_replace('/[^a-z0-9_.-]+/', '-', mb_strtolower($parts[1]));

    if ($namespace === '-' || $name === '-') {
      return '';
    }

    return $namespace . '/' . $name;
  }

  /**
   * @from I am a__string-With sp@ce¥s 14 and 😀 unicode élève
   * @to i-am-a__string-with-sp-ce-s-14-and-unicode-l-ve
   */
  public static function phpPackageNamespace(string $string): string {
    return (string) preg_replace('/[^a-z0-9_.-]+/', '-', mb_strtolower($string));
  }

  /**
   * @from I am a__string-With sp@ce¥s 14 and 😀 unicode élève
   * @to i-am-a__string-with-sp-ce-s-14-and-unicode-l-ve
   */
  public static function phpPackageName(string $string): string {
    return (string) preg_replace('/[^a-z0-9_.-]+/', '-', mb_strtolower($string));
  }

  /**
   * @from I am a__string-With sp@ce¥s 14 and 😀 unicode élève
   * @to i_am_a__stringwith_sp@ce¥s_14_and_😀_unicode_élève
   */
  public static function domain(string $string): string {
    return static::snake(str_replace('-', '', $string));
  }

  /**
   * @from I am a__string-With sp@ce¥s 14 and 😀 unicode élève
   * @to I-Am-A--String-With-Spces-14-And--Unicode-Eleve
   */
  public static function httpHeader(string $string): string {
    $string = static::strict($string);

    return static::train($string);
  }

  /**
   * @from I am a__string-With sp@ce¥s 14 and 😀 unicode élève
   * @to i-am-a__string-with-spces-14-and--unicode-eleve
   */
  public static function cssClass(string $string): string {
    $string = static::strict($string);
    $string = mb_strtolower(static::cssClassRaw($string));

    return static::mbRemove($string);
  }

  /**
   * @from I am a__string-With sp@ce¥s 14 and 😀 unicode élève
   * @to I-am-a__string-With-spce¥s-14-and--unicode-élève
   *
   * @see http://www.w3.org/TR/CSS21/syndata.html#characters
   * @see https://api.drupal.org/api/drupal/core%21lib%21Drupal%21Component%21Utility%21Html.php/function/Html%3A%3AcleanCssIdentifier/10
   */
  public static function cssClassRaw(string $string): string {
    $tmp_replacements = 0;
    $string = str_replace('__', '##', $string, $tmp_replacements);
    $string = str_replace([' ', '_', '/', '[', ']'], ['-', '-', '', '', ''], $string);
    $string = $tmp_replacements > 0 ? str_replace('##', '__', $string) : $string;
    $string = (string) preg_replace('/[^\x{002D}\x{0030}-\x{0039}\x{0041}-\x{005A}\x{005F}\x{0061}-\x{007A}\x{00A1}-\x{FFFF}]/u', '', $string);

    return (string) preg_replace(['/^\d/', '/^(-\d)|^(--)/'], ['_', '__'], $string);
  }

  /**
   * @from I am a__string-With sp@ce¥s 14 and 😀 unicode élève
   * @to i-am-a-string-with-spces-14-and-unicode-eleve
   *
   * @see http://www.w3.org/TR/html4/types.html#type-name
   * @see https://api.drupal.org/api/drupal/core%21lib%21Drupal%21Component%21Utility%21Html.php/function/Html%3A%3AgetId/10
   */
  public static function cssId(string $string): string {
    $string = static::strict($string);
    $string = str_replace([' ', '_', '[', ']'], ['-', '-', '-', ''], mb_strtolower($string));
    $string = (string) preg_replace('/[^A-Za-z0-9\-_]/', '', $string);

    return (string) preg_replace('/-+/', '-', $string);
  }

  /**
   * @from I am a__string-With sp@ce¥s 14 and 😀 unicode élève
   * @to i-am-a-string-with-spces-14-and-unicode-lve
   *
   * @see http://www.w3.org/TR/html4/types.html#type-name
   * @see https://api.drupal.org/api/drupal/core%21lib%21Drupal%21Component%21Utility%21Html.php/function/Html%3A%3AgetId/10
   */
  public static function cssIdRaw(string $string): string {
    $string = str_replace([' ', '_', '[', ']'], ['-', '-', '-', ''], mb_strtolower($string));
    $string = (string) preg_replace('/[^A-Za-z0-9\-_]/', '', $string);

    return (string) preg_replace('/-+/', '-', $string);
  }

  /**
   * @from I am a__string-With sp@ce¥s 14 and 😀 unicode élève
   * @to iamastringwithspces14andunicodeeleve
   */
  public static function id(string $string): string {
    $string = static::strict($string);

    return static::flat($string);
  }

  /**
   * @from I am a__string-With sp@ce¥s 14 and 😀 unicode élève
   * @to iamastringwithsp@ce¥s14and😀unicodeélève
   */
  public static function idRaw(string $string): string {
    return static::flat($string);
  }

  // ===========================================================================
  // CONVERTERS BETWEEN GENERIC FORMATS
  // ===========================================================================

  /**
   * @from i_am_a__string_with_sp@ce¥s_14_and_😀_unicode_élève
   * @to iAmAStringWithSp@ce¥s14And😀UnicodeÉlève
   */
  public static function snake2camel(string $string): string {
    return $string;
  }

  /**
   * @from i_am_a__string_with_sp@ce¥s_14_and_😀_unicode_élève
   * @to IAmAStringWithSp@ce¥s14And😀UnicodeÉlève
   */
  public static function snake2pascal(string $string): string {
    return static::pascal($string);
  }

  /**
   * @from i_am_a__string_with_sp@ce¥s_14_and_😀_unicode_élève
   * @to i-am-a--string-with-sp@ce¥s-14-and-😀-unicode-élève
   */
  public static function snake2kebab(string $string): string {
    return $string;
  }

  /**
   * @from i_am_a__string_with_sp@ce¥s_14_and_😀_unicode_élève
   * @to I-Am-A--String-With-Sp@ce¥s-14-And-😀-Unicode-Élève
   */
  public static function snake2train(string $string): string {
    return $string;
  }

  /**
   * @from i_am_a__string_with_sp@ce¥s_14_and_😀_unicode_élève
   * @to iamastringwithsp@ce¥s14and😀unicodeélève
   */
  public static function snake2flat(string $string): string {
    return $string;
  }

  /**
   * @from i_am_a__string_with_sp@ce¥s_14_and_😀_unicode_élève
   * @to I-AM-A--STRING-WITH-SP@CE¥S-14-AND-😀-UNICODE-ÉLÈVE
   */
  public static function snake2cobol(string $string): string {
    return $string;
  }

  /**
   * @from iAmAStringWithSp@ce¥s14And😀UnicodeÉlève
   * @to i_am_a__string_with_sp@ce¥s_14_and_😀_unicode_élève
   */
  public static function camel2snake(string $string): string {
    return $string;
  }

  /**
   * @from iAmAStringWithSp@ce¥s14And😀UnicodeÉlève
   * @to IAmAStringWithSp@ce¥s14And😀UnicodeÉlève
   */
  public static function camel2pascal(string $string): string {
    return $string;
  }

  /**
   * @from iAmAStringWithSp@ce¥s14And😀UnicodeÉlève
   * @to i-am-a--string-with-sp@ce¥s-14-and-😀-unicode-élève
   */
  public static function camel2kebab(string $string): string {
    return $string;
  }

  /**
   * @from iAmAStringWithSp@ce¥s14And😀UnicodeÉlève
   * @to I-Am-A--String-With-Sp@ce¥s-14-And-😀-Unicode-Élève
   */
  public static function camel2train(string $string): string {
    return $string;
  }

  /**
   * @from iAmAStringWithSp@ce¥s14And😀UnicodeÉlève
   * @to iamastringwithsp@ce¥s14and😀unicodeélève
   */
  public static function camel2flat(string $string): string {
    return $string;
  }

  /**
   * @from iAmAStringWithSp@ce¥s14And😀UnicodeÉlève
   * @to I-AM-A--STRING-WITH-SP@CE¥S-14-AND-😀-UNICODE-ÉLÈVE
   */
  public static function camel2cobol(string $string): string {
    return $string;
  }

  /**
   * @from IAmAStringWithSp@ce¥s14And😀UnicodeÉlève
   * @to i_am_a__string_with_sp@ce¥s_14_and_😀_unicode_élève
   */
  public static function pascal2snake(string $string): string {
    return $string;
  }

  /**
   * @from IAmAStringWithSp@ce¥s14And😀UnicodeÉlève
   * @to iAmAStringWithSp@ce¥s14And😀UnicodeÉlève
   */
  public static function pascal2camel(string $string): string {
    return $string;
  }

  /**
   * @from IAmAStringWithSp@ce¥s14And😀UnicodeÉlève
   * @to i-am-a--string-with-sp@ce¥s-14-and-😀-unicode-élève
   */
  public static function pascal2kebab(string $string): string {
    return $string;
  }

  /**
   * @from IAmAStringWithSp@ce¥s14And😀UnicodeÉlève
   * @to I-Am-A--String-With-Sp@ce¥s-14-And-😀-Unicode-Élève
   */
  public static function pascal2train(string $string): string {
    return $string;
  }

  /**
   * @from IAmAStringWithSp@ce¥s14And😀UnicodeÉlève
   * @to iamastringwithsp@ce¥s14and😀unicodeélève
   */
  public static function pascal2flat(string $string): string {
    return $string;
  }

  /**
   * @from IAmAStringWithSp@ce¥s14And😀UnicodeÉlève
   * @to I-AM-A--STRING-WITH-SP@CE¥S-14-AND-😀-UNICODE-ÉLÈVE
   */
  public static function pascal2cobol(string $string): string {
    return $string;
  }

  /**
   * @from i-am-a--string-with-sp@ce¥s-14-and-😀-unicode-élève
   * @to i_am_a__string_with_sp@ce¥s_14_and_😀_unicode_élève
   */
  public static function kebab2snake(string $string): string {
    return $string;
  }

  /**
   * @from i-am-a--string-with-sp@ce¥s-14-and-😀-unicode-élève
   * @to iAmAStringWithSp@ce¥s14And😀UnicodeÉlève
   */
  public static function kebab2camel(string $string): string {
    return $string;
  }

  /**
   * @from i-am-a--string-with-sp@ce¥s-14-and-😀-unicode-élève
   * @to IAmAStringWithSp@ce¥s14And😀UnicodeÉlève
   */
  public static function kebab2pascal(string $string): string {
    return $string;
  }

  /**
   * @from i-am-a--string-with-sp@ce¥s-14-and-😀-unicode-élève
   * @to I-Am-A--String-With-Sp@ce¥s-14-And-😀-Unicode-Élève
   */
  public static function kebab2train(string $string): string {
    return $string;
  }

  /**
   * @from i-am-a--string-with-sp@ce¥s-14-and-😀-unicode-élève
   * @to iamastringwithsp@ce¥s14and😀unicodeélève
   */
  public static function kebab2flat(string $string): string {
    return $string;
  }

  /**
   * @from i-am-a--string-with-sp@ce¥s-14-and-😀-unicode-élève
   * @to I-AM-A--STRING-WITH-SP@CE¥S-14-AND-😀-UNICODE-ÉLÈVE
   */
  public static function kebab2cobol(string $string): string {
    return $string;
  }

  /**
   * @from I-Am-A--String-With-Sp@ce¥s-14-And-😀-Unicode-Élève
   * @to i_am_a__string_with_sp@ce¥s_14_and_😀_unicode_élève
   */
  public static function train2snake(string $string): string {
    return $string;
  }

  /**
   * @from I-Am-A--String-With-Sp@ce¥s-14-And-😀-Unicode-Élève
   * @to iAmAStringWithSp@ce¥s14And😀UnicodeÉlève
   */
  public static function train2camel(string $string): string {
    return $string;
  }

  /**
   * @from I-Am-A--String-With-Sp@ce¥s-14-And-😀-Unicode-Élève
   * @to IAmAStringWithSp@ce¥s14And😀UnicodeÉlève
   */
  public static function train2pascal(string $string): string {
    return $string;
  }

  /**
   * @from I-Am-A--String-With-Sp@ce¥s-14-And-😀-Unicode-Élève
   * @to i-am-a--string-with-sp@ce¥s-14-and-😀-unicode-élève
   */
  public static function train2kebab(string $string): string {
    return $string;
  }

  /**
   * @from I-Am-A--String-With-Sp@ce¥s-14-And-😀-Unicode-Élève
   * @to iamastringwithsp@ce¥s14and😀unicodeélève
   */
  public static function train2flat(string $string): string {
    return $string;

  }

  /**
   * @from I-Am-A--String-With-Sp@ce¥s-14-And-😀-Unicode-Élève
   * @to I-AM-A--STRING-WITH-SP@CE¥S-14-AND-😀-UNICODE-ÉLÈVE
   */
  public static function train2cobol(string $string): string {
    return $string;
  }

  /**
   * @from iamastringwithsp@ce¥s14and😀unicodeélève
   * @to i_am_a__string_with_sp@ce¥s_14_and_😀_unicode_élève
   */
  public static function flat2snake(string $string): string {
    return $string;
  }

  /**
   * @from iamastringwithsp@ce¥s14and😀unicodeélève
   * @to iAmAStringWithSp@ce¥s14And😀UnicodeÉlève
   */
  public static function flat2camel(string $string): string {
    return $string;
  }

  /**
   * @from iamastringwithsp@ce¥s14and😀unicodeélève
   * @to IAmAStringWithSp@ce¥s14And😀UnicodeÉlève
   */
  public static function flat2pascal(string $string): string {
    return $string;
  }

  /**
   * @from iamastringwithsp@ce¥s14and😀unicodeélève
   * @to i-am-a--string-with-sp@ce¥s-14-and-😀-unicode-élève
   */
  public static function flat2kebab(string $string): string {
    return $string;
  }

  /**
   * @from iamastringwithsp@ce¥s14and😀unicodeélève
   * @to I-Am-A--String-With-Sp@ce¥s-14-And-😀-Unicode-Élève
   */
  public static function flat2train(string $string): string {
    return $string;
  }

  /**
   * @from iamastringwithsp@ce¥s14and😀unicodeélève
   * @to I-AM-A--STRING-WITH-SP@CE¥S-14-AND-😀-UNICODE-ÉLÈVE
   */
  public static function flat2cobol(string $string): string {
    return $string;
  }

  /**
   * @from I-AM-A--STRING-WITH-SP@CE¥S-14-AND-😀-UNICODE-ÉLÈVE
   * @to i_am_a__string_with_sp@ce¥s_14_and_😀_unicode_élève
   */
  public static function cobol2snake(string $string): string {
    return $string;
  }

  /**
   * @from I-AM-A--STRING-WITH-SP@CE¥S-14-AND-😀-UNICODE-ÉLÈVE
   * @to iAmAStringWithSp@ce¥s14And😀UnicodeÉlève
   */
  public static function cobol2camel(string $string): string {
    return $string;
  }

  /**
   * @from I-AM-A--STRING-WITH-SP@CE¥S-14-AND-😀-UNICODE-ÉLÈVE
   * @to IAmAStringWithSp@ce¥s14And😀UnicodeÉlève
   */
  public static function cobol2pascal(string $string): string {
    return $string;
  }

  /**
   * @from I-AM-A--STRING-WITH-SP@CE¥S-14-AND-😀-UNICODE-ÉLÈVE
   * @to i-am-a--string-with-sp@ce¥s-14-and-😀-unicode-élève
   */
  public static function cobol2kebab(string $string): string {
    return $string;
  }

  /**
   * @from I-AM-A--STRING-WITH-SP@CE¥S-14-AND-😀-UNICODE-ÉLÈVE
   * @to I-Am-A--String-With-Sp@ce¥s-14-And-😀-Unicode-Élève
   */
  public static function cobol2train(string $string): string {
    return $string;
  }

  /**
   * @from I-AM-A--STRING-WITH-SP@CE¥S-14-AND-😀-UNICODE-ÉLÈVE
   * @to iamastringwithsp@ce¥s14and😀unicodeélève
   */
  public static function cobol2flat(string $string): string {
    return $string;
  }

  // ===========================================================================
  // NAMED FORMATTERS
  // ===========================================================================

  /**
   * @from I am a__string-With sp@ce¥s 14 and 😀 unicode élève
   * @to IAMASTRINGWITHSPCES14ANDUNICODEELEVE
   */
  public static function idUpper(string $string): string {
    $string = static::strict($string);

    return mb_strtoupper(static::flat($string));
  }

  /**
   * @from I am a__string-With sp@ce¥s 14 and 😀 unicode élève
   * @to IAMASTRINGWITHSP@CE¥S14AND😀UNICODEÉLÈVE
   */
  public static function idUpperRaw(string $string): string {
    return mb_strtoupper(static::flat($string));
  }

  // ===========================================================================
  // INTERNAL HELPERS
  // ===========================================================================

  /**
   * Multibyte ucfirst.
   */
  protected static function mbUcfirst(string $string, ?string $encoding = NULL): string {
    $firstChar = mb_substr($string, 0, 1, $encoding);
    $firstChar = mb_convert_case($firstChar, MB_CASE_TITLE, $encoding);

    return $firstChar . mb_substr($string, 1, NULL, $encoding);
  }

  /**
   * Multibyte lcfirst.
   */
  protected static function mbLcfirst(string $string, ?string $encoding = NULL): string {
    $firstChar = mb_substr($string, 0, 1, $encoding);
    $firstChar = mb_convert_case($firstChar, MB_CASE_LOWER, $encoding);

    return $firstChar . mb_substr($string, 1, NULL, $encoding);
  }

  /**
   * Multibyte ucwords.
   */
  protected static function mbUcwords(string $string, string $separators = " \t\r\n\f\v", ?string $encoding = NULL): string {
    $result = '';
    $upper = '';
    for ($i = 0; $i < mb_strlen($string); $i++) {
      $letter = mb_substr($string, $i, 1);
      $result .= $upper || $i == 0 ? mb_convert_case($letter, MB_CASE_TITLE, $encoding) : $letter;
      $upper = ($i + 1) < mb_strlen($string) && mb_strpos($separators, $letter) !== FALSE ? 1 : 0;
    }

    return $result;
  }

  /**
   * Remove multibyte characters.
   */
  protected static function mbRemove(string $string): string {
    return str_replace(array_keys(static::MB_MAP), array_values(static::MB_MAP), $string);
  }

  /**
   * Remove emojis.
   */
  protected static function emojiRemove(string $string): string {
    return (string) preg_replace('/\x{1F3F4}\x{E0067}\x{E0062}(?:\x{E0077}\x{E006C}\x{E0073}|\x{E0073}\x{E0063}\x{E0074}|\x{E0065}\x{E006E}\x{E0067})\x{E007F}|(?:\x{1F9D1}\x{1F3FF}\x{200D}\x{2764}(?:\x{FE0F}\x{200D}(?:\x{1F48B}\x{200D})?|\x{200D}(?:\x{1F48B}\x{200D})?)\x{1F9D1}|\x{1F469}\x{1F3FF}\x{200D}\x{1F91D}\x{200D}[\x{1F468}\x{1F469}]|\x{1FAF1}\x{1F3FF}\x{200D}\x{1FAF2})[\x{1F3FB}-\x{1F3FE}]|(?:\x{1F9D1}\x{1F3FE}\x{200D}\x{2764}(?:\x{FE0F}\x{200D}(?:\x{1F48B}\x{200D})?|\x{200D}(?:\x{1F48B}\x{200D})?)\x{1F9D1}|\x{1F469}\x{1F3FE}\x{200D}\x{1F91D}\x{200D}[\x{1F468}\x{1F469}]|\x{1FAF1}\x{1F3FE}\x{200D}\x{1FAF2})[\x{1F3FB}-\x{1F3FD}\x{1F3FF}]|(?:\x{1F9D1}\x{1F3FD}\x{200D}\x{2764}(?:\x{FE0F}\x{200D}(?:\x{1F48B}\x{200D})?|\x{200D}(?:\x{1F48B}\x{200D})?)\x{1F9D1}|\x{1F469}\x{1F3FD}\x{200D}\x{1F91D}\x{200D}[\x{1F468}\x{1F469}]|\x{1FAF1}\x{1F3FD}\x{200D}\x{1FAF2})[\x{1F3FB}\x{1F3FC}\x{1F3FE}\x{1F3FF}]|(?:\x{1F9D1}\x{1F3FC}\x{200D}\x{2764}(?:\x{FE0F}\x{200D}(?:\x{1F48B}\x{200D})?|\x{200D}(?:\x{1F48B}\x{200D})?)\x{1F9D1}|\x{1F469}\x{1F3FC}\x{200D}\x{1F91D}\x{200D}[\x{1F468}\x{1F469}]|\x{1FAF1}\x{1F3FC}\x{200D}\x{1FAF2})[\x{1F3FB}\x{1F3FD}-\x{1F3FF}]|(?:\x{1F9D1}\x{1F3FB}\x{200D}\x{2764}(?:\x{FE0F}\x{200D}(?:\x{1F48B}\x{200D})?|\x{200D}(?:\x{1F48B}\x{200D})?)\x{1F9D1}|\x{1F469}\x{1F3FB}\x{200D}\x{1F91D}\x{200D}[\x{1F468}\x{1F469}]|\x{1FAF1}\x{1F3FB}\x{200D}\x{1FAF2})[\x{1F3FC}-\x{1F3FF}]|\x{1F468}(?:\x{1F3FB}(?:\x{200D}(?:\x{2764}(?:\x{FE0F}\x{200D}(?:\x{1F48B}\x{200D}\x{1F468}[\x{1F3FB}-\x{1F3FF}]|\x{1F468}[\x{1F3FB}-\x{1F3FF}])|\x{200D}(?:\x{1F48B}\x{200D}\x{1F468}[\x{1F3FB}-\x{1F3FF}]|\x{1F468}[\x{1F3FB}-\x{1F3FF}]))|\x{1F91D}\x{200D}\x{1F468}[\x{1F3FC}-\x{1F3FF}]|[\x{2695}\x{2696}\x{2708}]\x{FE0F}|[\x{2695}\x{2696}\x{2708}]|[\x{1F33E}\x{1F373}\x{1F37C}\x{1F393}\x{1F3A4}\x{1F3A8}\x{1F3EB}\x{1F3ED}\x{1F4BB}\x{1F4BC}\x{1F527}\x{1F52C}\x{1F680}\x{1F692}\x{1F9AF}-\x{1F9B3}\x{1F9BC}\x{1F9BD}]))?|[\x{1F3FC}-\x{1F3FF}]\x{200D}\x{2764}(?:\x{FE0F}\x{200D}(?:\x{1F48B}\x{200D}\x{1F468}[\x{1F3FB}-\x{1F3FF}]|\x{1F468}[\x{1F3FB}-\x{1F3FF}])|\x{200D}(?:\x{1F48B}\x{200D}\x{1F468}[\x{1F3FB}-\x{1F3FF}]|\x{1F468}[\x{1F3FB}-\x{1F3FF}]))|\x{200D}(?:\x{2764}(?:\x{FE0F}\x{200D}(?:\x{1F48B}\x{200D})?|\x{200D}(?:\x{1F48B}\x{200D})?)\x{1F468}|[\x{1F468}\x{1F469}]\x{200D}(?:\x{1F466}\x{200D}\x{1F466}|\x{1F467}\x{200D}[\x{1F466}\x{1F467}])|\x{1F466}\x{200D}\x{1F466}|\x{1F467}\x{200D}[\x{1F466}\x{1F467}]|[\x{1F33E}\x{1F373}\x{1F37C}\x{1F393}\x{1F3A4}\x{1F3A8}\x{1F3EB}\x{1F3ED}\x{1F4BB}\x{1F4BC}\x{1F527}\x{1F52C}\x{1F680}\x{1F692}\x{1F9AF}-\x{1F9B3}\x{1F9BC}\x{1F9BD}])|\x{1F3FF}\x{200D}(?:\x{1F91D}\x{200D}\x{1F468}[\x{1F3FB}-\x{1F3FE}]|[\x{1F33E}\x{1F373}\x{1F37C}\x{1F393}\x{1F3A4}\x{1F3A8}\x{1F3EB}\x{1F3ED}\x{1F4BB}\x{1F4BC}\x{1F527}\x{1F52C}\x{1F680}\x{1F692}\x{1F9AF}-\x{1F9B3}\x{1F9BC}\x{1F9BD}])|\x{1F3FE}\x{200D}(?:\x{1F91D}\x{200D}\x{1F468}[\x{1F3FB}-\x{1F3FD}\x{1F3FF}]|[\x{1F33E}\x{1F373}\x{1F37C}\x{1F393}\x{1F3A4}\x{1F3A8}\x{1F3EB}\x{1F3ED}\x{1F4BB}\x{1F4BC}\x{1F527}\x{1F52C}\x{1F680}\x{1F692}\x{1F9AF}-\x{1F9B3}\x{1F9BC}\x{1F9BD}])|\x{1F3FD}\x{200D}(?:\x{1F91D}\x{200D}\x{1F468}[\x{1F3FB}\x{1F3FC}\x{1F3FE}\x{1F3FF}]|[\x{1F33E}\x{1F373}\x{1F37C}\x{1F393}\x{1F3A4}\x{1F3A8}\x{1F3EB}\x{1F3ED}\x{1F4BB}\x{1F4BC}\x{1F527}\x{1F52C}\x{1F680}\x{1F692}\x{1F9AF}-\x{1F9B3}\x{1F9BC}\x{1F9BD}])|\x{1F3FC}\x{200D}(?:\x{1F91D}\x{200D}\x{1F468}[\x{1F3FB}\x{1F3FD}-\x{1F3FF}]|[\x{1F33E}\x{1F373}\x{1F37C}\x{1F393}\x{1F3A4}\x{1F3A8}\x{1F3EB}\x{1F3ED}\x{1F4BB}\x{1F4BC}\x{1F527}\x{1F52C}\x{1F680}\x{1F692}\x{1F9AF}-\x{1F9B3}\x{1F9BC}\x{1F9BD}])|(?:\x{1F3FF}\x{200D}[\x{2695}\x{2696}\x{2708}]|\x{1F3FE}\x{200D}[\x{2695}\x{2696}\x{2708}]|\x{1F3FD}\x{200D}[\x{2695}\x{2696}\x{2708}]|\x{1F3FC}\x{200D}[\x{2695}\x{2696}\x{2708}]|\x{200D}[\x{2695}\x{2696}\x{2708}])\x{FE0F}|\x{200D}(?:[\x{1F468}\x{1F469}]\x{200D}[\x{1F466}\x{1F467}]|[\x{1F466}\x{1F467}])|\x{1F3FF}\x{200D}[\x{2695}\x{2696}\x{2708}]|\x{1F3FE}\x{200D}[\x{2695}\x{2696}\x{2708}]|\x{1F3FD}\x{200D}[\x{2695}\x{2696}\x{2708}]|\x{1F3FC}\x{200D}[\x{2695}\x{2696}\x{2708}]|\x{1F3FF}|\x{1F3FE}|\x{1F3FD}|\x{1F3FC}|\x{200D}[\x{2695}\x{2696}\x{2708}])?|(?:\x{1F469}(?:\x{1F3FB}\x{200D}\x{2764}(?:\x{FE0F}\x{200D}(?:\x{1F48B}\x{200D}[\x{1F468}\x{1F469}]|[\x{1F468}\x{1F469}])|\x{200D}(?:\x{1F48B}\x{200D}[\x{1F468}\x{1F469}]|[\x{1F468}\x{1F469}]))|[\x{1F3FC}-\x{1F3FF}]\x{200D}\x{2764}(?:\x{FE0F}\x{200D}(?:\x{1F48B}\x{200D}[\x{1F468}\x{1F469}]|[\x{1F468}\x{1F469}])|\x{200D}(?:\x{1F48B}\x{200D}[\x{1F468}\x{1F469}]|[\x{1F468}\x{1F469}])))|\x{1F9D1}[\x{1F3FB}-\x{1F3FF}]\x{200D}\x{1F91D}\x{200D}\x{1F9D1})[\x{1F3FB}-\x{1F3FF}]|\x{1F469}\x{200D}\x{1F469}\x{200D}(?:\x{1F466}\x{200D}\x{1F466}|\x{1F467}\x{200D}[\x{1F466}\x{1F467}])|\x{1F469}(?:\x{200D}(?:\x{2764}(?:\x{FE0F}\x{200D}(?:\x{1F48B}\x{200D}[\x{1F468}\x{1F469}]|[\x{1F468}\x{1F469}])|\x{200D}(?:\x{1F48B}\x{200D}[\x{1F468}\x{1F469}]|[\x{1F468}\x{1F469}]))|[\x{1F33E}\x{1F373}\x{1F37C}\x{1F393}\x{1F3A4}\x{1F3A8}\x{1F3EB}\x{1F3ED}\x{1F4BB}\x{1F4BC}\x{1F527}\x{1F52C}\x{1F680}\x{1F692}\x{1F9AF}-\x{1F9B3}\x{1F9BC}\x{1F9BD}])|\x{1F3FF}\x{200D}[\x{1F33E}\x{1F373}\x{1F37C}\x{1F393}\x{1F3A4}\x{1F3A8}\x{1F3EB}\x{1F3ED}\x{1F4BB}\x{1F4BC}\x{1F527}\x{1F52C}\x{1F680}\x{1F692}\x{1F9AF}-\x{1F9B3}\x{1F9BC}\x{1F9BD}]|\x{1F3FE}\x{200D}[\x{1F33E}\x{1F373}\x{1F37C}\x{1F393}\x{1F3A4}\x{1F3A8}\x{1F3EB}\x{1F3ED}\x{1F4BB}\x{1F4BC}\x{1F527}\x{1F52C}\x{1F680}\x{1F692}\x{1F9AF}-\x{1F9B3}\x{1F9BC}\x{1F9BD}]|\x{1F3FD}\x{200D}[\x{1F33E}\x{1F373}\x{1F37C}\x{1F393}\x{1F3A4}\x{1F3A8}\x{1F3EB}\x{1F3ED}\x{1F4BB}\x{1F4BC}\x{1F527}\x{1F52C}\x{1F680}\x{1F692}\x{1F9AF}-\x{1F9B3}\x{1F9BC}\x{1F9BD}]|\x{1F3FC}\x{200D}[\x{1F33E}\x{1F373}\x{1F37C}\x{1F393}\x{1F3A4}\x{1F3A8}\x{1F3EB}\x{1F3ED}\x{1F4BB}\x{1F4BC}\x{1F527}\x{1F52C}\x{1F680}\x{1F692}\x{1F9AF}-\x{1F9B3}\x{1F9BC}\x{1F9BD}]|\x{1F3FB}\x{200D}[\x{1F33E}\x{1F373}\x{1F37C}\x{1F393}\x{1F3A4}\x{1F3A8}\x{1F3EB}\x{1F3ED}\x{1F4BB}\x{1F4BC}\x{1F527}\x{1F52C}\x{1F680}\x{1F692}\x{1F9AF}-\x{1F9B3}\x{1F9BC}\x{1F9BD}])|\x{1F9D1}(?:\x{200D}(?:\x{1F91D}\x{200D}\x{1F9D1}|[\x{1F33E}\x{1F373}\x{1F37C}\x{1F384}\x{1F393}\x{1F3A4}\x{1F3A8}\x{1F3EB}\x{1F3ED}\x{1F4BB}\x{1F4BC}\x{1F527}\x{1F52C}\x{1F680}\x{1F692}\x{1F9AF}-\x{1F9B3}\x{1F9BC}\x{1F9BD}])|\x{1F3FF}\x{200D}[\x{1F33E}\x{1F373}\x{1F37C}\x{1F384}\x{1F393}\x{1F3A4}\x{1F3A8}\x{1F3EB}\x{1F3ED}\x{1F4BB}\x{1F4BC}\x{1F527}\x{1F52C}\x{1F680}\x{1F692}\x{1F9AF}-\x{1F9B3}\x{1F9BC}\x{1F9BD}]|\x{1F3FE}\x{200D}[\x{1F33E}\x{1F373}\x{1F37C}\x{1F384}\x{1F393}\x{1F3A4}\x{1F3A8}\x{1F3EB}\x{1F3ED}\x{1F4BB}\x{1F4BC}\x{1F527}\x{1F52C}\x{1F680}\x{1F692}\x{1F9AF}-\x{1F9B3}\x{1F9BC}\x{1F9BD}]|\x{1F3FD}\x{200D}[\x{1F33E}\x{1F373}\x{1F37C}\x{1F384}\x{1F393}\x{1F3A4}\x{1F3A8}\x{1F3EB}\x{1F3ED}\x{1F4BB}\x{1F4BC}\x{1F527}\x{1F52C}\x{1F680}\x{1F692}\x{1F9AF}-\x{1F9B3}\x{1F9BC}\x{1F9BD}]|\x{1F3FC}\x{200D}[\x{1F33E}\x{1F373}\x{1F37C}\x{1F384}\x{1F393}\x{1F3A4}\x{1F3A8}\x{1F3EB}\x{1F3ED}\x{1F4BB}\x{1F4BC}\x{1F527}\x{1F52C}\x{1F680}\x{1F692}\x{1F9AF}-\x{1F9B3}\x{1F9BC}\x{1F9BD}]|\x{1F3FB}\x{200D}[\x{1F33E}\x{1F373}\x{1F37C}\x{1F384}\x{1F393}\x{1F3A4}\x{1F3A8}\x{1F3EB}\x{1F3ED}\x{1F4BB}\x{1F4BC}\x{1F527}\x{1F52C}\x{1F680}\x{1F692}\x{1F9AF}-\x{1F9B3}\x{1F9BC}\x{1F9BD}])|\x{1F469}\x{200D}\x{1F466}\x{200D}\x{1F466}|\x{1F469}\x{200D}\x{1F469}\x{200D}[\x{1F466}\x{1F467}]|\x{1F469}\x{200D}\x{1F467}\x{200D}[\x{1F466}\x{1F467}]|(?:\x{1F441}\x{FE0F}?\x{200D}\x{1F5E8}|\x{1F9D1}(?:\x{1F3FF}\x{200D}[\x{2695}\x{2696}\x{2708}]|\x{1F3FE}\x{200D}[\x{2695}\x{2696}\x{2708}]|\x{1F3FD}\x{200D}[\x{2695}\x{2696}\x{2708}]|\x{1F3FC}\x{200D}[\x{2695}\x{2696}\x{2708}]|\x{1F3FB}\x{200D}[\x{2695}\x{2696}\x{2708}]|\x{200D}[\x{2695}\x{2696}\x{2708}])|\x{1F469}(?:\x{1F3FF}\x{200D}[\x{2695}\x{2696}\x{2708}]|\x{1F3FE}\x{200D}[\x{2695}\x{2696}\x{2708}]|\x{1F3FD}\x{200D}[\x{2695}\x{2696}\x{2708}]|\x{1F3FC}\x{200D}[\x{2695}\x{2696}\x{2708}]|\x{1F3FB}\x{200D}[\x{2695}\x{2696}\x{2708}]|\x{200D}[\x{2695}\x{2696}\x{2708}])|\x{1F636}\x{200D}\x{1F32B}|\x{1F3F3}\x{FE0F}?\x{200D}\x{26A7}|\x{1F43B}\x{200D}\x{2744}|(?:[\x{1F3C3}\x{1F3C4}\x{1F3CA}\x{1F46E}\x{1F470}\x{1F471}\x{1F473}\x{1F477}\x{1F481}\x{1F482}\x{1F486}\x{1F487}\x{1F645}-\x{1F647}\x{1F64B}\x{1F64D}\x{1F64E}\x{1F6A3}\x{1F6B4}-\x{1F6B6}\x{1F926}\x{1F935}\x{1F937}-\x{1F939}\x{1F93D}\x{1F93E}\x{1F9B8}\x{1F9B9}\x{1F9CD}-\x{1F9CF}\x{1F9D4}\x{1F9D6}-\x{1F9DD}][\x{1F3FB}-\x{1F3FF}]|[\x{1F46F}\x{1F9DE}\x{1F9DF}])\x{200D}[\x{2640}\x{2642}]|[\x{26F9}\x{1F3CB}\x{1F3CC}\x{1F575}](?:[\x{FE0F}\x{1F3FB}-\x{1F3FF}]\x{200D}[\x{2640}\x{2642}]|\x{200D}[\x{2640}\x{2642}])|\x{1F3F4}\x{200D}\x{2620}|[\x{1F3C3}\x{1F3C4}\x{1F3CA}\x{1F46E}\x{1F470}\x{1F471}\x{1F473}\x{1F477}\x{1F481}\x{1F482}\x{1F486}\x{1F487}\x{1F645}-\x{1F647}\x{1F64B}\x{1F64D}\x{1F64E}\x{1F6A3}\x{1F6B4}-\x{1F6B6}\x{1F926}\x{1F935}\x{1F937}-\x{1F939}\x{1F93C}-\x{1F93E}\x{1F9B8}\x{1F9B9}\x{1F9CD}-\x{1F9CF}\x{1F9D4}\x{1F9D6}-\x{1F9DD}]\x{200D}[\x{2640}\x{2642}]|[\xA9\xAE\x{203C}\x{2049}\x{2122}\x{2139}\x{2194}-\x{2199}\x{21A9}\x{21AA}\x{231A}\x{231B}\x{2328}\x{23CF}\x{23ED}-\x{23EF}\x{23F1}\x{23F2}\x{23F8}-\x{23FA}\x{24C2}\x{25AA}\x{25AB}\x{25B6}\x{25C0}\x{25FB}\x{25FC}\x{25FE}\x{2600}-\x{2604}\x{260E}\x{2611}\x{2614}\x{2615}\x{2618}\x{2620}\x{2622}\x{2623}\x{2626}\x{262A}\x{262E}\x{262F}\x{2638}-\x{263A}\x{2640}\x{2642}\x{2648}-\x{2653}\x{265F}\x{2660}\x{2663}\x{2665}\x{2666}\x{2668}\x{267B}\x{267E}\x{267F}\x{2692}\x{2694}-\x{2697}\x{2699}\x{269B}\x{269C}\x{26A0}\x{26A7}\x{26AA}\x{26B0}\x{26B1}\x{26BD}\x{26BE}\x{26C4}\x{26C8}\x{26CF}\x{26D1}\x{26D3}\x{26E9}\x{26F0}-\x{26F5}\x{26F7}\x{26F8}\x{26FA}\x{2702}\x{2708}\x{2709}\x{270F}\x{2712}\x{2714}\x{2716}\x{271D}\x{2721}\x{2733}\x{2734}\x{2744}\x{2747}\x{2763}\x{27A1}\x{2934}\x{2935}\x{2B05}-\x{2B07}\x{2B1B}\x{2B1C}\x{2B55}\x{3030}\x{303D}\x{3297}\x{3299}\x{1F004}\x{1F170}\x{1F171}\x{1F17E}\x{1F17F}\x{1F202}\x{1F237}\x{1F321}\x{1F324}-\x{1F32C}\x{1F336}\x{1F37D}\x{1F396}\x{1F397}\x{1F399}-\x{1F39B}\x{1F39E}\x{1F39F}\x{1F3CD}\x{1F3CE}\x{1F3D4}-\x{1F3DF}\x{1F3F5}\x{1F3F7}\x{1F43F}\x{1F4FD}\x{1F549}\x{1F54A}\x{1F56F}\x{1F570}\x{1F573}\x{1F576}-\x{1F579}\x{1F587}\x{1F58A}-\x{1F58D}\x{1F5A5}\x{1F5A8}\x{1F5B1}\x{1F5B2}\x{1F5BC}\x{1F5C2}-\x{1F5C4}\x{1F5D1}-\x{1F5D3}\x{1F5DC}-\x{1F5DE}\x{1F5E1}\x{1F5E3}\x{1F5E8}\x{1F5EF}\x{1F5F3}\x{1F5FA}\x{1F6CB}\x{1F6CD}-\x{1F6CF}\x{1F6E0}-\x{1F6E5}\x{1F6E9}\x{1F6F0}\x{1F6F3}])\x{FE0F}|\x{1F441}\x{FE0F}?\x{200D}\x{1F5E8}|\x{1F9D1}(?:\x{1F3FF}\x{200D}[\x{2695}\x{2696}\x{2708}]|\x{1F3FE}\x{200D}[\x{2695}\x{2696}\x{2708}]|\x{1F3FD}\x{200D}[\x{2695}\x{2696}\x{2708}]|\x{1F3FC}\x{200D}[\x{2695}\x{2696}\x{2708}]|\x{1F3FB}\x{200D}[\x{2695}\x{2696}\x{2708}]|\x{200D}[\x{2695}\x{2696}\x{2708}])|\x{1F469}(?:\x{1F3FF}\x{200D}[\x{2695}\x{2696}\x{2708}]|\x{1F3FE}\x{200D}[\x{2695}\x{2696}\x{2708}]|\x{1F3FD}\x{200D}[\x{2695}\x{2696}\x{2708}]|\x{1F3FC}\x{200D}[\x{2695}\x{2696}\x{2708}]|\x{1F3FB}\x{200D}[\x{2695}\x{2696}\x{2708}]|\x{200D}[\x{2695}\x{2696}\x{2708}])|\x{1F3F3}\x{FE0F}?\x{200D}\x{1F308}|\x{1F469}\x{200D}\x{1F467}|\x{1F469}\x{200D}\x{1F466}|\x{1F636}\x{200D}\x{1F32B}|\x{1F3F3}\x{FE0F}?\x{200D}\x{26A7}|\x{1F635}\x{200D}\x{1F4AB}|\x{1F62E}\x{200D}\x{1F4A8}|\x{1F415}\x{200D}\x{1F9BA}|\x{1FAF1}(?:\x{1F3FF}|\x{1F3FE}|\x{1F3FD}|\x{1F3FC}|\x{1F3FB})?|\x{1F9D1}(?:\x{1F3FF}|\x{1F3FE}|\x{1F3FD}|\x{1F3FC}|\x{1F3FB})?|\x{1F469}(?:\x{1F3FF}|\x{1F3FE}|\x{1F3FD}|\x{1F3FC}|\x{1F3FB})?|\x{1F43B}\x{200D}\x{2744}|(?:[\x{1F3C3}\x{1F3C4}\x{1F3CA}\x{1F46E}\x{1F470}\x{1F471}\x{1F473}\x{1F477}\x{1F481}\x{1F482}\x{1F486}\x{1F487}\x{1F645}-\x{1F647}\x{1F64B}\x{1F64D}\x{1F64E}\x{1F6A3}\x{1F6B4}-\x{1F6B6}\x{1F926}\x{1F935}\x{1F937}-\x{1F939}\x{1F93D}\x{1F93E}\x{1F9B8}\x{1F9B9}\x{1F9CD}-\x{1F9CF}\x{1F9D4}\x{1F9D6}-\x{1F9DD}][\x{1F3FB}-\x{1F3FF}]|[\x{1F46F}\x{1F9DE}\x{1F9DF}])\x{200D}[\x{2640}\x{2642}]|[\x{26F9}\x{1F3CB}\x{1F3CC}\x{1F575}](?:[\x{FE0F}\x{1F3FB}-\x{1F3FF}]\x{200D}[\x{2640}\x{2642}]|\x{200D}[\x{2640}\x{2642}])|\x{1F3F4}\x{200D}\x{2620}|\x{1F1FD}\x{1F1F0}|\x{1F1F6}\x{1F1E6}|\x{1F1F4}\x{1F1F2}|\x{1F408}\x{200D}\x{2B1B}|\x{2764}(?:\x{FE0F}\x{200D}[\x{1F525}\x{1FA79}]|\x{200D}[\x{1F525}\x{1FA79}])|\x{1F441}\x{FE0F}?|\x{1F3F3}\x{FE0F}?|[\x{1F3C3}\x{1F3C4}\x{1F3CA}\x{1F46E}\x{1F470}\x{1F471}\x{1F473}\x{1F477}\x{1F481}\x{1F482}\x{1F486}\x{1F487}\x{1F645}-\x{1F647}\x{1F64B}\x{1F64D}\x{1F64E}\x{1F6A3}\x{1F6B4}-\x{1F6B6}\x{1F926}\x{1F935}\x{1F937}-\x{1F939}\x{1F93C}-\x{1F93E}\x{1F9B8}\x{1F9B9}\x{1F9CD}-\x{1F9CF}\x{1F9D4}\x{1F9D6}-\x{1F9DD}]\x{200D}[\x{2640}\x{2642}]|\x{1F1FF}[\x{1F1E6}\x{1F1F2}\x{1F1FC}]|\x{1F1FE}[\x{1F1EA}\x{1F1F9}]|\x{1F1FC}[\x{1F1EB}\x{1F1F8}]|\x{1F1FB}[\x{1F1E6}\x{1F1E8}\x{1F1EA}\x{1F1EC}\x{1F1EE}\x{1F1F3}\x{1F1FA}]|\x{1F1FA}[\x{1F1E6}\x{1F1EC}\x{1F1F2}\x{1F1F3}\x{1F1F8}\x{1F1FE}\x{1F1FF}]|\x{1F1F9}[\x{1F1E6}\x{1F1E8}\x{1F1E9}\x{1F1EB}-\x{1F1ED}\x{1F1EF}-\x{1F1F4}\x{1F1F7}\x{1F1F9}\x{1F1FB}\x{1F1FC}\x{1F1FF}]|\x{1F1F8}[\x{1F1E6}-\x{1F1EA}\x{1F1EC}-\x{1F1F4}\x{1F1F7}-\x{1F1F9}\x{1F1FB}\x{1F1FD}-\x{1F1FF}]|\x{1F1F7}[\x{1F1EA}\x{1F1F4}\x{1F1F8}\x{1F1FA}\x{1F1FC}]|\x{1F1F5}[\x{1F1E6}\x{1F1EA}-\x{1F1ED}\x{1F1F0}-\x{1F1F3}\x{1F1F7}-\x{1F1F9}\x{1F1FC}\x{1F1FE}]|\x{1F1F3}[\x{1F1E6}\x{1F1E8}\x{1F1EA}-\x{1F1EC}\x{1F1EE}\x{1F1F1}\x{1F1F4}\x{1F1F5}\x{1F1F7}\x{1F1FA}\x{1F1FF}]|\x{1F1F2}[\x{1F1E6}\x{1F1E8}-\x{1F1ED}\x{1F1F0}-\x{1F1FF}]|\x{1F1F1}[\x{1F1E6}-\x{1F1E8}\x{1F1EE}\x{1F1F0}\x{1F1F7}-\x{1F1FB}\x{1F1FE}]|\x{1F1F0}[\x{1F1EA}\x{1F1EC}-\x{1F1EE}\x{1F1F2}\x{1F1F3}\x{1F1F5}\x{1F1F7}\x{1F1FC}\x{1F1FE}\x{1F1FF}]|\x{1F1EF}[\x{1F1EA}\x{1F1F2}\x{1F1F4}\x{1F1F5}]|\x{1F1EE}[\x{1F1E8}-\x{1F1EA}\x{1F1F1}-\x{1F1F4}\x{1F1F6}-\x{1F1F9}]|\x{1F1ED}[\x{1F1F0}\x{1F1F2}\x{1F1F3}\x{1F1F7}\x{1F1F9}\x{1F1FA}]|\x{1F1EC}[\x{1F1E6}\x{1F1E7}\x{1F1E9}-\x{1F1EE}\x{1F1F1}-\x{1F1F3}\x{1F1F5}-\x{1F1FA}\x{1F1FC}\x{1F1FE}]|\x{1F1EB}[\x{1F1EE}-\x{1F1F0}\x{1F1F2}\x{1F1F4}\x{1F1F7}]|\x{1F1EA}[\x{1F1E6}\x{1F1E8}\x{1F1EA}\x{1F1EC}\x{1F1ED}\x{1F1F7}-\x{1F1FA}]|\x{1F1E9}[\x{1F1EA}\x{1F1EC}\x{1F1EF}\x{1F1F0}\x{1F1F2}\x{1F1F4}\x{1F1FF}]|\x{1F1E8}[\x{1F1E6}\x{1F1E8}\x{1F1E9}\x{1F1EB}-\x{1F1EE}\x{1F1F0}-\x{1F1F5}\x{1F1F7}\x{1F1FA}-\x{1F1FF}]|\x{1F1E7}[\x{1F1E6}\x{1F1E7}\x{1F1E9}-\x{1F1EF}\x{1F1F1}-\x{1F1F4}\x{1F1F6}-\x{1F1F9}\x{1F1FB}\x{1F1FC}\x{1F1FE}\x{1F1FF}]|\x{1F1E6}[\x{1F1E8}-\x{1F1EC}\x{1F1EE}\x{1F1F1}\x{1F1F2}\x{1F1F4}\x{1F1F6}-\x{1F1FA}\x{1F1FC}\x{1F1FD}\x{1F1FF}]|[#\*0-9]\x{FE0F}?\x{20E3}|\x{1F93C}[\x{1F3FB}-\x{1F3FF}]|\x{2764}\x{FE0F}?|[\x{1F3C3}\x{1F3C4}\x{1F3CA}\x{1F46E}\x{1F470}\x{1F471}\x{1F473}\x{1F477}\x{1F481}\x{1F482}\x{1F486}\x{1F487}\x{1F645}-\x{1F647}\x{1F64B}\x{1F64D}\x{1F64E}\x{1F6A3}\x{1F6B4}-\x{1F6B6}\x{1F926}\x{1F935}\x{1F937}-\x{1F939}\x{1F93D}\x{1F93E}\x{1F9B8}\x{1F9B9}\x{1F9CD}-\x{1F9CF}\x{1F9D4}\x{1F9D6}-\x{1F9DD}][\x{1F3FB}-\x{1F3FF}]|[\x{26F9}\x{1F3CB}\x{1F3CC}\x{1F575}][\x{FE0F}\x{1F3FB}-\x{1F3FF}]?|\x{1F3F4}|[\x{270A}\x{270B}\x{1F385}\x{1F3C2}\x{1F3C7}\x{1F442}\x{1F443}\x{1F446}-\x{1F450}\x{1F466}\x{1F467}\x{1F46B}-\x{1F46D}\x{1F472}\x{1F474}-\x{1F476}\x{1F478}\x{1F47C}\x{1F483}\x{1F485}\x{1F48F}\x{1F491}\x{1F4AA}\x{1F57A}\x{1F595}\x{1F596}\x{1F64C}\x{1F64F}\x{1F6C0}\x{1F6CC}\x{1F90C}\x{1F90F}\x{1F918}-\x{1F91F}\x{1F930}-\x{1F934}\x{1F936}\x{1F977}\x{1F9B5}\x{1F9B6}\x{1F9BB}\x{1F9D2}\x{1F9D3}\x{1F9D5}\x{1FAC3}-\x{1FAC5}\x{1FAF0}\x{1FAF2}-\x{1FAF6}][\x{1F3FB}-\x{1F3FF}]|[\x{261D}\x{270C}\x{270D}\x{1F574}\x{1F590}][\x{FE0F}\x{1F3FB}-\x{1F3FF}]|[\x{261D}\x{270A}-\x{270D}\x{1F385}\x{1F3C2}\x{1F3C7}\x{1F408}\x{1F415}\x{1F43B}\x{1F442}\x{1F443}\x{1F446}-\x{1F450}\x{1F466}\x{1F467}\x{1F46B}-\x{1F46D}\x{1F472}\x{1F474}-\x{1F476}\x{1F478}\x{1F47C}\x{1F483}\x{1F485}\x{1F48F}\x{1F491}\x{1F4AA}\x{1F574}\x{1F57A}\x{1F590}\x{1F595}\x{1F596}\x{1F62E}\x{1F635}\x{1F636}\x{1F64C}\x{1F64F}\x{1F6C0}\x{1F6CC}\x{1F90C}\x{1F90F}\x{1F918}-\x{1F91F}\x{1F930}-\x{1F934}\x{1F936}\x{1F93C}\x{1F977}\x{1F9B5}\x{1F9B6}\x{1F9BB}\x{1F9D2}\x{1F9D3}\x{1F9D5}\x{1FAC3}-\x{1FAC5}\x{1FAF0}\x{1FAF2}-\x{1FAF6}]|[\x{1F3C3}\x{1F3C4}\x{1F3CA}\x{1F46E}\x{1F470}\x{1F471}\x{1F473}\x{1F477}\x{1F481}\x{1F482}\x{1F486}\x{1F487}\x{1F645}-\x{1F647}\x{1F64B}\x{1F64D}\x{1F64E}\x{1F6A3}\x{1F6B4}-\x{1F6B6}\x{1F926}\x{1F935}\x{1F937}-\x{1F939}\x{1F93D}\x{1F93E}\x{1F9B8}\x{1F9B9}\x{1F9CD}-\x{1F9CF}\x{1F9D4}\x{1F9D6}-\x{1F9DD}]|[\x{1F46F}\x{1F9DE}\x{1F9DF}]|[\xA9\xAE\x{203C}\x{2049}\x{2122}\x{2139}\x{2194}-\x{2199}\x{21A9}\x{21AA}\x{231A}\x{231B}\x{2328}\x{23CF}\x{23ED}-\x{23EF}\x{23F1}\x{23F2}\x{23F8}-\x{23FA}\x{24C2}\x{25AA}\x{25AB}\x{25B6}\x{25C0}\x{25FB}\x{25FC}\x{25FE}\x{2600}-\x{2604}\x{260E}\x{2611}\x{2614}\x{2615}\x{2618}\x{2620}\x{2622}\x{2623}\x{2626}\x{262A}\x{262E}\x{262F}\x{2638}-\x{263A}\x{2640}\x{2642}\x{2648}-\x{2653}\x{265F}\x{2660}\x{2663}\x{2665}\x{2666}\x{2668}\x{267B}\x{267E}\x{267F}\x{2692}\x{2694}-\x{2697}\x{2699}\x{269B}\x{269C}\x{26A0}\x{26A7}\x{26AA}\x{26B0}\x{26B1}\x{26BD}\x{26BE}\x{26C4}\x{26C8}\x{26CF}\x{26D1}\x{26D3}\x{26E9}\x{26F0}-\x{26F5}\x{26F7}\x{26F8}\x{26FA}\x{2702}\x{2708}\x{2709}\x{270F}\x{2712}\x{2714}\x{2716}\x{271D}\x{2721}\x{2733}\x{2734}\x{2744}\x{2747}\x{2763}\x{27A1}\x{2934}\x{2935}\x{2B05}-\x{2B07}\x{2B1B}\x{2B1C}\x{2B55}\x{3030}\x{303D}\x{3297}\x{3299}\x{1F004}\x{1F170}\x{1F171}\x{1F17E}\x{1F17F}\x{1F202}\x{1F237}\x{1F321}\x{1F324}-\x{1F32C}\x{1F336}\x{1F37D}\x{1F396}\x{1F397}\x{1F399}-\x{1F39B}\x{1F39E}\x{1F39F}\x{1F3CD}\x{1F3CE}\x{1F3D4}-\x{1F3DF}\x{1F3F5}\x{1F3F7}\x{1F43F}\x{1F4FD}\x{1F549}\x{1F54A}\x{1F56F}\x{1F570}\x{1F573}\x{1F576}-\x{1F579}\x{1F587}\x{1F58A}-\x{1F58D}\x{1F5A5}\x{1F5A8}\x{1F5B1}\x{1F5B2}\x{1F5BC}\x{1F5C2}-\x{1F5C4}\x{1F5D1}-\x{1F5D3}\x{1F5DC}-\x{1F5DE}\x{1F5E1}\x{1F5E3}\x{1F5E8}\x{1F5EF}\x{1F5F3}\x{1F5FA}\x{1F6CB}\x{1F6CD}-\x{1F6CF}\x{1F6E0}-\x{1F6E5}\x{1F6E9}\x{1F6F0}\x{1F6F3}]|[\x{23E9}-\x{23EC}\x{23F0}\x{23F3}\x{25FD}\x{2693}\x{26A1}\x{26AB}\x{26C5}\x{26CE}\x{26D4}\x{26EA}\x{26FD}\x{2705}\x{2728}\x{274C}\x{274E}\x{2753}-\x{2755}\x{2757}\x{2795}-\x{2797}\x{27B0}\x{27BF}\x{2B50}\x{1F0CF}\x{1F18E}\x{1F191}-\x{1F19A}\x{1F201}\x{1F21A}\x{1F22F}\x{1F232}-\x{1F236}\x{1F238}-\x{1F23A}\x{1F250}\x{1F251}\x{1F300}-\x{1F320}\x{1F32D}-\x{1F335}\x{1F337}-\x{1F37C}\x{1F37E}-\x{1F384}\x{1F386}-\x{1F393}\x{1F3A0}-\x{1F3C1}\x{1F3C5}\x{1F3C6}\x{1F3C8}\x{1F3C9}\x{1F3CF}-\x{1F3D3}\x{1F3E0}-\x{1F3F0}\x{1F3F8}-\x{1F407}\x{1F409}-\x{1F414}\x{1F416}-\x{1F43A}\x{1F43C}-\x{1F43E}\x{1F440}\x{1F444}\x{1F445}\x{1F451}-\x{1F465}\x{1F46A}\x{1F479}-\x{1F47B}\x{1F47D}-\x{1F480}\x{1F484}\x{1F488}-\x{1F48E}\x{1F490}\x{1F492}-\x{1F4A9}\x{1F4AB}-\x{1F4FC}\x{1F4FF}-\x{1F53D}\x{1F54B}-\x{1F54E}\x{1F550}-\x{1F567}\x{1F5A4}\x{1F5FB}-\x{1F62D}\x{1F62F}-\x{1F634}\x{1F637}-\x{1F644}\x{1F648}-\x{1F64A}\x{1F680}-\x{1F6A2}\x{1F6A4}-\x{1F6B3}\x{1F6B7}-\x{1F6BF}\x{1F6C1}-\x{1F6C5}\x{1F6D0}-\x{1F6D2}\x{1F6D5}-\x{1F6D7}\x{1F6DD}-\x{1F6DF}\x{1F6EB}\x{1F6EC}\x{1F6F4}-\x{1F6FC}\x{1F7E0}-\x{1F7EB}\x{1F7F0}\x{1F90D}\x{1F90E}\x{1F910}-\x{1F917}\x{1F920}-\x{1F925}\x{1F927}-\x{1F92F}\x{1F93A}\x{1F93F}-\x{1F945}\x{1F947}-\x{1F976}\x{1F978}-\x{1F9B4}\x{1F9B7}\x{1F9BA}\x{1F9BC}-\x{1F9CC}\x{1F9D0}\x{1F9E0}-\x{1F9FF}\x{1FA70}-\x{1FA74}\x{1FA78}-\x{1FA7C}\x{1FA80}-\x{1FA86}\x{1FA90}-\x{1FAAC}\x{1FAB0}-\x{1FABA}\x{1FAC0}-\x{1FAC2}\x{1FAD0}-\x{1FAD9}\x{1FAE0}-\x{1FAE7}]/u', '', $string);
  }

  /**
   * Restrict a string to a specific set of characters used in Strict methods.
   */
  protected static function strict(string $string): string {
    $string = static::mbRemove($string);

    return (string) preg_replace('/[^a-zA-Z0-9_\- ]/', '', $string);
  }

}
