<?php

declare(strict_types=1);

namespace Skies\QRcodeBundle\Twig\Extensions;

use Skies\QRcodeBundle\Generator\Generator;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class Barcode extends AbstractExtension
{
    public function __construct(
        private readonly Generator $generator
    ) {
    }

    public function getFunctions(): array
    {
        return [
            new TwigFunction('barcode', $this->generateBarcode(...), ['is_safe' => ['html']]),
        ];
    }

    public function generateBarcode(array $options = []): string
    {
        return $this->generator->generate($options);
    }
}
