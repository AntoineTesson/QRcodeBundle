<?php

namespace Skies\QRcodeBundle\Type;

/**
 * Class BarcodeType
 * Supported standards of barcode
 */
class Type
{
    /**
     * @var array oneDimensionalBarcodeType
     */
    public static $oneDimensionalBarcodeType = [
        'c39',
        'c39+',
        'c39e',
        'c39e+',
        'c93',
        's25',
        's25+',
        'i25',
        'i25+',
        'c128',
        'c128a',
        'c128b',
        'c128c',
        'ean2',
        'ean5',
        'ean8',
        'ean13',
        'upca',
        'upce',
        'msi',
        'msi+',
        'postnet',
        'planet',
        'rms4cc',
        'kix',
        'imb',
        'codabar',
        'code11',
        'pharma',
        'pharma2t',
    ];

    /**
     * @var array twoDimensionalBarcodeType
     */
    public static $twoDimensionalBarcodeType = [
        'qrcode',
        'pdf417',
        'datamatrix',
    ];

    /**
     * @param string $type type of barcode
     */
    public static function getDimension(string $type): string
    {
        if (!self::hasType($type)) {
            throw new \InvalidArgumentException("Type of Barcode is not supported.");
        }

        if (in_array($type, self::$twoDimensionalBarcodeType)) {
            return '2D';
        } else {
            return '1D';
        }
    }

    /**
     * @param string $type type of barcode
     */
    public static function hasType(string $type): bool
    {
        return in_array($type, self::$oneDimensionalBarcodeType) || in_array($type, self::$twoDimensionalBarcodeType);
    }
}
