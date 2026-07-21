<?php

/**
 * @file
 * Standalone extension-less end-to-end check for Str2Name.
 *
 * PHPUnit cannot run without ext-mbstring (its own sebastian/exporter and
 * sebastian/comparator require it), so this dependency-free script is what
 * proves the library works when mbstring is genuinely absent. It requires only
 * Str2Name.php - never the Composer autoloader - so the dev-only mbstring
 * polyfill is never loaded, and function_exists('mb_strtolower') is really
 * FALSE and MB_CASE_* really undefined when the extension is disabled.
 *
 * Run it directly:
 *   php tests/e2e/no-mbstring.php
 *
 * It exits 0 on success and non-zero (printing every mismatch) on failure.
 */

declare(strict_types=1);

use AlexSkrypnyk\Str2Name\Str2Name;

require __DIR__ . '/../../Str2Name.php';

$mbstring = function_exists('mb_strtolower');
$standard = 'I am a__string-With sp@ce¥s 14 and 😀 unicode élève';

$failures = [];

$check = static function (string $label, string $actual, string $expected) use (&$failures): void {
  if ($actual !== $expected) {
    $failures[] = sprintf("%s\n  expected: %s\n  actual:   %s", $label, $expected, $actual);
  }
};

// Strict and length-only formatters must be identical with or without mbstring,
// because strict() transliterates to ASCII before any case folding.
$check('machine', Str2Name::machine($standard), 'i_am_a__string_with_spces_14_and__unicode_eleve');
$check('constant', Str2Name::constant($standard), 'I_AM_A__STRING_WITH_SPCES_14_AND__UNICODE_ELEVE');
$check('phpClass', Str2Name::phpClass($standard), 'IamAStringWithSpces14AndUnicodeEleve');
$check('phpMethod', Str2Name::phpMethod($standard), 'iAmAStringWithSpces14AndUnicodeEleve');
$check('phpNamespace', Str2Name::phpNamespace($standard), 'IAmAStringWithSpces14AndUnicodeEleve');
$check('httpHeader', Str2Name::httpHeader($standard), 'I-Am-A--String-With-Spces-14-And--Unicode-Eleve');
$check('cssClass', Str2Name::cssClass($standard), 'i-am-a__string-with-spces-14-and--unicode-eleve');
$check('cssId', Str2Name::cssId($standard), 'i-am-a-string-with-spces-14-and-unicode-eleve');
$check('id', Str2Name::id($standard), 'iamastringwithspces14andunicodeeleve');
$check('idUpper', Str2Name::idUpper($standard), 'IAMASTRINGWITHSPCES14ANDUNICODEELEVE');
$check('initials', Str2Name::initials($standard), 'iaas');
$check('abbreviation', Str2Name::abbreviation($standard), 'Ia');

// Case folding is the deliberate trade-off: full Unicode with mbstring, ASCII
// without it. Assert the exact output for the detected mode so the fallback is
// verified rather than merely tolerated.
if ($mbstring) {
  $check('lower', Str2Name::lower('ÉLÈVE'), 'élève');
  $check('upper', Str2Name::upper('élève'), 'ÉLÈVE');
  $check('cobol', Str2Name::cobol('élève café'), 'ÉLÈVE-CAFÉ');
  $check('sentence', Str2Name::sentence('ÉLÈVE café'), 'Élève café');
}
else {
  $check('lower', Str2Name::lower('ÉLÈVE'), 'ÉlÈve');
  $check('upper', Str2Name::upper('élève'), 'éLèVE');
  $check('cobol', Str2Name::cobol('élève café'), 'éLèVE-CAFé');
  $check('sentence', Str2Name::sentence('ÉLÈVE café'), 'ÉlÈve café');
}

fwrite(STDOUT, 'mbstring extension: ' . ($mbstring ? 'present' : 'absent') . "\n");

if ($failures !== []) {
  fwrite(STDERR, "FAIL:\n" . implode("\n", $failures) . "\n");
  exit(1);
}

fwrite(STDOUT, "OK: Str2Name behaves correctly in this environment.\n");
exit(0);
