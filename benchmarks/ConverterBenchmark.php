<?php

declare(strict_types=1);

namespace AlexSkrypnyk\Str2Name\Benchmarks;

use AlexSkrypnyk\Str2Name\Str2Name;
use PhpBench\Attributes as Bench;

/**
 * The camel/pascal -> other conversions run mbAddSeparatorBeforeUpperCaseChar,
 * a distinct hot path from the formatters, so it is measured on its own input.
 */
#[Bench\Revs(2000)]
#[Bench\Iterations(10)]
#[Bench\Warmup(2)]
#[Bench\RetryThreshold(5)]
class ConverterBenchmark extends AbstractBenchmark {

  protected const CAMEL_INPUT = 'aSampleFieldLabel42WithUnicodeValue';

  protected const SNAKE_INPUT = 'a_sample_field_label_42_with_unicode_value';

  protected const KEBAB_INPUT = 'a-sample-field-label-42-with-unicode-value';

  protected const COBOL_INPUT = 'A-SAMPLE-FIELD-LABEL-42-WITH-UNICODE-VALUE';

  public function benchCamelToSnake(): void {
    Str2Name::camel2snake(self::CAMEL_INPUT);
  }

  public function benchCamelToKebab(): void {
    Str2Name::camel2kebab(self::CAMEL_INPUT);
  }

  public function benchSnakeToCamel(): void {
    Str2Name::snake2camel(self::SNAKE_INPUT);
  }

  public function benchKebabToPascal(): void {
    Str2Name::kebab2pascal(self::KEBAB_INPUT);
  }

  public function benchCobolToPascal(): void {
    Str2Name::cobol2pascal(self::COBOL_INPUT);
  }

}
