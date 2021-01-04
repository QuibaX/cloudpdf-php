# A PHP Wrapper around the CloudPdf API

[![Latest Version on Packagist](https://img.shields.io/packagist/v/Valsty/cloudpdf-php.svg?style=flat-square)](https://packagist.org/packages/Valsty/cloudpdf-php)


This is where your description should go. Try and limit it to a paragraph or two. Consider adding a small example.

## Installation

You can install the package via composer:

```bash
composer require valsty/cloudpdf-php
```

## Usage

```php
$generator = new Valsty\CloudPdf\PDFGenerator('API_KEY');
$downloadUrl = $generator->fromHtml('<h1>Hi there!</h1>', 'myfile.pdf');
```

## Credits

- [Stijn Debakker](https://github.com/QuibaX)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
