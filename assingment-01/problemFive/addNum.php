<?php 
/*
Problem 5:
Given an integer n, find the sum of the digits of the integer.

--------------------------
Sample input 1:
62343
Sample output 1: 
18

--------------------------
Sample input 2:
1000
Sample output 2: 
1
*/

$num = 623436;
$numOne = 1000;


function addSum($n){
    if(is_numeric($n)){
        $castToStr = strval($n);

        $sum = 0;

        for ($i=0; $i < strlen($castToStr) ; $i++) { 
            
            $sum += intval($castToStr[$i]);
        }

        return $sum;
    }else{
        return "Here Given Number is a string.Please Provied a number.";
    }

}

echo addSum($num);

?>