<?php 
/*
Problem 4:
--------------------------------
Print the following pattern based on the given number n (can be any number). 

-------------------------------
Sample input: 5 
Sample output: 
    *
   ***
  *****
 *******
********* 
------------------------------
*/


function patternBased($n) {

    for ($i=0; $i <= $n ; $i++) { 
        for ($j=0; $j < $n-$i ; $j++) { 
        echo "&nbsp;&nbsp;";
        }
        for ($k=0; $k < 2 * $i - 1 ; $k++) { 
            echo "*";
        }
        echo "</br>";
    }

}
$num = 6;
patternBased($num);

?>