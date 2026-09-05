<?php

declare(strict_types=1);

namespace AlexSkrypnyk\Str2Name\Benchmarks;

use AlexSkrypnyk\Str2Name\Str2Name;
use PhpBench\Attributes as Bench;

#[Bench\Revs(2000)]
#[Bench\Iterations(10)]
#[Bench\Warmup(2)]
#[Bench\RetryThreshold(5)]
class GenericFormatterBenchmark extends AbstractBenchmark {

  public function benchLower(): void {
    Str2Name::lower(self::INPUT);
  }

  public function benchUpper(): void {
    Str2Name::upper(self::INPUT);
  }

  public function benchSnake(): void {
    Str2Name::snake(self::INPUT);
  }

  public function benchCamel(): void {
    Str2Name::camel(self::INPUT);
  }

  public function benchPascal(): void {
    Str2Name::pascal(self::INPUT);
  }

  public function benchKebab(): void {
    Str2Name::kebab(self::INPUT);
  }

  public function benchTrain(): void {
    Str2Name::train(self::INPUT);
  }

  public function benchFlat(): void {
    Str2Name::flat(self::INPUT);
  }

  public function benchCobol(): void {
    Str2Name::cobol(self::INPUT);
  }

}
