<?php 
// how to use array_filter

////////// exemple 1 : filter the even number in the table ///////////

$numbers = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10];

function isEven($number) {
    return $number % 2 == 0;
}

$evenNumbers = array_filter($numbers, "isEven");

/////////// exemple 2: filter non-empty strings from an array ///////////

$strings = ["apple", "", "banana", null, "cherry", ""];

$nonEmptyStrings = array_filter($strings); // by default, it filters out falsey values

/////////// exemple 3: Using an anonymous (no name function) function as a callback function ///////////

$numbers = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10];

// Utiliser array_filter avec une fonction anonyme pour filtrer les nombres supérieurs à 5
$greaterThanFive = array_filter($numbers, function($number) {
    return $number > 5;
});


