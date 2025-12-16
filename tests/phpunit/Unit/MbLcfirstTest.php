<?php

declare(strict_types=1);

namespace AlexSkrypnyk\Str2Name\Tests\Unit;

use AlexSkrypnyk\Str2Name\Str2Name;
use PHPUnit\Framework\Attributes\CoversMethod;

#[CoversMethod(Str2Name::class, 'mbLcfirst')]
final class MbLcfirstTest extends MethodTestCase {

  protected static array $cases = [
    ['', ''],

    ['Word', 'word'],
    ['word', 'word'],
    ['word word', 'word word'],
    ['word Word', 'word Word'],
    ['Word Word', 'word Word'],

    ['😀', '😀'],
    ['😀🚀', '😀🚀'],
    ['😀🚀¥', '😀🚀¥'],
    ['first 😀', 'first 😀'],
    ['First 😀', 'first 😀'],
    ['😀 last', '😀 last'],
    ['first 😀 last', 'first 😀 last'],
    ['first 😀¥ Last', 'first 😀¥ Last'],
    ['first 😀Mid¥ last', 'first 😀Mid¥ last'],
    ['First 😀 Mid ¥ last', 'first 😀 Mid ¥ last'],

    ['👨‍💻', '👨‍💻'],
    ['first 👨‍💻', 'first 👨‍💻'],
    ['👨‍💻 last', '👨‍💻 last'],
    ['first 👨‍💻 Last', 'first 👨‍💻 Last'],

    ['école', 'école'],
    ['École', 'école'],
    ['Élève Élite', 'élève Élite'],
  ];

}
