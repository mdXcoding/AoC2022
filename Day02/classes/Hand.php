<?php

namespace classes;

class Hand
{
    /**
     * @var string
     *
     */
    public string $identifier;

    /**
     * @var int
     */
    public int $points;

    /**
     * @var string
     */
    public string $type;

    /**
     * @var string
     */
    public string $defeats;

    /**
     * @var string
     */
    public string $loosesTo;

    /**
     * @param string $identifier
     */
    public function __construct(string $identifier)
    {
        $this->identifier = trim($identifier);
        $this->setHandProperties();
    }

    /**
     * @return void
     */
    private function setHandProperties() : void
    {
        switch($this->identifier)
        {
            case "A":
            case "X":
                $this->points = 1;
                $this->type = "Rock";
                $this->defeats = "Scissors";
                $this->loosesTo = "Paper";
                break;
            case "B":
            case "Y":
                $this->points = 2;
                $this->type = "Paper";
                $this->defeats = "Rock";
                $this->loosesTo = "Scissors";
                break;
            case "C":
            case "Z":
                $this->points = 3;
                $this->type = "Scissors";
                $this->defeats = "Paper";
                $this->loosesTo = "Rock";
                break;
        }
    }

    /**
     * @param string $name
     * @return Hand
     */
    public static function getHandByName(string $name) : Hand
    {
        return new Hand(self::getIdentifierByName($name));
    }

    /**
     * @param string $name
     * @return string
     */
    public static function getIdentifierByName(string $name) : string
    {
        return match ($name) {
            "Rock" => 'A',
            "Paper" => 'B',
            "Scissors" => 'C',
        };
    }
}