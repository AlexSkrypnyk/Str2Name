<?php

declare(strict_types=1);

namespace AlexSkrypnyk\Str2Name\Tests\Unit;

use AlexSkrypnyk\Str2Name\Str2Name;
use PHPUnit\Framework\Attributes\CoversMethod;

#[CoversMethod(Str2Name::class, 'train')]
final class TrainTest extends MethodTestCase {

  protected static array $cases = [
    ['', ''],
    ['a', 'A'],
    ['ABC', 'Abc'],
    ['my variable name', 'My-Variable-Name'],
    ['my-variable_name', 'My-Variable-Name'],
    ['MyVariableName', 'Myvariablename'],
    ['my  variable', 'My--Variable'],
    ['hello_world-foo', 'Hello-World-Foo'],
    ['one two three', 'One-Two-Three'],
    ['test123name', 'Test123name'],
    ['café élève', 'Café-Élève'],
  ];

}
