<?php

namespace classes;

Class VisibilityResult
{
    /**
     * @var int
     */
    public int $score;

    /**
     * @var bool
     */
    public bool $visible;

    /**
     * @param bool $visible
     * @param int $score
     */
    public function __construct(bool $visible, int $score)
    {
        $this->visible = $visible;
        $this->score = $score;
    }
}