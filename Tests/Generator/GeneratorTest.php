<?php

namespace Skies\QRcodeBundle\Tests\Generator;

use PHPUnit\Framework\TestCase;
use Skies\QRcodeBundle\Generator\Generator;

class GeneratorTest extends TestCase
{
    public function getOptions(): array
    {
        return array(
            array(
                array(
                    'code'   => '0123456789',
                    'type'   => 'c128',
                    'format' => 'html',
                    'width'  => 2,
                    'height' => 30,
                    'color'  => 'black',
                ),
            ),
            array(
                array(
                    'code'   => '0123456789',
                    'type'   => 'c39',
                    'format' => 'svg',
                ),
            ),
            array(
                array(
                    'code'   => '0123456789',
                    'type'   => 'qrcode',
                    'format' => 'png',
                    'width'  => 5,
                    'height' => 5,
                    'color'  => array(0 ,0, 0),
                ),
            ),
        );
    }

    /**
     * testGenerate
     *
     * @medium
     *
     * @dataProvider getOptions
     */
    public function testGenerate(array $options = array()): void
    {
        $generator = new Generator();

        $this->assertIsString($generator->generate($options));
    }

    public function getErrorOptions(): array
    {
        return array(
            array(
                array(
                    'code'   => '0123456789',
                ),
            ),
            array(
                array(
                    'code'   => '0123456789',
                    'type'   => 'Unknown Type',
                    'format' => 'html',
                ),
            ),
            array(
                array(
                    'code'   => '0123456789',
                    'type'   => 'c128',
                    'format' => 'Unknown Format',
                ),
            ),
            array(
                array(
                    'code'   => '0123456789',
                    'type'   => 'c39',
                    'format' => 'svg',
                    'width'  => 'width is int',
                ),
            ),
            array(
                array(
                    'code'   => '0123456789',
                    'type'   => 'qrcode',
                    'format' => 'png',
                    'width'  => 5,
                    'height' => 5,
                    'color'  => 5,
                ),
            ),
        );
    }

    /**
     * @medium
     * @dataProvider getErrorOptions
     */
    public function testConfigureOptions(array $options = array()): void
    {
        $this->expectException(\Exception::class);
        $generator = new Generator();

        $generator->generate($options);
    }
}
