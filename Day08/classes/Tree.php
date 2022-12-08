<?php
namespace classes;

Class Tree
{
    /**
     * @var int
     */
    public int $x;

    /**
     * @var int
     */
    public int $y;

    /**
     * @var int
     */
    public int $height;

    /**
     * @var bool
     */
    public bool $visible = false;

    /**
     * @var int
     */
    public int $score = 0;

    /**
     * @param int $x
     * @param int $y
     * @param int $height
     */
    public function __construct(int $x, int $y, int $height)
    {
        $this->x = $x;
        $this->y = $y;
        $this->height = $height;
    }
}