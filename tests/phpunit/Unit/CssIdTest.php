<?php

declare(strict_types=1);

namespace AlexSkrypnyk\Str2Name\Tests\Unit;

use AlexSkrypnyk\Str2Name\Str2Name;
use PHPUnit\Framework\Attributes\CoversMethod;

#[CoversMethod(Str2Name::class, 'cssId')]
class CssIdTest extends MethodTestCase {

  protected static array $cases = [
    ['abcdefghijklmnopqrstuvwxyz-0123456789', 'abcdefghijklmnopqrstuvwxyz-0123456789'],
    ['invalid,./:@\\^`{Üidentifier', 'invalididentifier'],
    ['ID NAME_[1]', 'id-name-1'],
    ['test-unique-id', 'test-unique-id'],
    ['test-unique-id', 'test-unique-id'],
  ];

}
