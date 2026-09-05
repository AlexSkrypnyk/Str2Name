<?php

declare(strict_types=1);

namespace AlexSkrypnyk\Str2Name\Benchmarks;

use AlexSkrypnyk\Str2Name\Str2Name;
use PhpBench\Attributes as Bench;

/**
 * Benchmarks the named formatters - the real-world identifier producers.
 *
 * Most subjects sanitise the input before formatting; domain() and
 * abbreviation() take their own paths. The suite covers the heaviest
 * pipelines in the class.
 */
#[Bench\Revs(2000)]
#[Bench\Iterations(10)]
#[Bench\Warmup(2)]
#[Bench\RetryThreshold(5)]
class NamedFormatterBenchmark extends AbstractBenchmark {

  public function benchMachine(): void {
    Str2Name::machine(self::INPUT);
  }

  public function benchConstant(): void {
    Str2Name::constant(self::INPUT);
  }

  public function benchCssClass(): void {
    Str2Name::cssClass(self::INPUT);
  }

  public function benchCssId(): void {
    Str2Name::cssId(self::INPUT);
  }

  public function benchPhpClass(): void {
    Str2Name::phpClass(self::INPUT);
  }

  public function benchPhpMethod(): void {
    Str2Name::phpMethod(self::INPUT);
  }

  public function benchDomain(): void {
    Str2Name::domain(self::INPUT);
  }

  public function benchHttpHeader(): void {
    Str2Name::httpHeader(self::INPUT);
  }

  public function benchAbbreviation(): void {
    Str2Name::abbreviation(self::INPUT);
  }

}
