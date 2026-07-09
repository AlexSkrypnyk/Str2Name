<?php

declare(strict_types=1);

namespace AlexSkrypnyk\Str2Name\Benchmarks;

use AlexSkrypnyk\Str2Name\Str2Name;
use PhpBench\Attributes as Bench;

/**
 * Benchmarks the generic case formatters on a single representative input.
 *
 * @package AlexSkrypnyk\Str2Name\Benchmarks
 */
#[Bench\Revs(2000)]
#[Bench\Iterations(10)]
#[Bench\Warmup(2)]
#[Bench\RetryThreshold(5)]
class GenericFormatterBenchmark extends AbstractBenchmark {

  /**
   * Benchmark the lower formatter.
   */
  public function benchLower(): void {
    Str2Name::lower(self::INPUT);
  }

  /**
   * Benchmark the upper formatter.
   */
  public function benchUpper(): void {
    Str2Name::upper(self::INPUT);
  }

  /**
   * Benchmark the snake formatter.
   */
  public function benchSnake(): void {
    Str2Name::snake(self::INPUT);
  }

  /**
   * Benchmark the camel formatter.
   */
  public function benchCamel(): void {
    Str2Name::camel(self::INPUT);
  }

  /**
   * Benchmark the pascal formatter.
   */
  public function benchPascal(): void {
    Str2Name::pascal(self::INPUT);
  }

  /**
   * Benchmark the kebab formatter.
   */
  public function benchKebab(): void {
    Str2Name::kebab(self::INPUT);
  }

  /**
   * Benchmark the train formatter.
   */
  public function benchTrain(): void {
    Str2Name::train(self::INPUT);
  }

  /**
   * Benchmark the flat formatter.
   */
  public function benchFlat(): void {
    Str2Name::flat(self::INPUT);
  }

  /**
   * Benchmark the cobol formatter.
   */
  public function benchCobol(): void {
    Str2Name::cobol(self::INPUT);
  }

}
