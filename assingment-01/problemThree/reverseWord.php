<?php 
/*
Problem 3:
--------------------------------
Given a sentence, keep the order of the words same, but reverse the characters of each word. 
For example, if the given sentence is: ‘I love programming’ 
The result should be: ‘I evol gnimmargorp’
Here the order of the words is the same as the given sentence, but the order of the characters in the words is reversed. 
-------------------------------
Sample input 1:
I love programming
Sample output 1: 
I evol gnimmargorp
------------------------------
*/


$text = "I love programming";

function reverseWord($text){
    $textWords = explode(" ", $text);
    // reverse each word and print it with a space.
    for ($i=0; $i < count($textWords) ; $i++) { 
        echo strrev($textWords[$i]). " ";
    
    }
};


reverseWord($text);

?>