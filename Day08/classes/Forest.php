<?php
namespace classes;

Class Forest
{
    /**
     * @var array
     */
    public array $trees = [];

    /**
     * @var Boundary
     */
    public Boundary $boundary;

    /**
     * Create a fancy forest
     */
    public function __construct()
    {
        $file = file("input.txt");
        foreach($file as $y => $line)
        {
            foreach(str_split(trim($line)) as $x => $height)
            {
                $this->trees[$x][$y] = new Tree($x, $y, $height);
            }
        }

        $this->boundary = new Boundary(count($this->trees[0]), count($this->trees));

        $this->checkTreeVisibility();
    }

    /**
     * @return int
     */
    public function getPart1Result() : int
    {
        return array_reduce($this->trees, function($carry, $treeLine) {
            $lineSum = array_reduce($treeLine, function($carry, $tree) {
                return $carry + $tree->visible;
            }, 0);

            $carry += $lineSum;
            return $carry;
        }, 0);
    }

    /**
     * @return int
     */
    public function getPart2Result() : int
    {
        return array_reduce($this->trees, function($carry, $treeLine) {
            $lineTopScore = array_reduce($treeLine, function($carry, $tree) {
                return max($carry, $tree->score);
            }, 0);

            return max($carry, $lineTopScore);
        }, 0);
    }

    /**
     * @return void
     */
    private function checkTreeVisibility() : void
    {
        foreach($this->trees as $x => $treeLine)
        {
            foreach($treeLine as $y => $tree)
            {
                // tree is on the outside
                if ($tree->x === 0 || $tree->y === 0 ||
                    $tree->x === $this->boundary->left || $tree->x === $this->boundary->right ||
                    $tree->y === $this->boundary->top || $tree->y === $this->boundary->bottom)
                {
                    $tree->visible = true;
                    continue;
                }

                // tree is inside lets check its visibility and calculate its score
                $top = $this->getVisibilityToTop($tree);
                $left = $this->getVisibilityToLeft($tree);
                $right = $this->getVisibilityToRight($tree);
                $bottom = $this->getVisibilityToBottom($tree);

                $tree->visible = $top->visible || $bottom->visible || $left->visible || $right->visible;
                $tree->score = $top->score * $bottom->score * $left->score * $right->score;
            }
        }
    }

    /**
     * @param Tree $tree
     * @return VisibilityResult
     */
    private function getVisibilityToTop(Tree $tree) : VisibilityResult
    {
        $score = 0;
        $visible = false;

        for($y = ($tree->y - 1); $y >= $this->boundary->top; $y--)
        {
            $score++;

            if ($tree->height > $this->trees[$tree->x][$y]->height)
            {
                $visible = true;
            }
            else
            {
                return new VisibilityResult(false, $score);
            }
        }

        return new VisibilityResult($visible, $score);
    }

    /**
     * @param Tree $tree
     * @return VisibilityResult
     */
    private function getVisibilityToBottom(Tree $tree) : VisibilityResult
    {
        $score = 0;
        $visible = false;

        for($y = ($tree->y + 1); $y <= $this->boundary->bottom; $y++)
        {
            $score++;

            if ($tree->height > $this->trees[$tree->x][$y]->height)
            {
                $visible = true;
            }
            else
            {
                return new VisibilityResult(false, $score);
            }
        }

        return new VisibilityResult($visible, $score);
    }

    /**
     * @param Tree $tree
     * @return VisibilityResult
     */
    private function getVisibilityToLeft(Tree $tree) : VisibilityResult
    {
        $score = 0;
        $visible = false;

        for($x = ($tree->x - 1); $x >= $this->boundary->left; $x--)
        {
            $score++;

            if ($tree->height > $this->trees[$x][$tree->y]->height)
            {
                $visible = true;
            }
            else
            {
                return new VisibilityResult(false, $score);
            }
        }

        return new VisibilityResult($visible, $score);
    }

    /**
     * @param Tree $tree
     * @return VisibilityResult
     */
    private function getVisibilityToRight(Tree $tree) : VisibilityResult
    {
        $score = 0;
        $visible = false;

        // x = 2 (1+)  right = 4
        for($x = ($tree->x + 1); $x <= $this->boundary->right; $x++)
        {
            $score++;

            if ($tree->height > $this->trees[$x][$tree->y]->height)
            {
                $visible = true;
            }
            else
            {
                return new VisibilityResult(false, $score);
            }
        }

        return new VisibilityResult($visible, $score);
    }
}