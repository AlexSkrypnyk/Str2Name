<?php

declare(strict_types=1);

namespace AlexSkrypnyk\Str2Name\Benchmarks;

use AlexSkrypnyk\Str2Name\Str2Name;
use PhpBench\Attributes as Bench;

/**
 * The character-walking formatters (camel, pascal, train) and the strict-based
 * machine name must stay linear in the input length. Inputs that grow by an
 * order of magnitude make a super-linear regression visible as a jump in the
 * per-size timings.
 */
#[Bench\Revs(50)]
#[Bench\Iterations(5)]
#[Bench\Warmup(1)]
#[Bench\RetryThreshold(10)]
class ScalingBenchmark extends AbstractBenchmark {

  #[Bench\ParamProviders(['provideSizes'])]
  public function benchCamelScaling(array $params): void {
    Str2Name::camel($params['input']);
  }

  #[Bench\ParamProviders(['provideSizes'])]
  public function benchPascalScaling(array $params): void {
    Str2Name::pascal($params['input']);
  }

  #[Bench\ParamProviders(['provideSizes'])]
  public function benchTrainScaling(array $params): void {
    Str2Name::train($params['input']);
  }

  #[Bench\ParamProviders(['provideSizes'])]
  public function benchMachineScaling(array $params): void {
    Str2Name::machine($params['input']);
  }

  /**
   * @return \Generator<string, array{input: string}>
   *   Named parameter sets keyed by their approximate word count.
   */
  public function provideSizes(): \Generator {
    yield '30w' => ['input' => self::repeated(10)];
    yield '100w' => ['input' => self::repeated(33)];
    yield '300w' => ['input' => self::repeated(100)];
  }

}
