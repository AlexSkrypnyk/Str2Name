# Performance benchmarks

PHPBench suite measuring the `Str2Name` formatters and converters. Run `composer benchmark` to measure the working tree, or `composer benchmark-compare` to measure two checkouts against each other (see Comparison).

## What is measured

- **`GenericFormatterBenchmark`** - the generic case formatters (`lower`, `upper`, `snake`, `camel`, `pascal`, `kebab`, `train`, `flat`, `cobol`) on one representative mixed-case, accented input.
- **`NamedFormatterBenchmark`** - the named identifier producers (`machine`, `constant`, `cssClass`, `cssId`, `phpClass`, `phpMethod`, `domain`, `httpHeader`, `abbreviation`). These layer the strict pipeline (transliteration + character stripping) on top of the generic formatters, so they exercise the heaviest paths in the class.
- **`ConverterBenchmark`** - the case converters, including the `mbAddSeparatorBeforeUpperCaseChar` path used by the `camel`/`pascal` origin conversions.
- **`ScalingBenchmark`** - how `camel`, `pascal`, `train` and `machine` scale as the input grows by an order of magnitude (~30 → ~100 → ~300 words). It makes the shape of each formatter's cost curve visible: a formatter whose cost grows faster than its input shows a disproportionate jump at the largest size instead of hiding as a silent slowdown. The top size is kept modest so the suite stays measurable even against a quadratic implementation.

## Reading the results

These formatters run on identifiers, so a typical input is a handful of words and a typical cost is a few microseconds. The value of the suite is the comparison: measure the change against the revision it branched from to see how each number moves, and watch the `ScalingBenchmark` for any subject whose cost grows faster than its input.

Absolute times are environment-specific - each CI run lands on a different shared runner - so use the numbers to spot large shifts, not exact values. A percentage is only meaningful between two runs on one host.

## Cost in context

These formatters run on identifiers - field labels, machine names, CSS classes - not on large documents, so the realistic input is a handful of words and the realistic cost is a few microseconds. A microsecond is a thousandth of a millisecond: against a page aiming for a ~200 ms response (200,000 μs), formatting a label is on the order of 0.001% of the budget. The `ScalingBenchmark` deliberately pushes past realistic input to expose an algorithmic regression, not because few-hundred-word identifiers occur in practice.

## Comparison

There is no committed baseline. A benchmark comparison measures both revisions on the machine it runs on: each CI run lands on a different shared GitHub runner, and the spread between two hosts reaches several times the change these subjects are meant to detect, so a percentage against a baseline measured elsewhere carries no signal.

On a pull request, `.github/workflows/benchmark-php.yml` checks out the base and head revisions into `base/` and `head/`, installs one toolchain and shares it between them, and hands both to `.github/scripts/benchmark-compare.sh`. The run fails when a subject gets slower by more than 15%. On a push to `main` the same script measures the merged revision alone and replaces the table on the "Performance benchmarks" issue.

Run the same comparison locally with `composer benchmark-compare`; see [CONTRIBUTING.md](../CONTRIBUTING.md) for the checkout commands.
