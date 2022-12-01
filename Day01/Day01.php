<?php

$count = 0;
$elves = [];
$handle = fopen('input.txt', 'r');

while(!!! feof($handle))
{
    $line = fgets($handle);

    if (strlen(trim($line) > 0))
    {
        $count += (int) $line;
        continue;
    }

    array_push($elves, $count);
    $count = 0;
}

arsort($elves);
$top3Elves = array_slice($elves, 0, 3);

echo "Part 1: Elf is carrying a total of: " . array_shift($elves) . " Calories<br>";
echo "Part 2: Top three elves are carrying a total of: " . array_sum($top3Elves) . " Calories";