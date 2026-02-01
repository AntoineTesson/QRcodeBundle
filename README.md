# YellowskiesQRcodeBundle

[![Latest Stable Version](https://poser.pugx.org/yellowskies/qr-code-bundle/version)](https://packagist.org/packages/yellowskies/qr-code-bundle)
[![License](https://poser.pugx.org/yellowskies/qr-code-bundle/license)](https://packagist.org/packages/yellowskies/qr-code-bundle)

A Symfony Barcode & QR Code Generator Bundle with Twig extension.

**Supports PHP 8.2+ and Symfony 6.4 / 7.x / 8.x**

## Features

- Support 3 two-dimensional (2D) and 30 one-dimensional (1D) Barcode types
- Three output formats: HTML, PNG and SVG
- Twig integration: use the `barcode` function directly in your templates
- No external dependencies for barcode generation

## Installation

```bash
composer require yellowskies/qr-code-bundle
```

The bundle uses Symfony Flex and will be automatically configured.

### Manual registration (if not using Flex)

Add to `config/bundles.php`:

```php
return [
    // ...
    Skies\QRcodeBundle\SkiesQRcodeBundle::class => ['all' => true],
];
```

## Usage

### Generate options

| Option | Type | Required | Allowed values | Description |
|:------:|:----:|:--------:|:--------------:|:-----------:|
| code | string | required | | What you want to encode |
| type | string | required | [See types below](#supported-barcode-types) | Type of barcode |
| format | string | required | html, svg, png | Output format |
| width | int | optional | | Width of unit |
| height | int | optional | | Height of unit |
| color | string/array | optional | HTML color / [R,G,B] | Barcode color |

> Default width/height: 2D = 5x5, 1D = 2x30
> Default color: html/svg = "black", png = [0, 0, 0]

### In Twig templates

```twig
{# HTML barcode #}
{{ barcode({code: 'Hello World', type: 'qrcode', format: 'html'}) }}

{# SVG with custom size and color #}
{{ barcode({code: 'Hello World', type: 'qrcode', format: 'svg', width: 10, height: 10, color: 'green'}) }}

{# PNG (base64 encoded) #}
<img src="data:image/png;base64,{{ barcode({code: 'Hello World', type: 'datamatrix', format: 'png'}) }}" />
```

### In a controller/service

```php
use Skies\QRcodeBundle\Generator\Generator;

class MyController extends AbstractController
{
    public function index(Generator $generator): Response
    {
        $barcode = $generator->generate([
            'code'   => 'Hello World',
            'type'   => 'qrcode',
            'format' => 'svg',
            'width'  => 10,
            'height' => 10,
            'color'  => 'green',
        ]);

        return new Response($barcode);
    }
}
```

### Standalone usage

```php
use Skies\QRcodeBundle\Generator\Generator;

$generator = new Generator();
$barcode = $generator->generate([
    'code'   => 'Hello World',
    'type'   => 'qrcode',
    'format' => 'html',
]);
```

### Save to file

```php
// HTML or SVG
file_put_contents('/tmp/barcode.svg', $barcode);

// PNG (decode base64 first)
file_put_contents('/tmp/barcode.png', base64_decode($barcode));
```

## Supported Barcode Types

### 2D Barcodes

| Type | Name | Example |
|:----:|:----:|:-------:|
| qrcode | [QR Code](https://en.wikipedia.org/wiki/QR_code) | ![](Resources/doc/barcode/qrcode.png) |
| pdf417 | [PDF417](https://en.wikipedia.org/wiki/PDF417) | ![](Resources/doc/barcode/pdf417.png) |
| datamatrix | [Data Matrix](https://en.wikipedia.org/wiki/Data_Matrix) | ![](Resources/doc/barcode/datamatrix.png) |

### 1D Barcodes

| Type | Name |
|:----:|:----:|
| c128 | [Code 128](https://en.wikipedia.org/wiki/Code_128) |
| c128a/b/c | Code 128 A/B/C |
| c39 | [Code 39](https://en.wikipedia.org/wiki/Code_39) |
| c39+ | Code 39 with check digit |
| c39e | Code 39 Extended |
| c39e+ | Code 39 Extended with check digit |
| c93 | [Code 93](https://en.wikipedia.org/wiki/Code_93) |
| ean8 | [EAN-8](https://en.wikipedia.org/wiki/EAN-8) |
| ean13 | [EAN-13](https://en.wikipedia.org/wiki/EAN-13) |
| upca | [UPC-A](https://en.wikipedia.org/wiki/Universal_Product_Code) |
| upce | [UPC-E](https://en.wikipedia.org/wiki/Universal_Product_Code) |
| i25 | [Interleaved 2 of 5](https://en.wikipedia.org/wiki/Interleaved_2_of_5) |
| s25 | Standard 2 of 5 |
| msi | [MSI](https://en.wikipedia.org/wiki/MSI_Barcode) |
| postnet | [POSTNET](https://en.wikipedia.org/wiki/POSTNET) |
| planet | [PLANET](https://en.wikipedia.org/wiki/Postal_Alpha_Numeric_Encoding_Technique) |
| rms4cc | [RMS4CC](https://en.wikipedia.org/wiki/RM4SCC) |
| kix | [KIX-code](https://nl.wikipedia.org/wiki/KIX-code) |
| imb | [Intelligent Mail](https://en.wikipedia.org/wiki/Intelligent_Mail_barcode) |
| codabar | [Codabar](https://en.wikipedia.org/wiki/Codabar) |
| code11 | [Code 11](https://en.wikipedia.org/wiki/Code_11) |
| pharma | [Pharmacode](https://en.wikipedia.org/wiki/Pharmacode) |
| pharma2t | Pharmacode Two-Track |

## Requirements

- PHP 8.2+
- Symfony 6.4+ / 7.x / 8.x
- GD extension (for PNG output)
- bcmath extension (for Intelligent Mail barcodes)

## Upgrade from 1.x

If upgrading from version 1.x:

1. Update your `composer.json` to require `"yellowskies/qr-code-bundle": "^2.0"`
2. Ensure you're running PHP 8.2+ and Symfony 6.4+
3. The Twig function now returns the barcode string instead of echoing it (no change needed in templates)

## License

Apache-2.0
