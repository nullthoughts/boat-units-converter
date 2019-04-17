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

    /** @test */
    public function inches_to_foot_inches()
    {
        $result = (new Length)->convert('inches', 99, 'foot-inches');
        $this->assertEquals("8'3\"", $result);
    }

    /** @test */
    public function inches_to_foot_inches_options()
    {
        $result = (new Length)->convert('inches', 99, 'foot-inches', [' ft, ', ' in']);
        $this->assertEquals("8 ft, 3 in", $result);
    }

    /** @test */
    public function inches_to_foot_inches_full_feet()
    {
        $result = (new Length)->convert('inches', 264.00, 'foot-inches', ["' ", "\""]);
        $this->assertEquals("22'", $result);
    }

    /** @test */
    public function messy_feet_to_inches()
    {
        $result = (new Length)->convert('feet', 8.083333, 'inches');
        $this->assertEquals(97, $result);
    }

    /** @test */
    public function foot_inches_feet_only_to_foot_inches()
    {
        $result = (new Length)->convert('foot-inches', "9'", 'foot-inches');
        $this->assertEquals("9'", $result);
    }

    /** @test */
    public function foot_inches_with_double_single_quotes_to_foot_inches()
    {
        $result = (new Length)->convert('foot-inches', "7' 2''", 'foot-inches');
        $this->assertEquals("7'2\"", $result);
    }

    /** @test */
    public function foot_inches_with_double_single_quotes_to_inches()
    {
        $result = (new Length)->convert('foot-inches', "7' 2''", 'inches');
        $this->assertEquals(86, $result);
    }

    /** @test */
    public function foot_inches_to_foot_inches_with_decimal_inches()
    {
        $result = (new Length)->convert('foot-inches', "7' 6.5", 'foot-inches');
        $this->assertEquals("7'7\"", $result);
    }

    /** @test */
    public function foot_inches_with_decimal_inches_to_inches()
    {
        $result = (new Length)->convert('foot-inches', "7' 6.5", 'inches');
        $this->assertEquals(91, $result);
    }

    /** @test */
    public function unknown_from_conversion_formula()
    {
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('"from" conversion formula not found');
        $result = (new Length)->convert('gallons', 8.083333, 'inches');
    }

    /** @test */
    public function unknown_to_conversion_formula()
    {
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('"to" conversion formula not found');
        $result = (new Length)->convert('feet', 8.083333, 'gallons');
    }
}
