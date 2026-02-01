<?php

declare(strict_types=1);

namespace Skies\QRcodeBundle\Generator;

use Skies\QRcodeBundle\DineshBarcode\DNS1D;
use Skies\QRcodeBundle\DineshBarcode\DNS2D;
use Skies\QRcodeBundle\Type\Type;
use Symfony\Component\OptionsResolver\Options;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Barcode Generator - Encapsulation of barcode libraries for Symfony usage
 */
class Generator
{
    private readonly DNS2D $dns2d;
    private readonly DNS1D $dns1d;
    private readonly OptionsResolver $resolver;

    private const FORMAT_FUNCTION_MAP = [
        'svg' => 'getBarcodeSVG',
        'html' => 'getBarcodeHTML',
        'png' => 'getBarcodePNG',
    ];

    public function __construct()
    {
        $this->dns2d = new DNS2D();
        $this->dns1d = new DNS1D();
        $this->resolver = new OptionsResolver();
        $this->configureOptions($this->resolver);
    }

    private function configureOptions(OptionsResolver $resolver): void
    {
        $resolver
            ->setRequired(['code', 'type', 'format'])
            ->setDefined(['width', 'height', 'color', 'parameters'])
            ->setDefaults([
                'width' => function (Options $options): int {
                    return Type::getDimension($options['type']) === '2D' ? 5 : 2;
                },
                'height' => function (Options $options): int {
                    return Type::getDimension($options['type']) === '2D' ? 5 : 30;
                },
                'color' => function (Options $options): string|array {
                    return $options['format'] === 'png' ? [0, 0, 0] : 'black';
                },
                'parameters' => [],
            ]);

        $resolver->setAllowedTypes('code', 'string');
        $resolver->setAllowedTypes('type', 'string');
        $resolver->setAllowedTypes('format', 'string');
        $resolver->setAllowedTypes('width', 'integer');
        $resolver->setAllowedTypes('height', 'integer');
        $resolver->setAllowedTypes('color', ['string', 'array']);
        $resolver->setAllowedTypes('parameters', 'array');

        $resolver->setAllowedValues('type', array_merge(
            Type::$oneDimensionalBarcodeType,
            Type::$twoDimensionalBarcodeType
        ));
        $resolver->setAllowedValues('format', ['html', 'png', 'svg']);
    }

    /**
     * Generate a barcode with the given options
     *
     * @param array $options Configuration options:
     *                       - code: string - what you want to encode
     *                       - type: string - type of barcode
     *                       - format: string - output format (html, svg, png)
     *                       - width: int - width of unit (optional)
     *                       - height: int - height of unit (optional)
     *                       - color: string|array - foreground color (optional)
     */
    public function generate(array $options = []): string
    {
        $options = $this->resolver->resolve($options);
        $method = self::FORMAT_FUNCTION_MAP[$options['format']];

        if (Type::getDimension($options['type']) === '2D') {
            return (string) $this->dns2d->$method(
                $options['code'],
                $options['type'],
                $options['parameters'],
                $options['width'],
                $options['height'],
                $options['color']
            );
        }

        return (string) $this->dns1d->$method(
            $options['code'],
            $options['type'],
            $options['width'],
            $options['height'],
            $options['color']
        );
    }
}
