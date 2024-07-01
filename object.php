<?php
// a JSON string defined using the heredoc syntax (<<<JSON ... JSON). 
// This JSON string contains three properties: date, timezone_type, and timezone.

$jsonString = '
{
    "date":"2021-03-23 07:35:44.011207",
    "timezone_type":3,
    "timezone":"Europe/Paris"
}';

$phpObject = json_decode($jsonString); // decode the JSON string into a PHP object

var_dump($phpObject); //display detailed information about the resulting PHP object from classestdClass

// variable defined within a class used to store data or state. 
// It can have different levels of visibility (public, protected, private) 
// and is accessed or modified using the -> operator on an instantiated object of the class

