<?php

namespace Skies\QRcodeBundle\Twig\Extensions;

use Skies\QRcodeBundle\Generator\Generator;
use Twig_Extension;
use Twig_SimpleFunction;

/**
 * Class Project_Twig_Extension
 *
 * @package Skies\QRcodeBundle\Twig\Extensions
 */
class Barcode extends Twig_Extension
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
            new Twig_SimpleFunction(
                'barcode',
                function ($options = []) {
                    echo $this->generator->generate($options);
                }
            ),
        ];
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'barcode';
    }
}
