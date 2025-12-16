<?php

declare(strict_types=1);

namespace AlexSkrypnyk\Str2Name\Tests\Unit;

use AlexSkrypnyk\Str2Name\Str2Name;
use PHPUnit\Framework\Attributes\CoversMethod;

#[CoversMethod(Str2Name::class, 'mbUcwords')]
final class MbUcwordsTest extends MethodTestCase {

  protected static array $cases = [
    ['', ''],

    ['word', 'Word'],
    ['word word', 'Word Word'],
    ['word Word', 'Word Word'],
    ['Word Word', 'Word Word'],

    ['😀', '😀'],
    ['😀🚀', '😀🚀'],
    ['😀🚀¥', '😀🚀¥'],
    ['first 😀', 'First 😀'],
    ['😀 last', '😀 Last'],
    ['first 😀 last', 'First 😀 Last'],
    ['first 😀¥ last', 'First 😀¥ Last'],
    ['first 😀mid¥ last', 'First 😀mid¥ Last'],
    ['first 😀 mid ¥ last', 'First 😀 Mid ¥ Last'],

    ['👨‍💻', '👨‍💻'],
    ['first 👨‍💻', 'First 👨‍💻'],
    ['👨‍💻 last', '👨‍💻 Last'],
    ['first 👨‍💻 last', 'First 👨‍💻 Last'],

    ['école', 'École'],
    ['élève élite', 'Élève Élite'],
  ];

}
