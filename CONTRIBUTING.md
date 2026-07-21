# Contributing

Thanks for considering a contribution to `Str2Name`. It is a small, single-file, zero-dependency PHP library, so the workflow is intentionally lightweight.

## Getting started

Requires PHP >= 8.2. The `mbstring` extension is recommended but not required.

```bash
composer install
```

## Development workflow

`Str2Name` is a single class of stateless `public static` methods in `Str2Name.php`, with the PSR-4 namespace `AlexSkrypnyk\Str2Name\` mapped to the repository root.

Run the checks locally before opening a pull request:

```bash
composer test          # PHPUnit suite (fast, no coverage).
composer test-coverage # Suite with coverage (needs pcov or xdebug).
composer lint          # phpcs, phpstan (level 9), rector --dry-run.
composer lint-fix      # Auto-fix via rector and phpcbf.
```

## Documentation is generated from docblocks

Each formatter and converter carries `@from` / `@to` annotations in its docblock, giving an example input and its exact expected output. These annotations are the single source of truth for two mechanisms:

- `composer docs` regenerates the method tables in `README.md` from them.
- `tests/phpunit/Unit/CommentsTest.php` asserts each method actually produces its documented `@to` output.

If you change a method's behaviour, update its `@from` / `@to` docblock and run `composer docs`. Otherwise `CommentsTest` and the `composer docs-lint` CI gate will fail.

## Tests

Add or update tests under `tests/phpunit/Unit/` for any change:

- Extend a `MethodTestCase` subclass named `<Method>Test` for input/output cases on a single method.
- Use a plain `TestCase` subclass for methods with optional arguments or edge cases a single `@from` / `@to` cannot express.
- Every test class needs a `#[CoversClass(...)]` or `#[CoversMethod(...)]` attribute; coverage metadata is required.

The library is deliberately multibyte-safe: use the multibyte-aware helpers (for example `Str2Name::mbStrtolower()`) or `mb_*` functions, never the plain `str*` / `substr` equivalents, when adding or changing code.

## Pull requests

1. Fork the repository and create a feature branch.
2. Make your change, keeping the diff focused.
3. Ensure `composer test`, `composer lint`, and `composer docs-lint` all pass.
4. Open a pull request describing what changed and why.

## Reporting issues

Report bugs and feature requests via the [issue tracker](https://github.com/AlexSkrypnyk/str2name/issues). For security issues, follow [`SECURITY.md`](SECURITY.md) instead of opening a public issue.
