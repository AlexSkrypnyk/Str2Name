<?php

declare(strict_types=1);

namespace AlexSkrypnyk\Str2Name\Tests\Unit;

use AlexSkrypnyk\Str2Name\Str2Name;
use PHPUnit\Framework\Attributes\CoversMethod;

#[CoversMethod(Str2Name::class, 'mbUcfirst')]
final class MbUcfirstTest extends MethodTestCase {

  protected static array $cases = [
    ['', ''],

    ['word', 'Word'],
    ['Word', 'Word'],
    ['word word', 'Word word'],
    ['word Word', 'Word Word'],
    ['Word Word', 'Word Word'],

    ['😀', '😀'],
    ['😀🚀', '😀🚀'],
    ['😀🚀¥', '😀🚀¥'],
    ['first 😀', 'First 😀'],
    ['First 😀', 'First 😀'],
    ['😀 last', '😀 last'],
    ['first 😀 last', 'First 😀 last'],
    ['first 😀¥ Last', 'First 😀¥ Last'],
    ['first 😀Mid¥ last', 'First 😀Mid¥ last'],
    ['First 😀 Mid ¥ last', 'First 😀 Mid ¥ last'],

    ['👨‍💻', '👨‍💻'],
    ['first 👨‍💻', 'First 👨‍💻'],
    ['👨‍💻 last', '👨‍💻 last'],
    ['first 👨‍💻 Last', 'First 👨‍💻 Last'],

    ['école', 'École'],
    ['École', 'École'],
    ['Élève Élite', 'Élève Élite'],
  ];

}
