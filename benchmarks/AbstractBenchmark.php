<?php

declare(strict_types=1);

namespace AlexSkrypnyk\Str2Name\Benchmarks;

/**
 * Base class for Str2Name benchmarks.
 *
 * @package AlexSkrypnyk\Str2Name\Benchmarks
 */
abstract class AbstractBenchmark {

  /**
   * A representative real-world input shared by the formatter benchmarks.
   *
   * Mixed case, spaces, digits, punctuation and accented characters - the kind
   * of value the formatters convert in practice - so a single subject measures
   * a realistic mix of the branches each formatter takes.
   */
  protected const INPUT = 'A Sample Field Label 42 with Ünïcode';

  /**
   * Build a multi-word input of a given repetition count.
   *
   * Used by the scaling benchmark to measure how conversion time grows with
   * input length, guarding against a super-linear regression.
   */
  protected static function repeated(int $times): string {
    return trim(str_repeat('Sample Words Here ', $times));
  }

}
