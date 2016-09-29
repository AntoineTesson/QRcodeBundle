<?php

namespace Skies\QRcodeBundle\Tests\Generator;

use PHPUnit_Framework_TestCase;
use Skies\QRcodeBundle\Generator\Generator;

/**
 * Class GeneratorTest
 *
 * @package SGK\BarcodeBundle\Tests\Generator
 */
class GeneratorTest extends PHPUnit_Framework_TestCase
{
    /**
     * @return array
     */
    public function getOptions()
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
     * @param array $options
     *
     * @medium
     *
     * @dataProvider getOptions
     */
    public function testGenerate($options = array())
    {
        $generator = new Generator();

        $this->assertTrue(is_string($generator->generate($options)));
    }

    /**
     * @return array
     */
    public function getErrorOptions()
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
     * testConfigureOptions
     *
     * @param array $options
     *
     * @medium
     *
     * @dataProvider getErrorOptions
     *
     * @expectedException \Exception
     */
    public function testConfigureOptions($options = array())
    {
        $generator = new Generator();

        $generator->generate($options);
    }
}
