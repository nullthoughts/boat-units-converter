<?php

namespace distinctm\Converter;

use distinctm\Converter\UnitOfMeasure;

class Length extends UnitOfMeasure
{
    /**
     * Standardizes inches
     *
     * @param float $value
     * @return float
     */
    protected function fromInches(float $value)
    {
        return number_format($value, 2);
    }

    /** Standardizes feet 
     * 
     * @param float $value
     * @return float
    */
    protected function fromFeet(float $value)
    {
        return $value * 12;
    }

    /**
     * Standardizes foot-inches (x' x")
     *
     * @param string $value
     * @return integer
     */
    protected function fromFootInches(string $value)
    {
        preg_match('/^(\d+)\s?(?:\'|ft)\s?(\d{1,2})\s?(?:"|in)$/', $value, $matches);    
        return ($matches[1] * 12) + $matches[2];
    }

    /**
     * Converts to feet in decimal format
     *
     * @param float $value
     * @param array $options
     * @return float
     */
    protected function toFeet(float $value, $options = null)
    {
        // Add options for decimals, etc
        return number_format($value / 12, 2);
    }

    /**
     * Converts to foot-inches
     *
     * @param float $value
     * @return string
     */
    protected function toFootInches(float $value)
    {
        $feet = $value / 12;
        $feet = explode('.', $feet)[0];
        $inches = $value - ($feet * 12);

        $output = '';
        $output .= $feet ? $feet . "'" : null;
        $output .= $inches ? $inches . '"' : null;

        return $output;
    }

    /**
     * Converts to inches
     *
     * @param float $value
     * @return float
     */
    protected function toInches(float $value)
    {
        return $value;
    }

}