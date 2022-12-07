<?php
$file = file('input.txt');
$stack = [];
$paths = [];
$currentDir = "";
$totalDiskSpace = 70000000;
$diskSpaceNeeded = 30000000;

foreach($file as $pointer => $line)
{
    // cd commands
    if (str_starts_with($line, "$ cd"))
    {
        if (str_starts_with($line, '$ cd ..'))
        {
            // return to parent
            array_pop($paths);
        }
        else
        {
            // go into dir
            $currentDir = trim(substr($line, 4, strlen($line)));
            $paths[] = $currentDir;
        }
    }
    // everything except the ls command, which we actually don't have use for
    else if (!!!str_starts_with($line, '$ ls'))
    {
        // create path identifier
        $dirPath = implode("/", $paths);

        // create empty set, yes we could have done a class, but well... here we are :D
        if (!!!isset($stack[$dirPath]))
        {
            $stack[$dirPath] = [
                'size' => 0,
                'files' => [],
                'dirs' => [],
            ];
        }

        // check for digits in the line
        if (preg_match('/\d+/', $line, $size))
        {
            $pointer = "";
            $stack[$dirPath]['files'][] = $line;

            // calculate dir sizes
            foreach($paths as $path)
            {
                $pointer .= $path === '/'
                    ? $path
                    : '/' . $path;

                $stack[$pointer]['size'] += $size[0];
            }
        }
        else
        {
            $stack[$dirPath]['dirs'][] = $line;
        }
    }
}

// part 1 calculations
$sums = array_map(function($items, $dirName) {
    return array_sum($items);
}, array_values($stack), array_keys($stack));

$part1 = array_sum(array_filter($sums, function($sum) {
    return $sum <= 100000;
}));

// part 2 calculations
$minFileSize = $diskSpaceNeeded - ($totalDiskSpace - $stack['/']['size']);
$currentDirSize = null;
foreach($stack as $item)
{
    if ($item['size'] > $minFileSize && (!!!$currentDirSize || $currentDirSize > $item['size']))
    {
        $currentDirSize = $item['size'];
    }
}

echo "Part 1: {$part1} <br>";
echo "Part 2: {$currentDirSize}";