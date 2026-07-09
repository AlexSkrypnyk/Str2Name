<?php

declare(strict_types=1);

namespace AlexSkrypnyk\Str2Name\Benchmarks;

use AlexSkrypnyk\Str2Name\Str2Name;
use PhpBench\Attributes as Bench;

/**
 * Benchmarks the named formatters - the real-world identifier producers.
 *
 * These run the strict pipeline (transliteration, character stripping) on top
 * of the generic formatters, so they exercise the heaviest paths in the class.
 *
 * @package AlexSkrypnyk\Str2Name\Benchmarks
 */
#[Bench\Revs(2000)]
#[Bench\Iterations(10)]
#[Bench\Warmup(2)]
#[Bench\RetryThreshold(5)]
class NamedFormatterBenchmark extends AbstractBenchmark {

  /**
   * Benchmark the machine name formatter.
   */
  public function benchMachine(): void {
    Str2Name::machine(self::INPUT);
  }

  /**
   * Benchmark the constant formatter.
   */
  public function benchConstant(): void {
    Str2Name::constant(self::INPUT);
  }

  /**
   * Benchmark the CSS class formatter.
   */
  public function benchCssClass(): void {
    Str2Name::cssClass(self::INPUT);
  }

  /**
   * Benchmark the CSS id formatter.
   */
  public function benchCssId(): void {
    Str2Name::cssId(self::INPUT);
  }

  /**
   * Benchmark the PHP class formatter.
   */
  public function benchPhpClass(): void {
    Str2Name::phpClass(self::INPUT);
  }

  /**
   * Benchmark the PHP method formatter.
   */
  public function benchPhpMethod(): void {
    Str2Name::phpMethod(self::INPUT);
  }

  /**
   * Benchmark the domain formatter.
   */
  public function benchDomain(): void {
    Str2Name::domain(self::INPUT);
  }

  /**
   * Benchmark the HTTP header formatter.
   */
  public function benchHttpHeader(): void {
    Str2Name::httpHeader(self::INPUT);
  }

  /**
   * Benchmark the abbreviation formatter.
   */
  public function benchAbbreviation(): void {
    Str2Name::abbreviation(self::INPUT);
  }

}
