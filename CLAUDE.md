# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## What this is

A zero-dependency, single-file PHP library (`Str2Name.php`) that converts strings between naming formats (snake, camel, kebab, machine name, CSS class, PHP class, domain, etc.). Requires PHP >= 8.2. Distributed via Composer (`alexskrypnyk/str2name`) or direct download. Everything lives at the repo root - the PSR-4 namespace `AlexSkrypnyk\Str2Name\` maps to `""`, not a `src/` directory.

## Commands

- `composer install` - install dev dependencies.
- `composer test` - run PHPUnit without coverage (fast; use this while iterating).
- `composer test-coverage` - run PHPUnit with coverage (writes `.coverage-html/` and `cobertura.xml`; requires the `pcov` or `xdebug` extension).
- `composer test -- --filter CssIdRawTest` - run a single test class (args after `--` pass through to PHPUnit). Also works with a method name or a path: `composer test -- tests/phpunit/Unit/BoolTest.php`.
- `composer lint` - run `phpcs`, then `phpstan`, then `rector --dry-run`. All three must pass.
- `composer lint-fix` - auto-fix: runs `rector` then `phpcbf`.
- `composer docs` - regenerate the README method tables from source docblocks (see below).
- `composer docs-lint` - fail if the README is out of date with the docblocks (`php docs.php --fail-on-change`); this is a CI gate.

CI (`.github/workflows/test-php.yml`) runs `composer lint`, `composer test-coverage`, and `composer docs-lint` across a PHP 8.2 / 8.3 / 8.4 / 8.5 matrix.

## Architecture

`Str2Name` is a single class of stateless `public static` methods. Call them directly: `Str2Name::machine($input)`. Methods fall into three groups (mirrored by the README sections and the `docs.php` grouping logic):

1. **Generic formatters**: `snake`, `camel`, `pascal`, `kebab`, `train`, `flat`, `cobol`, plus `sentence` and `label`.
2. **Generic converters**: a full `<from>2<to>` matrix (`snake2camel`, `camel2kebab`, `cobol2pascal`, ...). Most are thin wrappers that delegate to a generic formatter, because the formatters are already input-agnostic.
3. **Named formatters**: real-world identifiers - `machine`, `constant`, `cssClass`, `cssId`, `phpClass`, `phpMethod`, `phpNamespace`, `phpFunction`, `phpPackage`, `domain`, `httpHeader`, `id`, `idUpper`, `filepath`, `abbreviation`, `bool`, etc.

### The `strict` vs `Raw` distinction

Many named formatters come in two variants. The plain variant (e.g. `machine`, `cssClass`, `phpClass`) runs the input through `strict()` first; the `*Raw` variant (e.g. `machineRaw`, `cssClassRaw`, `phpClassRaw`) skips it and preserves unicode/emoji/special characters. `strict()` = `mbRemove()` (transliterate accented characters to ASCII via the `MB_MAP` table) followed by stripping everything outside `[a-zA-Z0-9_\- ]`.

### Internal helper pipeline

Below the public API is a block of `protected static` building blocks that the formatters compose: `mbUcfirst`, `mbLcfirst`, `mbUcwords`, `mbAddSeparatorBeforeUpperCaseChar`, `mbRemove` (uses the `MB_MAP` const), `emojiRemove` (a very large generated emoji-matching regex - do not hand-edit it), and `strict`. The whole library is deliberately multibyte-safe: use `mb_*` functions, never the plain `str*`/`substr` equivalents, when adding or changing code.

### Docblock-driven docs AND tests (most important convention)

Each formatter/converter method carries `@from` / `@to` annotations in its docblock giving an example input and its exact expected output. These annotations are the **single source of truth** consumed by two mechanisms:

- `docs.php` reflects over them to regenerate the README tables (`composer docs`).
- `tests/phpunit/Unit/CommentsTest.php` reflects over them and asserts each method actually produces its documented `@to` output.

Consequence: if you change a method's behavior, you MUST update its `@from`/`@to` docblock and run `composer docs`, or both `CommentsTest` and `composer docs-lint` will fail. A method may carry multiple `@from`/`@to` pairs (e.g. `bool`); the count of `@from` and `@to` lines must match.

## Test patterns (`tests/phpunit/Unit/`)

Three distinct styles - pick the one that fits:

- **`CommentsTest`** - the doc-annotation test described above. Covers the one documented example per method automatically. You rarely edit this; it picks up new methods via reflection.
- **`MethodTestCase` subclasses** - for extensive input/output cases on a single method. Name the class `<Method>Test` (e.g. `CssIdRawTest` -> `cssIdRaw`); the base maps class name to method name by reflection and runs a `protected static array $cases` of `[input, expected]` pairs. This also works for `protected` helpers (`MbUcfirstTest`, `MbAddSeparatorBeforeUpperCaseCharTest`, ...).
- **Plain `TestCase` subclasses** - for methods with optional arguments or edge cases a single `@from`/`@to` can't express (`AbbreviationTest`, `BoolTest`, `FromListTest`, `ToListTest`).

PHPUnit is configured with `requireCoverageMetadata="true"`, so every test class needs a `#[CoversClass(Str2Name::class)]` or `#[CoversMethod(Str2Name::class, '<method>')]` attribute or the suite errors.

## Coding standards

- `declare(strict_types=1);` is mandatory in every PHP file (enforced by PHPCS `RequireStrictTypes` and Rector).
- PHPCS ruleset (`phpcs.xml`) = Drupal + DrevOps standards. This implies Drupal conventions: 2-space indentation, uppercase `TRUE`/`FALSE`/`NULL`, snake_case local variables, camelCase method names, and full docblocks. Scanned paths: `Str2Name.php`, `docs.php`, `tests/phpunit`.
- PHPStan runs at **level 9** (`phpstan.neon`).
- Rector (`rector.php`) enforces PHP 8.2 + dead-code/code-quality/coding-style/type-declaration/naming sets, with a specific skip list - check it before assuming a refactor rule applies.
