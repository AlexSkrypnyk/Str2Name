<?php

declare(strict_types=1);

namespace AlexSkrypnyk\Str2Name\Tests\Unit;

use AlexSkrypnyk\Str2Name\Str2Name;
use PHPUnit\Framework\Attributes\CoversMethod;

#[CoversMethod(Str2Name::class, 'machine')]
class MachineTest extends Str2NameTestCase {

  protected static array $cases = [
    ['I am a_string-With spaces 14', 'i_am_a_string-with_spaces_14'],
  ];

}
