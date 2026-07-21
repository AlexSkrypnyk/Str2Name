<?php

declare(strict_types=1);

namespace AlexSkrypnyk\Str2Name\Tests\Unit;

use AlexSkrypnyk\Str2Name\Str2Name;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

/**
 * Tests the extension-free fallback taken when mbstring is absent.
 *
 * PHPUnit itself requires mbstring, so the fallback branch never runs during a
 * normal CI run. These tests force it by flipping the cached detection flag on
 * the class via reflection - no production seam is exposed. The genuine
 * no-extension environment is covered separately by tests/e2e/no-mbstring.php.
 */
#[CoversClass(Str2Name::class)]
final class FallbackTest extends TestCase {

  protected const STANDARD = 'I am a__string-With sp@ce¥s 14 and 😀 unicode élève';

  protected function tearDown(): void {
    $this->forceMbstring(NULL);
    parent::tearDown();
  }

  /**
   * Strict and length-only formatters are identical with or without mbstring.
   */
  #[DataProvider('dataProviderIdenticalUnderFallback')]
  public function testIdenticalUnderFallback(string $method): void {
    $this->forceMbstring(TRUE);
    $with = Str2Name::{$method}(self::STANDARD);

    $this->forceMbstring(FALSE);
    $without = Str2Name::{$method}(self::STANDARD);

    $this->assertSame($with, $without, sprintf('%s() must be identical with and without mbstring', $method));
  }

  public static function dataProviderIdenticalUnderFallback(): array {
    return array_map(static fn(string $method): array => [$method], [
      'machine',
      'constant',
      'phpFunction',
      'phpNamespace',
      'filepath',
      'phpClass',
      'phpMethod',
      'httpHeader',
      'cssClass',
      'cssId',
      'id',
      'idUpper',
      'initials',
      'abbreviation',
    ]);
  }

  /**
   * Generic formatters and *Raw variants degrade to ASCII case folding.
   */
  #[DataProvider('dataProviderDegradesToAsciiUnderFallback')]
  public function testDegradesToAsciiUnderFallback(string $method, string $input, string $expected): void {
    $this->forceMbstring(FALSE);

    $this->assertSame($expected, Str2Name::{$method}($input));
  }

  public static function dataProviderDegradesToAsciiUnderFallback(): \Iterator {
    yield ['lower', 'ÉLÈVE', 'ÉlÈve'];
    yield ['upper', 'élève', 'éLèVE'];
    yield ['snake', 'Élève Café', 'Élève_café'];
    yield ['camel', 'Élève café', 'ÉlèveCafé'];
    yield ['pascal', 'élève café', 'élèveCafé'];
    yield ['kebab', 'Élève Café', 'Élève-café'];
    yield ['train', 'élève café', 'élève-Café'];
    yield ['cobol', 'élève café', 'éLèVE-CAFé'];
    yield ['sentence', 'ÉLÈVE café', 'ÉlÈve café'];
    yield ['constantRaw', 'élève café', 'éLèVE_CAFé'];
    yield ['idUpperRaw', 'élève', 'éLèVE'];
  }

  /**
   * The public proxies take the ASCII branch when mbstring is forced off.
   */
  public function testProxiesUnderFallback(): void {
    $this->forceMbstring(FALSE);

    $this->assertSame('ÉlÈve', Str2Name::mbStrtolower('ÉLÈVE'));
    $this->assertSame('éLèVE', Str2Name::mbStrtoupper('élève'));
    $this->assertSame(5, Str2Name::mbStrlen('élève'));
    $this->assertSame('lè', Str2Name::mbSubstr('élève', 1, 2));
    $this->assertSame(['a', '😀', 'b'], Str2Name::mbStrSplit('a😀b'));
    $this->assertSame([], Str2Name::mbStrSplit(''));
  }

  /**
   * The proxies use the mbstring branch when it is available or forced on.
   */
  public function testProxiesWithMbstring(): void {
    $this->forceMbstring(TRUE);

    $this->assertSame('élève', Str2Name::mbStrtolower('ÉLÈVE'));
    $this->assertSame('ÉLÈVE', Str2Name::mbStrtoupper('élève'));
    $this->assertSame(5, Str2Name::mbStrlen('élève'));
    $this->assertSame('lè', Str2Name::mbSubstr('élève', 1, 2));
    $this->assertSame(['a', '😀', 'b'], Str2Name::mbStrSplit('a😀b'));
  }

  /**
   * Resetting the flag re-detects mbstring from the runtime on the next call.
   */
  public function testDetectionResetsToRuntime(): void {
    $this->forceMbstring(NULL);

    // function_exists('mb_strtolower') is TRUE in the PHPUnit runtime (via the
    // extension or the dev polyfill), so detection picks the mbstring path.
    $this->assertSame('é', Str2Name::mbStrtolower('É'));
  }

  /**
   * The composed helpers take their fallback paths when mbstring is off.
   */
  public function testComposedHelpersUnderFallback(): void {
    $this->forceMbstring(FALSE);

    // Single-word input exercises the mbStrlen()/mbSubstr() fallbacks.
    $this->assertSame('su', Str2Name::abbreviation('supercalifragilistic'));
    // Empty input exercises the empty-string mbStrSplit() fallback.
    $this->assertSame('', Str2Name::camel(''));
    // Fallback of mbAddSeparatorBeforeUpperCaseChar(): the ASCII "A" is
    // separated, but the non-ASCII uppercase is not detected as uppercase.
    $this->assertSame('i_amÉlève', Str2Name::camel2snake('iAmÉlève'));
  }

  protected function forceMbstring(?bool $value): void {
    (new \ReflectionProperty(Str2Name::class, 'mbstring'))->setValue(NULL, $value);
  }

}
