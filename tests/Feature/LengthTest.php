<?php

namespace distinctm\Converter\Tests;

use Orchestra\Testbench\TestCase;
use distinctm\Converter\Length;

class LengthTest extends TestCase
{
    /** @test */
    public function foot_inches_to_foot_inches()
    {
        $result = (new Length)->convert('foot-inches', "9' 10\"", 'foot-inches');
        $this->assertEquals("9'10\"", $result);
    }

    /** @test */
    public function feet_to_foot_inches()
    {
        $result = (new Length)->convert('feet', 9, 'foot-inches');
        $this->assertEquals("9'", $result);
    }

    /** @test */
    public function feet_to_inches()
    {
        $result = (new Length)->convert('feet', 9.25, 'inches');
        $this->assertEquals(111, $result);
    }

    /** @test */
    public function inches_to_feet()
    {
        $result = (new Length)->convert('inches', 99, 'feet');
        $this->assertEquals(8.25, $result);
    }


    // inches to foot inches
} 