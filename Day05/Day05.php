<?php

$handle = fopen('input.txt', 'r');
$stacks = [];

while (!!!feof($handle))
{
    $line = fgets($handle);

    if (str_contains($line, "["))
    {
        $containers = str_split($line, 4);
        foreach($containers as $key => $value)
        {
            if (trim($value))
            {
                $stacks[$key +1][] = $value;
            }
        }
    }
    else if (str_contains($line, 'move'))
    {
        preg_match_all('!\d+!', $line, $movements);
        $movement = $movements[0];

        $stacker = [];
        for ($i = 1; $i <= $movement[0]; $i++)
        {
            $stacker[] = array_shift($stacks[$movement[1]]);
        }

        $stacker = array_reverse($stacker);
        foreach($stacker as $tmp)
        {
            array_unshift($stacks[$movement[2]], $tmp);
        }
    }
}

$part02 = "";
for($x = 1; $x <= count($stacks); $x++)
{
    $part02 .= substr($stacks[$x][0], 1, 1);
}

echo "Part 02: {$part02} <br>";
