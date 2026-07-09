<?php

declare(strict_types=1);

namespace AlexSkrypnyk\Str2Name\Benchmarks;

use AlexSkrypnyk\Str2Name\Str2Name;
use PhpBench\Attributes as Bench;

/**
 * Measures how conversion time scales with input length.
 *
 * The character-walking formatters (camel, pascal, train) and the strict-based
 * machine name must stay linear in the input length. Running each over inputs
 * that grow by an order of magnitude turns a super-linear regression into an
 * obvious jump in the per-size timings rather than a silent slowdown.
 *
 * @package AlexSkrypnyk\Str2Name\Benchmarks
 */
#[Bench\Revs(50)]
#[Bench\Iterations(5)]
#[Bench\Warmup(1)]
#[Bench\RetryThreshold(10)]
class ScalingBenchmark extends AbstractBenchmark {

  /**
   * Benchmark the camel formatter across input sizes.
   */
  #[Bench\ParamProviders(['provideSizes'])]
  public function benchCamelScaling(array $params): void {
    Str2Name::camel($params['input']);
  }

  /**
   * Benchmark the pascal formatter across input sizes.
   */
  #[Bench\ParamProviders(['provideSizes'])]
  public function benchPascalScaling(array $params): void {
    Str2Name::pascal($params['input']);
  }

  /**
   * Benchmark the train formatter across input sizes.
   */
  #[Bench\ParamProviders(['provideSizes'])]
  public function benchTrainScaling(array $params): void {
    Str2Name::train($params['input']);
  }

  /**
   * Benchmark the machine name formatter across input sizes.
   */
  #[Bench\ParamProviders(['provideSizes'])]
  public function benchMachineScaling(array $params): void {
    Str2Name::machine($params['input']);
  }

  /**
   * Provide inputs that grow by an order of magnitude.
   *
   * @return \Generator<string, array{input: string}>
   *   Named parameter sets keyed by their approximate word count.
   */
  public function provideSizes(): \Generator {
    yield '30w' => ['input' => self::repeated(10)];
    yield '300w' => ['input' => self::repeated(100)];
    yield '3000w' => ['input' => self::repeated(1000)];
  }

}
