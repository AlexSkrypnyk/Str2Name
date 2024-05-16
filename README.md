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

## Generic conversions

| Method | Conversion|
| --- | --- |
| `snake` | `I am a__string-With sp@ce¥s 14 and 😀 unicode élève` <br/> `i_am_a__string_with_sp@ce¥s_14_and_😀_unicode_élève` |
| `camel` | `I am a__string-With sp@ce¥s 14 and 😀 unicode élève` <br/> `iAmAStringWithSp@ce¥s14And😀UnicodeÉlève` |
| `pascal` | `I am a__string-With sp@ce¥s 14 and 😀 unicode élève` <br/> `IAmAStringWithSp@ce¥s14And😀UnicodeÉlève` |
| `kebab` | `I am a__string-With sp@ce¥s 14 and 😀 unicode élève` <br/> `i-am-a--string-with-sp@ce¥s-14-and-😀-unicode-élève` |
| `train` | `I am a__string-With sp@ce¥s 14 and 😀 unicode élève` <br/> `I-Am-A--String-With-Sp@ce¥s-14-And-😀-Unicode-Élève` |
| `flat` | `I am a__string-With sp@ce¥s 14 and 😀 unicode élève` <br/> `iamastringwithsp@ce¥s14and😀unicodeélève` |
| `cobol` | `I am a__string-With sp@ce¥s 14 and 😀 unicode élève` <br/> `I-AM-A--STRING-WITH-SP@CE¥S-14-AND-😀-UNICODE-ÉLÈVE` |

## Named conversions

| Method | Conversion|
| --- | --- |
| `constant` | `I am a__string-With sp@ce¥s 14 and 😀 unicode élève` <br/> `I_AM_A__STRING_WITH_SPCES_14_AND__UNICODE_ELEVE` |
| `constantRaw` | `I am a__string-With sp@ce¥s 14 and 😀 unicode élève` <br/> `I_AM_A__STRING_WITH_SP@CE¥S_14_AND_😀_UNICODE_ÉLÈVE` |
| `cssClass` | `I am a__string-With sp@ce¥s 14 and 😀 unicode élève` <br/> `i-am-a__string-with-spces-14-and--unicode-eleve` |
| `cssClassRaw` | `I am a__string-With sp@ce¥s 14 and 😀 unicode élève` <br/> `I-am-a__string-With-spce¥s-14-and--unicode-élève` |
| `cssId` | `I am a__string-With sp@ce¥s 14 and 😀 unicode élève` <br/> `i-am-a-string-with-spces-14-and-unicode-eleve` |
| `cssIdRaw` | `I am a__string-With sp@ce¥s 14 and 😀 unicode élève` <br/> `i-am-a-string-with-spces-14-and-unicode-lve` |
| `domain` | `I am a__string-With sp@ce¥s 14 and 😀 unicode élève` <br/> `i_am_a__stringwith_sp@ce¥s_14_and_😀_unicode_élève` |
| `httpHeader` | `I am a__string-With sp@ce¥s 14 and 😀 unicode élève` <br/> `I-Am-A--String-With-Spces-14-And--Unicode-Eleve` |
| `id` | `I am a__string-With sp@ce¥s 14 and 😀 unicode élève` <br/> `iamastringwithspces14andunicodeeleve` |
| `idRaw` | `I am a__string-With sp@ce¥s 14 and 😀 unicode élève` <br/> `iamastringwithsp@ce¥s14and😀unicodeélève` |
| `idUpper` | `I am a__string-With sp@ce¥s 14 and 😀 unicode élève` <br/> `IAMASTRINGWITHSPCES14ANDUNICODEELEVE` |
| `idUpperRaw` | `I am a__string-With sp@ce¥s 14 and 😀 unicode élève` <br/> `IAMASTRINGWITHSP@CE¥S14AND😀UNICODEÉLÈVE` |
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
| `sentence` | `I am a__string-With sp@ce¥s 14 and 😀 unicode élève` <br/> `I am a string-with sp@ce¥s 14 and 😀 unicode élève` |

## Installation and usage

`Str2Name` is a self-contained class that can be included in any PHP
project directly or via Composer. It does not have any dependencies.

There are two ways to include `Str2Name` in your project:
- [Direct download](#direct-download)
- [Composer](#composer)

### Direct download

1. Download the file from the [releases page](https://github.com/AlexSkrypnyk/str2name/releases)

2. Register the namespace in `composer.json` of your project:

```composer.json
{
    "autoload": {
        "psr-4": {
            "AlexSkrypnyk\\Str2Name\\": "path/to/src/Str2Name.php"
        }
    }
}
```

3. Use it in your project:

```php
<php

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
<php

use AlexSkrypnyk\Str2Name\Str2Name;

class MyClass {

    public function myMethod() {
        $string = 'string to convert';
        // Convert string to machine name.
        $string = Str2Name::machine($string);
    }

}
```

## Maintenance

    composer install
    composer lint
    composer test
    composer docs


---
Repository created using https://getscaffold.dev/
