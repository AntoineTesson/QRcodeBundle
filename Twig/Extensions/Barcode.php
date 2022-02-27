<?php

namespace Skies\QRcodeBundle\Twig\Extensions;

use Skies\QRcodeBundle\Generator\Generator;

class Barcode extends \Twig\Extension\AbstractExtension
{
    /**
     * @var Generator
     */
    protected $generator;

    public function __construct(Generator $generator)
    {
        $this->generator = $generator;
    }

    public function getFunctions(): array
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
