<?php

namespace distinctm\Converter;

abstract class UnitOfMeasure
{
    /**
     * Converts from one unit of measure to another
     *
     * @param string $from
     * @param mixed $value
     * @param string $to
     * @param array $options
     * @return integer|float|string
     */
    public function convert(string $from, $value, string $to, $options = null)
    {
        if ($value == null) {
            return null;
        }

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
        $method = $direction . str_replace('-', '', $unit);

        if (!method_exists($this, $method)) {
            throw new \Exception("\"". $direction . "\" conversion formula not found");
        }

        return $method;
    }
}
