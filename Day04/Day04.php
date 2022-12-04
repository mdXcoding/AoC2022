<?php

$handle = fopen('input.txt', 'r');
$part1 = 0;
$part2 = 0;

while(!!! feof($handle))
{
    $line = fgets($handle);
    $elves = explode(",", $line);
    $elf1 = explode("-", $elves[0]);
    $elf2 = explode("-", $elves[1]);

    // part 1
    if (((int)$elf1[0] <= (int)$elf2[0] && (int)$elf1[1] >= (int)$elf2[1]) ||
         (int)$elf1[0] >= (int)$elf2[0] && (int)$elf1[1] <= (int)$elf2[1])
    {
        $part1++;
    }

    // part 2
    if ((int)$elf1[1] >= (int)$elf2[0] && (int)$elf1[0] <= (int)$elf2[0] ||
        (int)$elf1[0] <= (int)$elf2[1] && (int)$elf1[0] >= (int)$elf2[0])
    {
        $part2++;
    }
}

echo "Part1: {$part1} <br>";
echo "Part2: {$part2} <br>";