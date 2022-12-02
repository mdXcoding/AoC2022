<?php
require_once ('classes/Game.php');
require_once ('classes/Hand.php');
require_once ('classes/FileReader.php');

use classes\Game;
use classes\Hand;
use classes\FileReader;

$fileReader = new FileReader("input.txt");
$totalScore = 0;
$totalScoreStrategy = 0;

foreach($fileReader->getLines() as $line)
{
    $hands = explode(" " , $line);

    $game = new Game(new Hand($hands[0]), new Hand($hands[1]));
    $gameWithStrategy = new Game(new Hand($hands[0]), new Hand($hands[1]), true);

    $totalScore += $game->score;
    $totalScoreStrategy += $gameWithStrategy->score;
}

echo "Your total score: {$totalScore} <br>";
echo "Your total score playing with strategy: {$totalScoreStrategy} <br>";