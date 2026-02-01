<?php

namespace Skies\QRcodeBundle\Tests\Type;

use PHPUnit\Framework\TestCase;
use Skies\QRcodeBundle\Type\Type;

class TypeTest extends TestCase
{
    /**
     * testConfigureOptions
     */
    public function testInvalidArgumentException(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        Type::getDimension('Unknown Type');
    }
}
