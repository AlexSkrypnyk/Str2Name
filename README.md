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

## Supported conversions

| Method | From | To |
| --- | --- | --- |
| `camel` | `I am a_string-With spaces 14` | `iAmAStringWithSpaces14` |
| `kebab` | `I am a_string-With spaces 14` | `I-am-a-string-With-spaces-14` |
| `label` | `I am a_string-With spaces 14` | `I am a string With spaces 14` |
| `machine` | `I am a_string-With spaces 14` | `i_am_a_string_with_spaces_14` |
| `pascal` | `I am a_string-With spaces 14` | `IAmAStringWithSpaces14` |
| `phpClass` | `I am a_string-With spaces 14` | `IAmAStringWithSpaces14` |
| `phpClassStrict` | `I am a_string-With spaces 14` | `IamAstringWithSpaces14` |
| `phpFunction` | `I am a_string-With spaces 14` | `i_am_a_string_with_spaces_14` |
| `phpMethod` | `I am a_string-With spaces 14` | `iAmAStringWithSpaces14` |
| `phpNamespace` | `I am a_string-With spaces 14` | `IAmAStringWithSpaces14` |
| `snake` | `I am a_string-With spaces 14` | `i_am_a_string_with_spaces_14` |

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
            "AlexSkrypnyk\\Str2Name\\": "path/to/src/Src2Name.php"
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

2Use it in your project:

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
