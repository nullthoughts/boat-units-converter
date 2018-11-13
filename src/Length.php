<?php

namespace distinctm\Converter;

class Length
{
    /**
     * Converts from one unit of measure to another
     *
     * @param string $from
     * @param string $value
     * @param string $to
     * @param array $options
     * @return integer|float|string
     */
    public function convert(string $from, string $value, string $to, $options = null)
    {
        $from = $this->getConverterName('from', $from);
        $to = $this->getConverterName('to', $to);

        $value = $this->{$from}($value);

        return $this->{$to}($value, $options);
    }
    
    /**
     * Returns method name for conversion
     *
     * @param string $direction
     * @param string $unit
     * @return void
     */
    protected function getConverterName(string $direction, string $unit)
    {
        $method = $direction . str_replace( '-', '', $unit);

        if(!method_exists($this, $method)) {
            throw new \Exception($direction . " conversion formula not found");
        }

        return $method;
    }

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