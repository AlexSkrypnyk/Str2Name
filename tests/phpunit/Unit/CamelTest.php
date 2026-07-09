<?php

declare(strict_types=1);

namespace AlexSkrypnyk\Str2Name\Tests\Unit;

use AlexSkrypnyk\Str2Name\Str2Name;
use PHPUnit\Framework\Attributes\CoversMethod;

#[CoversMethod(Str2Name::class, 'camel')]
final class CamelTest extends MethodTestCase {

  protected static array $cases = [
    ['', ''],
    ['a', 'a'],
    ['ABC', 'aBC'],
    ['my variable name', 'myVariableName'],
    ['my-variable_name', 'myVariableName'],
    ['MyVariableName', 'myVariableName'],
    ['my  variable', 'myVariable'],
    ['hello_world-foo', 'helloWorldFoo'],
    ['one two three', 'oneTwoThree'],
    ['test123name', 'test123name'],
    ['café élève', 'caféÉlève'],
  ];

}
