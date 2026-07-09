<?php

declare(strict_types=1);

namespace AlexSkrypnyk\Str2Name\Tests\Unit;

use AlexSkrypnyk\Str2Name\Str2Name;
use PHPUnit\Framework\Attributes\CoversMethod;

#[CoversMethod(Str2Name::class, 'pascal')]
final class PascalTest extends MethodTestCase {

  protected static array $cases = [
    ['', ''],
    ['a', 'A'],
    ['ABC', 'ABC'],
    ['my variable name', 'MyVariableName'],
    ['my-variable_name', 'MyVariableName'],
    ['MyVariableName', 'MyVariableName'],
    ['my  variable', 'MyVariable'],
    ['hello_world-foo', 'HelloWorldFoo'],
    ['one two three', 'OneTwoThree'],
    ['test123name', 'Test123name'],
    ['café élève', 'CaféÉlève'],
  ];

}
