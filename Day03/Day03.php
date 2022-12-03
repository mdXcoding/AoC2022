<?php

/**
 * @param int $pointStart
 * @param int $offset
 * @return array
 */
function createLetters(int $pointStart, int $offset) : array
{
    $points = [];
    for($i = 0; $i < 26; $i++)
    {
        $points[chr($offset + $i)] = $pointStart + $i;
    }

    return $points;
}

// create letter array with priorities
$priorities = array_merge(
        createLetters(1, 97), // lowercase
        createLetters(27,65)  // uppercase
);

$sum_part1 = 0;
$sum_part2 = 0;
$handle = fopen('input.txt', 'r');
$rucksacks = [];

// part one
while(!!! feof($handle))
{
    $rucksack = fgets($handle);

    // create rucksack compartments
    $compartments = [
        str_split(substr($rucksack, 0, floor(strlen($rucksack) / 2))),
        str_split(substr($rucksack, floor(strlen($rucksack) / 2), floor(strlen($rucksack) / 2)))
    ];

    // check letter matching
    $letters = array_unique(array_filter($compartments[0], function ($entity) use ($compartments) {
        return in_array($entity, $compartments[1]);
    }));

    // get sum for part1
    foreach($letters as $letter)
    {
        $sum_part1 += $priorities[$letter];
    }

    $rucksacks[] = $rucksack;
}

// part two
for($i = 0; $i < count($rucksacks); $i+=3)
{
    $exclude = "";
    foreach(str_split(trim($rucksacks[$i])) as $letter)
    {
        if (str_contains($rucksacks[$i+1], $letter) && str_contains($rucksacks[$i+2], $letter) && !!!str_contains($exclude, $letter))
        {
            $sum_part2 += $priorities[$letter];
            $exclude .= $letter;
        }
    }
}

echo "part 1: " . $sum_part1 . "<br>";
echo "part 2: " . $sum_part2;