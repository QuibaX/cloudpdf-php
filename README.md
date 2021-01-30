# A PHP Wrapper around the CloudPdf API

[![Latest Version on Packagist](https://img.shields.io/packagist/v/Valsty/cloudpdf-php.svg?style=flat-square)](https://packagist.org/packages/Valsty/cloudpdf-php)

A small PHP wrapper around the CloudPDF API.
Visit https://cloudpdf.dev for more info.

## Installation

You can install the package via composer:

```bash
composer require valsty/cloudpdf-php
```

## Usage

### PDF Generation
```php
$generator = new Valsty\CloudPdf\PDFGenerator('API_KEY');
$downloadUrl = $generator->fromHtml('<h1>Hi there!</h1>', 'myfile.pdf');
```

### Create image(s) from PDF
```php
$generator = new Valsty\CloudPdf\ImageGenerator('API_KEY');
$image = $generator->pdfToImage($pdfUrl, 'jpg');
```

## Credits

- [Stijn Debakker](https://github.com/QuibaX)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
