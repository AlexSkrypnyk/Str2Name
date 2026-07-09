# Performance benchmarks

PHPBench suite measuring the `Str2Name` formatters and converters. Run `composer benchmark` to compare against the committed baseline locally; the committed baseline itself is regenerated on CI (see Comparison and baseline).

## What is measured

- **`GenericFormatterBenchmark`** - the generic case formatters (`lower`, `upper`, `snake`, `camel`, `pascal`, `kebab`, `train`, `flat`, `cobol`) on one representative mixed-case, accented input.
- **`NamedFormatterBenchmark`** - the named identifier producers (`machine`, `constant`, `cssClass`, `cssId`, `phpClass`, `phpMethod`, `domain`, `httpHeader`, `abbreviation`). These layer the strict pipeline (transliteration + character stripping) on top of the generic formatters, so they exercise the heaviest paths in the class.
- **`ConverterBenchmark`** - the case converters, including the `mbAddSeparatorBeforeUpperCaseChar` path used by the `camel`/`pascal` origin conversions.
- **`ScalingBenchmark`** - how `camel`, `pascal`, `train` and `machine` scale as the input grows by an order of magnitude (~30 → ~100 → ~300 words). It makes the shape of each formatter's cost curve visible: a formatter whose cost grows faster than its input shows a disproportionate jump at the largest size instead of hiding as a silent slowdown. The top size is kept modest so the suite stays measurable even against a quadratic implementation.

## Reading the results

These formatters run on identifiers, so a typical input is a handful of words and a typical cost is a few microseconds. The value of the suite is the committed baseline: run `composer benchmark` on a change to see how each number moves against it, and watch the `ScalingBenchmark` for any subject whose cost grows faster than its input.

Absolute times are environment-specific - each CI run lands on a different shared runner - so use the numbers to spot large shifts, not exact values.

## Cost in context

These formatters run on identifiers - field labels, machine names, CSS classes - not on large documents, so the realistic input is a handful of words and the realistic cost is a few microseconds. A microsecond is a thousandth of a millisecond: against a page aiming for a ~200 ms response (200,000 μs), formatting a label is on the order of 0.001% of the budget. The `ScalingBenchmark` deliberately pushes past realistic input to expose an algorithmic regression, not because few-hundred-word identifiers occur in practice.

## Comparison and baseline

The benchmark runs on every pull request and every push to `main`, posting its comparison against the committed baseline as a PR comment and as the running trend on the "Performance benchmarks" issue. It is a **tracking signal, not a pass/fail gate** - it never fails CI.

A hard gate is deliberately not used: each CI run lands on a different shared GitHub runner, and runner speed varies run-to-run, so a fresh candidate compared against a committed baseline shifts that much regardless of the code.

The committed baseline in `.phpbench/storage/` is the comparison reference. Refresh it by running the "Benchmark PHP" workflow manually (Run workflow / `workflow_dispatch`) on the target branch: the job regenerates the baseline on the runner, removes the previous one, and commits the single replacement back. Because a pull request runs the workflow file from its own branch, dispatching it on a feature branch refreshes that branch's baseline directly - no merge to the default branch is needed first.
