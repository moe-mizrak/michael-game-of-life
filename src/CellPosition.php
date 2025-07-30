<?php

declare(strict_types=1);

namespace MichaelGameOfLife;

/**
 * Represents the value object of a cell position in the 2D game universe.
 * 
 * @class CellPosition
 */
final readonly class CellPosition
{
    public function __construct(public int $x, public int $y) {}
}