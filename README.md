fixedPoint
==========
by Sylvain MARIEL


Convert floating point number (decimal) to fixed point number (binary) and vice versa.
Using : PHP, HTML5, CSS3, jQuery, Bootstrap


***
UI
==

The user modify an input. jQuery intercept the event, and call PHP via ajax methods to compute the new value.
Style thanks to Bootstrap.


**********************
float to fix principle
======================

User give :
  - a floating number on 32 or 64 bits, depending of PHP server. Exemple : 42.75
  - the fixed point format (XqY). Exemple : 8q8

First, we push all the number into the integer part with (binary right shift) because the decbin() function only undestand integer.

```PHP
$nb = 42.75 * pow(2,8) // = 10944
```

Then we transform the shifted number (decimal/float) to binary (string)

```php
$nb = decbin(10944); // = "10101011000000"
```

Then we add the firsts zeros on positive numbers because decbin doesn't return them (but decbin() return the '1' if negative...)

```php
for($i=0; $i<$zero2display; $i++) $nb = "0".$nb; // = "0010101011000000"
```

Then we add the dot (in the ascii string)

```php
$nb = substr($nb, 0, $dotPos) . "." . substr($nb, $dotPos);
```

**********************
fix to float principle
======================

User give a fixed point number (the first char represent the sign)

```php
$nb = "0101010.11" // we want to compute 42,75
```

First we determine the fractional part length

```php
$fracLen = strlen($nb) - strpos($nb, ".") - 1; // = 2 with $nb="0101010.11
```

Then we remove the dot to get a integer number in binary format

```php
$nb = str_replace(".", "", $nb); // ="010101011"
```

Then we convert the binary string to full integer

```php
$nb = bindec($nb); // = 171
```

Then we shift the number to the right to return the original number (fractional part length shift right)

```php
$nb = $nb * pow(2,-$fracLen); // = 42.75
```


N.B. : If the number is negative (Ex: 1010101.01 for -42,75) we apply the two's complement on the binary string.

```php
// inverting
$binary_str = str_replace("1", "2", $binary_str);
$binary_str = str_replace("0", "1", $binary_str);
$binary_str = str_replace("2", "0", $binary_str);
// +1
$binary_nb = bindec($binary_str) + 1;

...

return "-".$binary_nb;
```

