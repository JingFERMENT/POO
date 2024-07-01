<?php

//  difference between DateTimeImmutable and DateTime

// DateTime (mutable class)
// 1) Objects can be modified after creation.
// 2) Suitable for scenarios where direct modifications to the date and time are needed.

$date = new DateTime ('2024-07-01');
$newDate = $date->modify('+1 day'); // Modifies the original object
echo $date->format('Y-m-d').PHP_EOL; // Outputs 2024-07-02
echo $newDate->format('Y-m-d').PHP_EOL; // outputs 2024-07-02


// DateTimeImmutable (Immutable Class) 
// 1) Objects cannot be modified after creation; any modification returns a new object.
// 2) Ideal for contexts requiring immutability, ensuring the original date and time remain unchanged.

// $date = new DateTimeImmutable;
// $newDate = $date->modify('+1 day');
 
// echo $date->format('d/m/Y').PHP_EOL;
// echo $newDate->format('d/m/Y').PHP_EOL;

