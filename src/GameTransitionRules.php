<?php

declare(strict_types=1);

namespace MichaelGameOfLife;

/**
 * Game transition rules for the Game of Life.
 * 
 * @class GameTransitionRules
 */
final class GameTransitionRules
{
    /**
     * Neighbor offsets for the 8 surrounding cells (cells that are horizontally, vertically, or diagonally adjacent).
     * 
     * @var array<int, array<int, int>>
     */
    private const NEIGHBOR_OFFSETS = [
        [-1, -1], [-1, 0], [-1, 1],
        [0, -1],           [0, 1],
        [1, -1],  [1, 0],  [1, 1],
    ];

    /**
     * Returns the next state of a cell based on its current state and the states of its neighbors.
     * 
     * @param CellPosition $position
     * @param UniverseInterface $universe
     * 
     * @return CellState
     */
    public function getNextState(CellPosition $position, UniverseInterface $universe): CellState
    {
        $currentState = $universe->getCell($position);
        $liveNeighbors = $this->countALiveNeighbors($position, $universe);

        /*
         * Transition rules:
         * 1. Any live cell with fewer than two live neighbors dies as if caused by underpopulation.
         * 2. Any live cell with two or three live neighbors lives on to the next generation.
         * 3. Any live cell with more than three live neighbors dies, as if by overcrowding.
         * 4. Any dead cell with exactly three live neighbors becomes a live cell, as if by reproduction.
         */
        return match (true) {
            $currentState === CellState::ALIVE && $liveNeighbors < 2 => CellState::DEAD,
            $currentState === CellState::ALIVE && ($liveNeighbors === 2 || $liveNeighbors === 3) => CellState::ALIVE,
            $currentState === CellState::ALIVE && $liveNeighbors > 3 => CellState::DEAD,
            $currentState === CellState::DEAD && $liveNeighbors === 3 => CellState::ALIVE,
            default => $currentState
        };
    }

    /**
     * Counts the number of alive neighbors for a given cell position.
     * 
     * @param CellPosition $position
     * @param UniverseInterface $universe
     * 
     * @return int
     */
    private function countALiveNeighbors(CellPosition $position, UniverseInterface $universe): int
    {
        $count = 0;

        // Iterate through each neighbor offset and check if the neighbor cell is alive
        foreach (self::NEIGHBOR_OFFSETS as [$dx, $dy]) {
            $neighborPosition = new CellPosition($position->x + $dx, $position->y + $dy);

            if ($universe->getCell($neighborPosition) === CellState::ALIVE) {
                $count++;
            }
        }

        return $count;
    }
}