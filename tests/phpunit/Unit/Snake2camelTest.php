<?php

declare(strict_types=1);

namespace AlexSkrypnyk\Str2Name\Tests\Unit;

use AlexSkrypnyk\Str2Name\Str2Name;
use PHPUnit\Framework\Attributes\CoversMethod;

#[CoversMethod(Str2Name::class, 'snake2camel')]
class Snake2camelTest extends MethodTestCase {

  protected static array $cases = [
    ['i_am_a__string_with_sp@ce¥s_14_and_😀_unicode_élève', 'iAmAStringWithSp@ce¥s14And😀UnicodeÉlève'],
    ['école_😀', 'école😀'],
    ['mid_¥_last', 'mid¥Last'],
  ];

}
