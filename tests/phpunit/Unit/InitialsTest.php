<?php

declare(strict_types=1);

namespace AlexSkrypnyk\Str2Name\Tests\Unit;

use AlexSkrypnyk\Str2Name\Str2Name;
use PHPUnit\Framework\Attributes\CoversMethod;

#[CoversMethod(Str2Name::class, 'initials')]
final class InitialsTest extends MethodTestCase {

  protected static array $cases = [
    ['My Awesome Site', 'mas'],
    ['star wars', 'sw'],
    ['One Two Three Four Five', 'ottf'],
    ['', ''],
    ['Single', 's'],
    ['élan vital', 'ev'],
    ['0 cool', '0c'],
    ['a__b', 'ab'],
  ];

}
