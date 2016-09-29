<?php

namespace Skies\QRcodeBundle\Generator;

use Skies\QRcodeBundle\DineshBarcode\DNS1D;
use Skies\QRcodeBundle\DineshBarcode\DNS2D;
use Skies\QRcodeBundle\Type\Type;
use Symfony\Component\OptionsResolver\Options;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class Generator
 * Encapsulation of project https://github.com/dineshrabara/barcode for Symfony2 usage
 *
 * @package SGK\BarcodeBundle\Generator
 */
class Generator
{
    /**
     * @var DNS2D
     */
    protected $dns2d;

    /**
     * @var DNS1D
     */
    protected $dns1d;

    /**
     * @var OptionsResolver
     */
    protected $resolver;

    /**
     * @var array
     */
    protected $formatFunctionMap = [
        'svg' => 'getBarcodeSVG',
        'html' => 'getBarcodeHTML',
        'png' => 'getBarcodePNG',
    ];

    /**
     * construct
     */
    public function __construct()
    {
        $this->dns2d = new DNS2D();
        $this->dns1d = new DNS1D();
        $this->resolver = new OptionsResolver();
        $this->configureOptions($this->resolver);
    }

    /**
     * Configure generate options
     *
     * @param OptionsResolver $resolver
     */
    protected function configureOptions(OptionsResolver $resolver)
    {
        $resolver
            ->setRequired(
                [
                    'code',
                    'type',
                    'format',
                ]
            )
            ->setDefined(
                [
                    'width',
                    'height',
                    'color',
                ]
            )
            ->setDefaults(
                [
                    'width' => function (Options $options) {
                        return Type::getDimension($options['type']) == '2D' ? 5 : 2;
                    },
                    'height' => function (Options $options) {
                        return Type::getDimension($options['type']) == '2D' ? 5 : 30;
                    },
                    'color' => function (Options $options) {
                        return $options['format'] == 'png' ? [0, 0, 0] : 'black';
                    },
                ]
            );

        $allowedTypes = [
            'code' => ['string'],
            'type' => ['string'],
            'format' => ['string'],
            'width' => ['integer'],
            'height' => ['integer'],
            'color' => ['string', 'array'],
        ];

        foreach ($allowedTypes as $typeName => $typeValue) {
            $resolver->setAllowedTypes($typeName, $typeValue);
        }

        $allowedValues = [
            'type' => array_merge(
                Type::$oneDimensionalBarcodeType,
                Type::$twoDimensionalBarcodeType
            ),
            'format' => ['html', 'png', 'svg'],
        ];

        foreach ($allowedValues as $valueName => $value) {
            $resolver->setAllowedValues($valueName, $value);
        }

    }

    /**
     * @param array $options
     *        string $code   code to print
     *        string $type   type of barcode
     *        string $format output format
     *        int    $width  Minimum width of a single bar in user units.
     *        int    $height Height of barcode in user units.
     *        string $color  Foreground color (in SVG format) for bar elements (background is transparent).
     *
     * @return mixed
     */
    public function generate($options = [])
    {
        $options = $this->resolver->resolve($options);

        if (Type::getDimension($options['type']) == '2D') {
            return call_user_func_array(
                [
                    $this->dns2d,
                    $this->formatFunctionMap[$options['format']],
                ],
                [$options['code'], $options['type'], $options['width'], $options['height'], $options['color']]
            );
        } else {
            return call_user_func_array(
                [
                    $this->dns1d,
                    $this->formatFunctionMap[$options['format']],
                ],
                [$options['code'], $options['type'], $options['width'], $options['height'], $options['color']]
            );
        }
    }
}
