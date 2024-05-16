<?php

declare(strict_types=1);

namespace AlexSkrypnyk\Str2Name\Tests\Unit;

use AlexSkrypnyk\Str2Name\Str2Name;
use PHPUnit\Framework\Attributes\CoversMethod;

#[CoversMethod(Str2Name::class, 'cssId')]
class CssClassTest extends MethodTestCase {

  protected static array $cases = [
    ['abcdefghijklmnopqrstuvwxyz_ABCDEFGHIJKLMNOPQRSTUVWXYZ-0123456789', 'abcdefghijklmnopqrstuvwxyz-ABCDEFGHIJKLMNOPQRSTUVWXYZ-0123456789'],
    ['¡¢£¤¥', '¡¢£¤¥'],
    ['css__identifier__with__double__underscores', 'css__identifier__with__double__underscores'],
    ['invalid!"#$%&\'()*+,./:;<=>?@[\\]^`{|}~ identifier', 'invalididentifier'],
    ['1css_identifier', '_css-identifier'],
    ['-1css_identifier', '__css-identifier'],
    ['--css_identifier', '__css-identifier'],
  ];

}
