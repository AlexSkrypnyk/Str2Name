<?php

/**
 * @file
 * Standalone extension-less end-to-end check for Str2Name.
 *
 * PHPUnit cannot run without ext-mbstring (its sebastian/exporter and
 * sebastian/comparator dependencies require it), so this dependency-free
 * script verifies the library when the extension is absent. It requires only
 * Str2Name.php, never the Composer autoloader, so the dev-only mbstring
 * polyfill is never loaded. Without the polyfill,
 * function_exists('mb_strtolower') is FALSE and MB_CASE_* is undefined when
 * the extension is disabled.
 */

declare(strict_types=1);

use AlexSkrypnyk\Str2Name\Str2Name;

require_once __DIR__ . '/../../Str2Name.php';

$mbstring = function_exists('mb_strtolower');
$standard = 'I am a__string-With sp@ce¥s 14 and 😀 unicode élève';

$failures = [];

$check = static function (string $label, string $expected, string $actual) use (&$failures): void {
  if ($actual !== $expected) {
    $failures[] = sprintf("%s\n  expected: %s\n  actual:   %s", $label, $expected, $actual);
  }
};

// Strict and length-only formatters must be identical with or without
// mbstring, because strict() transliterates to ASCII before any case folding.
$check('machine', 'i_am_a__string_with_spces_14_and__unicode_eleve', Str2Name::machine($standard));
$check('constant', 'I_AM_A__STRING_WITH_SPCES_14_AND__UNICODE_ELEVE', Str2Name::constant($standard));
$check('phpFunction', 'i_am_a__string_with_spces_14_and__unicode_eleve', Str2Name::phpFunction($standard));
$check('phpClass', 'IamAStringWithSpces14AndUnicodeEleve', Str2Name::phpClass($standard));
$check('phpMethod', 'iAmAStringWithSpces14AndUnicodeEleve', Str2Name::phpMethod($standard));
$check('phpNamespace', 'IAmAStringWithSpces14AndUnicodeEleve', Str2Name::phpNamespace($standard));
$check('filepath', 'i_am_a__string_with_spces_14_and__unicode_eleve', Str2Name::filepath($standard));
$check('httpHeader', 'I-Am-A--String-With-Spces-14-And--Unicode-Eleve', Str2Name::httpHeader($standard));
$check('cssClass', 'i-am-a__string-with-spces-14-and--unicode-eleve', Str2Name::cssClass($standard));
$check('cssId', 'i-am-a-string-with-spces-14-and-unicode-eleve', Str2Name::cssId($standard));
$check('id', 'iamastringwithspces14andunicodeeleve', Str2Name::id($standard));
$check('idUpper', 'IAMASTRINGWITHSPCES14ANDUNICODEELEVE', Str2Name::idUpper($standard));
$check('initials', 'iaas', Str2Name::initials($standard));
$check('abbreviation', 'Ia', Str2Name::abbreviation($standard));

// Case folding is a deliberate trade-off: full Unicode with mbstring, ASCII
// without it. Assert the exact output for the detected mode so the fallback
// is verified.
if ($mbstring) {
  $check('lower', 'élève', Str2Name::lower('ÉLÈVE'));
  $check('upper', 'ÉLÈVE', Str2Name::upper('élève'));
  $check('cobol', 'ÉLÈVE-CAFÉ', Str2Name::cobol('élève café'));
  $check('sentence', 'Élève café', Str2Name::sentence('ÉLÈVE café'));
}
else {
  $check('lower', 'ÉlÈve', Str2Name::lower('ÉLÈVE'));
  $check('upper', 'éLèVE', Str2Name::upper('élève'));
  $check('cobol', 'éLèVE-CAFé', Str2Name::cobol('élève café'));
  $check('sentence', 'ÉlÈve café', Str2Name::sentence('ÉLÈVE café'));
}

fwrite(STDOUT, 'mbstring extension: ' . ($mbstring ? 'present' : 'absent') . "\n");

if ($failures !== []) {
  fwrite(STDERR, "FAIL:\n" . implode("\n", $failures) . "\n");
  exit(1);
}

fwrite(STDOUT, "OK: Str2Name behaves correctly in this environment.\n");
exit(0);
