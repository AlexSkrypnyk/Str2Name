<?php

declare(strict_types=1);

namespace AlexSkrypnyk\Str2Name\Tests\Unit;

use AlexSkrypnyk\Str2Name\Str2Name;
use PHPUnit\Framework\Attributes\CoversMethod;

#[CoversMethod(Str2Name::class, 'mbAddSeparatorBeforeUpperCaseChar')]
final class MbAddSeparatorBeforeUpperCaseCharTest extends MethodTestCase {

  protected static array $cases = [
    ['', ''],
    ['word', 'word'],
    ['word word', 'word word'],
    ['élèveÉlite¥', 'élève_Élite¥'],
    ['élèveÉlite14', 'élève_Élite_14'],
    ['élèveÉlite14😀', 'élève_Élite_14😀'],
    ['ÉlèveÉlite14😀', 'Élève_Élite_14😀'],
  ];

}
