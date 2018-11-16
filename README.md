# converter
Measurement utility for converting common units, designed for the boating industry

# Install
`composer require distinctm/converter`

# Usage
- Feet to Foot Inches: `(new Length)->convert('feet', 9.25, 'foot-inches') //9'3"`
- Feet to Foot Inches with optional display units: `(new Length)->convert('feet', 9.25, 'foot-inches', [' ft, ', ' in') //9 ft, 3 in`
- Inches to Feet: `(new Length)->convert('inches', 99, 'feet') //8.25`

# Supported units
  * Length
    * Foot Inches
    * Feet
    * Inches


# Notes
  * At the moment, the converter just supports length. Volume and other units are coming soon, see Issues #1 & #2
  * Please feel free to contribute by submitting a PR
