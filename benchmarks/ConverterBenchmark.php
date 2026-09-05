<?php

declare(strict_types=1);

namespace AlexSkrypnyk\Str2Name\Benchmarks;

use AlexSkrypnyk\Str2Name\Str2Name;
use PhpBench\Attributes as Bench;

/**
 * Benchmarks the case converters, including the separator-insertion path.
 *
 * The camel/pascal -> other conversions run mbAddSeparatorBeforeUpperCaseChar,
 * a distinct hot path from the formatters, so it is measured on its own input.
 */
#[Bench\Revs(2000)]
#[Bench\Iterations(10)]
#[Bench\Warmup(2)]
#[Bench\RetryThreshold(5)]
class ConverterBenchmark extends AbstractBenchmark {

  /**
   * A camelCase input for the camel/pascal-origin converters.
   */
  protected const CAMEL_INPUT = 'aSampleFieldLabel42WithUnicodeValue';

  /**
   * A snake_case input for the snake-origin converters.
   */
  protected const SNAKE_INPUT = 'a_sample_field_label_42_with_unicode_value';

  /**
   * A kebab-case input for the kebab-origin converters.
   */
  protected const KEBAB_INPUT = 'a-sample-field-label-42-with-unicode-value';

  /**
   * A COBOL-CASE input for the cobol-origin converters.
   */
  protected const COBOL_INPUT = 'A-SAMPLE-FIELD-LABEL-42-WITH-UNICODE-VALUE';

  /**
   * Benchmark converting camelCase to snake_case.
   */
  public function benchCamelToSnake(): void {
    Str2Name::camel2snake(self::CAMEL_INPUT);
  }

  /**
   * Benchmark converting camelCase to kebab-case.
   */
  public function benchCamelToKebab(): void {
    Str2Name::camel2kebab(self::CAMEL_INPUT);
  }

  /**
   * Benchmark converting snake_case to camelCase.
   */
  public function benchSnakeToCamel(): void {
    Str2Name::snake2camel(self::SNAKE_INPUT);
  }

  /**
   * Benchmark converting kebab-case to PascalCase.
   */
  public function benchKebabToPascal(): void {
    Str2Name::kebab2pascal(self::KEBAB_INPUT);
  }

  /**
   * Benchmark converting COBOL-CASE to PascalCase.
   */
  public function benchCobolToPascal(): void {
    Str2Name::cobol2pascal(self::COBOL_INPUT);
  }

}
