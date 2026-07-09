<?php

declare(strict_types=1);

namespace AlexSkrypnyk\Str2Name\Tests\Unit;

use AlexSkrypnyk\Str2Name\Str2Name;
use PHPUnit\Framework\Attributes\CoversMethod;

#[CoversMethod(Str2Name::class, 'host')]
final class HostTest extends MethodTestCase {

  protected static array $cases = [
    ['My Awesome Site', 'my-awesome-site'],
    ['my_site.com', 'my-site.com'],
    ['  Sp@ce¥s 14.io ', 'sp-ce-s-14.io'],
    ['', ''],
    ['---', ''],
    ['...', ''],
    ['.leading', 'leading'],
    ['trailing.', 'trailing'],
    ['already-clean.com', 'already-clean.com'],
    ['192.168.0.1', '192.168.0.1'],
    ['sub.domain.example.com', 'sub.domain.example.com'],
    ['@#$%', ''],
    ['UPPER.CASE', 'upper.case'],
    ['élève', 'l-ve'],
    ['😀hi😀', 'hi'],
    ['a   b', 'a-b'],
  ];

}
