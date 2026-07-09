<?php

declare(strict_types=1);

namespace AlexSkrypnyk\Str2Name\Tests\Unit;

use AlexSkrypnyk\Str2Name\Str2Name;
use PHPUnit\Framework\Attributes\CoversMethod;

#[CoversMethod(Str2Name::class, 'cssClassRaw')]
final class CssClassRawTest extends MethodTestCase {

  protected static array $cases = [
    ['abcdefghijklmnopqrstuvwxyz_ABCDEFGHIJKLMNOPQRSTUVWXYZ-0123456789', 'abcdefghijklmnopqrstuvwxyz-ABCDEFGHIJKLMNOPQRSTUVWXYZ-0123456789'],
    ['¡¢£¤¥', '¡¢£¤¥'],
    ['css__identifier__with__double__underscores', 'css__identifier__with__double__underscores'],
    ['invalid!"#$%&\'()*+,./:;<=>?@[\\]^`{|}~ identifier', 'invalididentifier'],
    ['1css_identifier', '_css-identifier'],
    ['-1css_identifier', '__css-identifier'],
    ['--css_identifier', '__css-identifier'],

    // Literal hashes must not be mistaken for a double-underscore placeholder:
    // stray '#' is stripped while real '__' pairs are preserved intact.
    ['##', ''],
    ['a__b##c', 'a__bc'],
    ['a##__b', 'a__b'],
    ['keep__these##and__those', 'keep__theseand__those'],
    ['__x##__y__', '__x__y__'],
  ];

}
