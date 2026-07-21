<p align="center">
  <a href="" rel="noopener">
  <img width=200px height=200px src="https://placehold.jp/000000/ffffff/200x200.png?text=Str2Name&css=%7B%22border-radius%22%3A%22%20100px%22%7D" alt="Str2Name logo"></a>
</p>

<h1 align="center">Convert strings to named formats</h1>

<div align="center">

[![GitHub Issues](https://img.shields.io/github/issues/AlexSkrypnyk/str2name.svg)](https://github.com/AlexSkrypnyk/str2name/issues)
[![GitHub Pull Requests](https://img.shields.io/github/issues-pr/AlexSkrypnyk/str2name.svg)](https://github.com/AlexSkrypnyk/str2name/pulls)
[![Test PHP](https://github.com/AlexSkrypnyk/str2name/actions/workflows/test-php.yml/badge.svg)](https://github.com/AlexSkrypnyk/str2name/actions/workflows/test-php.yml)
[![codecov](https://codecov.io/gh/AlexSkrypnyk/str2name/graph/badge.svg?token=7WEB1IXBYT)](https://codecov.io/gh/AlexSkrypnyk/str2name)
![GitHub release (latest by date)](https://img.shields.io/github/v/release/AlexSkrypnyk/str2name)
![LICENSE](https://img.shields.io/github/license/AlexSkrypnyk/str2name)
![Renovate](https://img.shields.io/badge/renovate-enabled-green?logo=renovatebot)

</div>

---

## Installation and usage

`Str2Name` is a self-contained class that can be included in any PHP
project directly or via Composer. It does not have any dependencies.

The `mbstring` extension is recommended but not required: `Str2Name`
uses it when it is available and transparently falls back to
extension-free implementations when it is not. Without `mbstring`,
non-ASCII case conversion in the generic formatters and `*Raw` methods
degrades to ASCII; the strict named formatters (`machine`, `cssClass`,
`constant`, ...) are unaffected.

There are two ways to include `Str2Name` in your project:

- [Direct download](#direct-download)
- [Composer](#composer)

### Direct download

1. Download the file from
   the [releases page](https://github.com/AlexSkrypnyk/str2name/releases)

2. Place `Str2Name.php` in a directory and register the namespace against
   that directory in `composer.json` of your project:

```composer.json
{
    "autoload": {
        "psr-4": {
            "AlexSkrypnyk\\Str2Name\\": "path/to/directory/"
        }
    }
}
```

3. Use it in your project:

```php
<?php

use AlexSkrypnyk\Str2Name\Str2Name;

class MyClass {

    public function myMethod() {
        $string = 'string to convert';
        // Convert string to machine name.
        $string = Str2Name::machine($string);
    }

}
```

### Composer

1. Require the package via Composer:

```bash
 composer require alexskrypnyk/str2name
```

2. Use it in your project:

```php
<?php

use AlexSkrypnyk\Str2Name\Str2Name;

class MyClass {

    public function myMethod() {
        $string = 'string to convert';
        // Convert string to machine name.
        $string = Str2Name::machine($string);
    }

}
```

## Generic formatters

| Method | Conversion|
| --- | --- |
| `lower` | `I am a__string-With sp@ce¥s 14 and 😀 unicode élève` <br/> `i am a__string-with sp@ce¥s 14 and 😀 unicode élève` |
| `upper` | `I am a__string-With sp@ce¥s 14 and 😀 unicode élève` <br/> `I AM A__STRING-WITH SP@CE¥S 14 AND 😀 UNICODE ÉLÈVE` |
| `snake` | `I am a__string-With sp@ce¥s 14 and 😀 unicode élève` <br/> `i_am_a__string_with_sp@ce¥s_14_and_😀_unicode_élève` |
| `camel` | `I am a__string-With sp@ce¥s 14 and 😀 unicode élève` <br/> `iAmAStringWithSp@ce¥s14And😀UnicodeÉlève` |
| `pascal` | `I am a__string-With sp@ce¥s 14 and 😀 unicode élève` <br/> `IAmAStringWithSp@ce¥s14And😀UnicodeÉlève` |
| `kebab` | `I am a__string-With sp@ce¥s 14 and 😀 unicode élève` <br/> `i-am-a--string-with-sp@ce¥s-14-and-😀-unicode-élève` |
| `train` | `I am a__string-With sp@ce¥s 14 and 😀 unicode élève` <br/> `I-Am-A--String-With-Sp@ce¥s-14-And-😀-Unicode-Élève` |
| `flat` | `I am a__string-With sp@ce¥s 14 and 😀 unicode élève` <br/> `iamastringwithsp@ce¥s14and😀unicodeélève` |
| `cobol` | `I am a__string-With sp@ce¥s 14 and 😀 unicode élève` <br/> `I-AM-A--STRING-WITH-SP@CE¥S-14-AND-😀-UNICODE-ÉLÈVE` |

## Converters between generic formats

| Method | Conversion|
| --- | --- |
| `snake2camel` | `i_am_a__string_with_sp@ce¥s_14_and_😀_unicode_élève` <br/> `iAmAStringWithSp@ce¥s14And😀UnicodeÉlève` |
| `snake2pascal` | `i_am_a__string_with_sp@ce¥s_14_and_😀_unicode_élève` <br/> `IAmAStringWithSp@ce¥s14And😀UnicodeÉlève` |
| `snake2kebab` | `i_am_a__string_with_sp@ce¥s_14_and_😀_unicode_élève` <br/> `i-am-a--string-with-sp@ce¥s-14-and-😀-unicode-élève` |
| `snake2train` | `i_am_a__string_with_sp@ce¥s_14_and_😀_unicode_élève` <br/> `I-Am-A--String-With-Sp@ce¥s-14-And-😀-Unicode-Élève` |
| `snake2flat` | `i_am_a__string_with_sp@ce¥s_14_and_😀_unicode_élève` <br/> `iamastringwithsp@ce¥s14and😀unicodeélève` |
| `snake2cobol` | `i_am_a__string_with_sp@ce¥s_14_and_😀_unicode_élève` <br/> `I-AM-A--STRING-WITH-SP@CE¥S-14-AND-😀-UNICODE-ÉLÈVE` |
| `camel2snake` | `iAmAStringWithSp@ce¥s14And😀UnicodeÉlève` <br/> `i_am_a_string_with_sp@ce¥s_14_and😀_unicode_élève` |
| `camel2pascal` | `iAmAStringWithSp@ce¥s14And😀UnicodeÉlève` <br/> `IAmAStringWithSp@ce¥s14And😀UnicodeÉlève` |
| `camel2kebab` | `iAmAStringWithSp@ce¥s14And😀UnicodeÉlève` <br/> `i-am-a-string-with-sp@ce¥s-14-and😀-unicode-élève` |
| `camel2train` | `iAmAStringWithSp@ce¥s14And😀UnicodeÉlève` <br/> `I-Am-A-String-With-Sp@ce¥s-14-And😀-Unicode-Élève` |
| `camel2flat` | `iAmAStringWithSp@ce¥s14And😀UnicodeÉlève` <br/> `iamastringwithsp@ce¥s14and😀unicodeélève` |
| `camel2cobol` | `iAmAStringWithSp@ce¥s14And😀UnicodeÉlève` <br/> `I-AM-A-STRING-WITH-SP@CE¥S-14-AND😀-UNICODE-ÉLÈVE` |
| `pascal2snake` | `IAmAStringWithSp@ce¥s14And😀UnicodeÉlève` <br/> `i_am_a_string_with_sp@ce¥s_14_and😀_unicode_élève` |
| `pascal2camel` | `IAmAStringWithSp@ce¥s14And😀UnicodeÉlève` <br/> `iAmAStringWithSp@ce¥s14And😀UnicodeÉlève` |
| `pascal2kebab` | `IAmAStringWithSp@ce¥s14And😀UnicodeÉlève` <br/> `i-am-a-string-with-sp@ce¥s-14-and😀-unicode-élève` |
| `pascal2train` | `IAmAStringWithSp@ce¥s14And😀UnicodeÉlève` <br/> `I-Am-A-String-With-Sp@ce¥s-14-And😀-Unicode-Élève` |
| `pascal2flat` | `IAmAStringWithSp@ce¥s14And😀UnicodeÉlève` <br/> `iamastringwithsp@ce¥s14and😀unicodeélève` |
| `pascal2cobol` | `IAmAStringWithSp@ce¥s14And😀UnicodeÉlève` <br/> `I-AM-A-STRING-WITH-SP@CE¥S-14-AND😀-UNICODE-ÉLÈVE` |
| `kebab2snake` | `i-am-a--string-with-sp@ce¥s-14-and-😀-unicode-élève` <br/> `i_am_a__string_with_sp@ce¥s_14_and_😀_unicode_élève` |
| `kebab2camel` | `i-am-a--string-with-sp@ce¥s-14-and-😀-unicode-élève` <br/> `iAmAStringWithSp@ce¥s14And😀UnicodeÉlève` |
| `kebab2pascal` | `i-am-a--string-with-sp@ce¥s-14-and-😀-unicode-élève` <br/> `IAmAStringWithSp@ce¥s14And😀UnicodeÉlève` |
| `kebab2train` | `i-am-a--string-with-sp@ce¥s-14-and-😀-unicode-élève` <br/> `I-Am-A--String-With-Sp@ce¥s-14-And-😀-Unicode-Élève` |
| `kebab2flat` | `i-am-a--string-with-sp@ce¥s-14-and-😀-unicode-élève` <br/> `iamastringwithsp@ce¥s14and😀unicodeélève` |
| `kebab2cobol` | `i-am-a--string-with-sp@ce¥s-14-and-😀-unicode-élève` <br/> `I-AM-A--STRING-WITH-SP@CE¥S-14-AND-😀-UNICODE-ÉLÈVE` |
| `train2snake` | `I-Am-A--String-With-Sp@ce¥s-14-And-😀-Unicode-Élève` <br/> `i_am_a__string_with_sp@ce¥s_14_and_😀_unicode_élève` |
| `train2camel` | `I-Am-A--String-With-Sp@ce¥s-14-And-😀-Unicode-Élève` <br/> `iAmAStringWithSp@ce¥s14And😀UnicodeÉlève` |
| `train2pascal` | `I-Am-A--String-With-Sp@ce¥s-14-And-😀-Unicode-Élève` <br/> `IAmAStringWithSp@ce¥s14And😀UnicodeÉlève` |
| `train2kebab` | `I-Am-A--String-With-Sp@ce¥s-14-And-😀-Unicode-Élève` <br/> `i-am-a--string-with-sp@ce¥s-14-and-😀-unicode-élève` |
| `train2flat` | `I-Am-A--String-With-Sp@ce¥s-14-And-😀-Unicode-Élève` <br/> `iamastringwithsp@ce¥s14and😀unicodeélève` |
| `train2cobol` | `I-Am-A--String-With-Sp@ce¥s-14-And-😀-Unicode-Élève` <br/> `I-AM-A--STRING-WITH-SP@CE¥S-14-AND-😀-UNICODE-ÉLÈVE` |
| `cobol2snake` | `I-AM-A--STRING-WITH-SP@CE¥S-14-AND-😀-UNICODE-ÉLÈVE` <br/> `i_am_a__string_with_sp@ce¥s_14_and_😀_unicode_élève` |
| `cobol2camel` | `I-AM-A--STRING-WITH-SP@CE¥S-14-AND-😀-UNICODE-ÉLÈVE` <br/> `iAmAStringWithSp@ce¥s14And😀UnicodeÉlève` |
| `cobol2pascal` | `I-AM-A--STRING-WITH-SP@CE¥S-14-AND-😀-UNICODE-ÉLÈVE` <br/> `IAmAStringWithSp@ce¥s14And😀UnicodeÉlève` |
| `cobol2kebab` | `I-AM-A--STRING-WITH-SP@CE¥S-14-AND-😀-UNICODE-ÉLÈVE` <br/> `i-am-a--string-with-sp@ce¥s-14-and-😀-unicode-élève` |
| `cobol2train` | `I-AM-A--STRING-WITH-SP@CE¥S-14-AND-😀-UNICODE-ÉLÈVE` <br/> `I-Am-A--String-With-Sp@ce¥s-14-And-😀-Unicode-Élève` |
| `cobol2flat` | `I-AM-A--STRING-WITH-SP@CE¥S-14-AND-😀-UNICODE-ÉLÈVE` <br/> `iamastringwithsp@ce¥s14and😀unicodeélève` |

## Named formatters

| Method | Conversion|
| --- | --- |
| `abbreviation` | `I am a__string-With sp@ce¥s 14 and 😀 unicode élève` <br/> `Ia` |
| `bool` | `yes` <br/> `Yes` |
| `constant` | `I am a__string-With sp@ce¥s 14 and 😀 unicode élève` <br/> `I_AM_A__STRING_WITH_SPCES_14_AND__UNICODE_ELEVE` |
| `constantRaw` | `I am a__string-With sp@ce¥s 14 and 😀 unicode élève` <br/> `I_AM_A__STRING_WITH_SP@CE¥S_14_AND_😀_UNICODE_ÉLÈVE` |
| `cssClass` | `I am a__string-With sp@ce¥s 14 and 😀 unicode élève` <br/> `i-am-a__string-with-spces-14-and--unicode-eleve` |
| `cssClassRaw` | `I am a__string-With sp@ce¥s 14 and 😀 unicode élève` <br/> `I-am-a__string-With-spce¥s-14-and--unicode-élève` |
| `cssId` | `I am a__string-With sp@ce¥s 14 and 😀 unicode élève` <br/> `i-am-a-string-with-spces-14-and-unicode-eleve` |
| `cssIdRaw` | `I am a__string-With sp@ce¥s 14 and 😀 unicode élève` <br/> `i-am-a-string-with-spces-14-and-unicode-lve` |
| `domain` | `https://www.I am a__string-With sp@ce¥s 14.and 😀 un/icode élève` <br/> `i-am-a--string-with-sp-ce--s-14.and--un` |
| `filepath` | `I am a__string-With sp@ce¥s 14 and 😀 unicode élève` <br/> `i_am_a__string_with_spces_14_and__unicode_eleve` |
| `host` | `I am a__string-With sp@ce¥s 14 and 😀 unicode élève` <br/> `i-am-a-string-with-sp-ce-s-14-and-unicode-l-ve` |
| `httpHeader` | `I am a__string-With sp@ce¥s 14 and 😀 unicode élève` <br/> `I-Am-A--String-With-Spces-14-And--Unicode-Eleve` |
| `id` | `I am a__string-With sp@ce¥s 14 and 😀 unicode élève` <br/> `iamastringwithspces14andunicodeeleve` |
| `idRaw` | `I am a__string-With sp@ce¥s 14 and 😀 unicode élève` <br/> `iamastringwithsp@ce¥s14and😀unicodeélève` |
| `idUpper` | `I am a__string-With sp@ce¥s 14 and 😀 unicode élève` <br/> `IAMASTRINGWITHSPCES14ANDUNICODEELEVE` |
| `idUpperRaw` | `I am a__string-With sp@ce¥s 14 and 😀 unicode élève` <br/> `IAMASTRINGWITHSP@CE¥S14AND😀UNICODEÉLÈVE` |
| `initials` | `I am a__string-With sp@ce¥s 14 and 😀 unicode élève` <br/> `iaas` |
| `label` | `I am a__string-With sp@ce¥s 14 and 😀 unicode élève` <br/> `I am a string With sp@ce¥s 14 and 😀 unicode élève` |
| `machine` | `I am a__string-With sp@ce¥s 14 and 😀 unicode élève` <br/> `i_am_a__string_with_spces_14_and__unicode_eleve` |
| `machineRaw` | `I am a__string-With sp@ce¥s 14 and 😀 unicode élève` <br/> `i_am_a__string_with_sp@ce¥s_14_and_😀_unicode_élève` |
| `phpClass` | `I am a__string-With sp@ce¥s 14 and 😀 unicode élève` <br/> `IamAStringWithSpces14AndUnicodeEleve` |
| `phpClassRaw` | `I am a__string-With sp@ce¥s 14 and 😀 unicode élève` <br/> `IAmAStringWithSp@ce¥s14And😀UnicodeÉlève` |
| `phpFunction` | `I am a__string-With sp@ce¥s 14 and 😀 unicode élève` <br/> `i_am_a__string_with_spces_14_and__unicode_eleve` |
| `phpFunctionRaw` | `I am a__string-With sp@ce¥s 14 and 😀 unicode élève` <br/> `i_am_a__string_with_sp@ce¥s_14_and_😀_unicode_élève` |
| `phpMethod` | `I am a__string-With sp@ce¥s 14 and 😀 unicode élève` <br/> `iAmAStringWithSpces14AndUnicodeEleve` |
| `phpMethodRaw` | `I am a__string-With sp@ce¥s 14 and 😀 unicode élève` <br/> `iAmAStringWithSp@ce¥s14And😀UnicodeÉlève` |
| `phpNamespace` | `I am a__string-With sp@ce¥s 14 and 😀 unicode élève` <br/> `IAmAStringWithSpces14AndUnicodeEleve` |
| `phpNamespaceRaw` | `I am a__string-With sp@ce¥s 14 and 😀 unicode élève` <br/> `IAmAStringWithSp@ce¥s14And😀UnicodeÉlève` |
| `phpPackage` | `I am a__string-W/ith sp@ce¥s 14 and 😀 unicode élève` <br/> `i-am-a__string-w/ith-sp-ce-s-14-and-unicode-l-ve` |
| `phpPackageName` | `I am a__string-With sp@ce¥s 14 and 😀 unicode élève` <br/> `i-am-a__string-with-sp-ce-s-14-and-unicode-l-ve` |
| `phpPackageNamespace` | `I am a__string-With sp@ce¥s 14 and 😀 unicode élève` <br/> `i-am-a__string-with-sp-ce-s-14-and-unicode-l-ve` |
| `sentence` | `I am a__string-With sp@ce¥s 14 and 😀 unicode élève` <br/> `I am a string-with sp@ce¥s 14 and 😀 unicode élève` |

## Maintenance

    composer install
    composer lint
    composer test
    composer docs

---
_This repository was created using the [Scaffold](https://getscaffold.dev/) project template_
