<?php

declare(strict_types=1);

namespace MichaelGameOfLife;

/**
 * Each cell can be either DEAD or ALIVE.
 * 
 * @enum CellState
 */
enum CellState: int
{
    // This represents a dead cell as integer value 0.
    case DEAD = 0;

    // This represents an alive cell as integer value 1.
    case ALIVE = 1;
}