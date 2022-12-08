<?php

namespace classes;

Class Boundary
{
    /**
     * @var int
     */
    public int $top;

    /**
     * @var int
     */
    public int $bottom;

    /**
     * @var int
     */
    public int $left;

    /**
     * @var int
     */
    public int $right;

    /**
     * @param int $width
     * @param int $height
     */
    public function __construct(int $width, int $height)
    {
        $this->top = 0;
        $this->left = 0;
        $this->right = $width - 1;
        $this->bottom = $height - 1;
    }
}