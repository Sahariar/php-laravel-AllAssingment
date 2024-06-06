<?php
/*
Problem 1:
--------------------------------
Given a list of integers, find the minimum of their absolute values. 
Note:
'Absolute values' means the non-negative value without regard to its sign. For example, the Absolute value of 123 is 123, and the Absolute value of -123 is also 123. 
-------------------------------
Sample input 1:
10 12 15 189 22 2 34
Sample output 1: 
2
------------------------------
Sample input 2:
10 -12 34 12 -3 123
Sample output 2:
3
*/


$input = [16, -12, 34, 12, -31, 123, -11];

function minValue($input)
{
    $data = $input[0];
    for ($i = 0; $i < count($input); $i++) {
        if ($input[$i] < 0) {
            $input[$i] = $input[$i] * -1;
        }
        if ($input[$i] <= $data) {
            $data = $input[$i];
        }
    }
    return $data;
}

echo minValue($input);;
