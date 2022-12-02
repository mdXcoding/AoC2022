<?php

namespace classes;

class Game
{
    /**
     * @var Hand
     */
    public Hand $player1;

    /**
     * @var Hand
     */
    public Hand $player2;

    /**
     * @var int
     */
    public int $score;

    /**
     * @var int
     */
    public int $pointsForWinning = 6;

    /**
     * @var int
     */
    public int $pointsForDraw = 3;

    /**
     * @var string
     */
    public string $gameResult;

    /**
     * @param Hand $player1
     * @param Hand $player2
     * @param bool $useStrategy
     *
     */
    public function __construct(Hand $player1, Hand $player2, bool $useStrategy = false)
    {
        $this->player1 = $player1;
        $this->player2 = $player2;

        if ($useStrategy)
        {
            $this->playRoundWithStrategy();
        }
        else
        {
            $this->playRound();
        }
    }

    /**
     * @return void
     */
    private function playRound() : void
    {
        if ($this->player1->type === $this->player2->defeats)
        {
            $this->score = $this->player2->points + $this->pointsForWinning;
            $this->gameResult = "win";
        }
        else if ($this->player1->defeats === $this->player2->type)
        {
            $this->score = $this->player2->points;
            $this->gameResult = "loose";
        }
        else if ($this->player1->type === $this->player2->type)
        {
            $this->score = $this->player2->points + $this->pointsForDraw;
            $this->gameResult = "draw";
        }
    }

    /**
     * @return void
     */
    private function playRoundWithStrategy() : void
    {
        if ($this->player2->identifier === 'X') // need to loose
        {
            $strategyHand = Hand::getHandByName($this->player1->defeats);
            $this->score = $strategyHand->points;
        }
        else if ($this->player2->identifier === 'Y') // need for draw
        {
            $this->score = $this->player1->points + $this->pointsForDraw;
        }
        else if ($this->player2->identifier === 'Z') // need to win
        {
            $strategyHand = Hand::getHandByName($this->player1->loosesTo);
            $this->score = $strategyHand->points + $this->pointsForWinning;
        }
    }
}