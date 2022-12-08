<?php
use classes\Forest;

require 'classes/Forest.php';
require 'classes/Tree.php';
require 'classes/Boundary.php';
require 'classes/VisibilityResult.php';

$forest = new Forest();

echo "Part 01: {$forest->getPart1Result()} <br>";
echo "Part 02: {$forest->getPart2Result()} <br>";