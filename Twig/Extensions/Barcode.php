<?php

namespace Skies\QRcodeBundle\Twig\Extensions;

use Skies\QRcodeBundle\Generator\Generator;

/**
 * Class Project_Twig_Extension
 *
 * @package Skies\QRcodeBundle\Twig\Extensions
 */
class Barcode extends \Twig\Extension\AbstractExtension
{
    /**
     * @var Generator
     */
    protected $generator;

    /**
     * @param Generator $generator
     */
    public function __construct(Generator $generator)
    {
        $this->generator = $generator;
    }

    /**
     * @return array
     */
    public function getFunctions()
    {
        return [
            new \Twig\TwigFunction(
                'barcode',
                function ($options = []) {
                    echo $this->generator->generate($options);
                }
            ),
        ];
    }
}
