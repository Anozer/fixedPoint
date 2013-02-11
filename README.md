fixedPoint
==========
by Sylvain MARIEL


Converting floating point number (decimal) to fixed point number (binary).
Converting fixed point number (binary) to floating point number (decimal).

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
  - a floating number on 32 or 64 bits, depending of PHP server
  - the fixed point format (XqY)
  Ex : 42.75 in 8q8, we want --> 00101010.11000000

First, we push all the number into the integer part with (binary right shift) because the decbin() function only undestand integer.
  Ex : 42,75 * 2^8 = 10944

Then we transform the shifted number (decimal/float) to binary (string)
  Ex : decbin(10944) = 10101011000000

Then we add zeros on positive numbers bevause decbin doesn't return them (but decbin() return the '1' if negative...)
  Ex : 0010101011000000

Then we add the dot (in the ascii string)
  Ex : 00101010.11000000


**********************
fix to float principle
======================

User give a fixed point number (the first char represent the sign)
  Ex : 0101010.11 we want --> 42,75

First we determine the fractional part length
  Ex : 2 in 0101010.11

Then we remove the dot to get a integer number in binary format
  Ex : 010101011

Then we convert the binary string to full integer
  Ex : bindec("010101011") = 171

Then we shift the number to the right to return the original number (fractional part length shift right)
  Ex : 171 * 2^2 = 42,75


N.B. : If the number is negative (Ex: 1010101.01 for -42,75) we apply the two's complement before the method.

