<?php

declare(strict_types=1);

namespace AlexSkrypnyk\Str2Name\Tests\Unit;

use AlexSkrypnyk\Str2Name\Str2Name;
use PHPUnit\Framework\Attributes\CoversMethod;

#[CoversMethod(Str2Name::class, 'phpPackage')]
class PhpPackageTest extends MethodTestCase {

  protected static array $cases = [
    ['abc/def', 'abc/def'],
    ['Abc/dEf', 'abc/def'],
    ['Ab.c/d.Ef', 'ab.c/d.ef'],

    ['abc', ''],
    ['¡¢', ''],
    ['¡¢/£¤¥', ''],
  ];

}
