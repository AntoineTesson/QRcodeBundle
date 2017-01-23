<?php

namespace Skies\QRcodeBundle\Tests\Type;

use PHPUnit_Framework_TestCase;
use Skies\QRcodeBundle\Type\Type;

/**
 * Class TypeTest
 *
 * @package Skies\QRcodeBundle\Tests\Type
 */
class TypeTest extends PHPUnit_Framework_TestCase
{
    /**
     * testConfigureOptions
     *
     * @expectedException \InvalidArgumentException
     */
    public function testInvalidArgumentException()
    {
        $type = new Type();
        $type->getDimension('Unknown Type');
    }
}
