<?php

declare(strict_types=1);

namespace MichaelGameOfLife;

/**
 * 2D grid universe implementation
 * 
 * @class Universe
 */
final class Universe implements UniverseInterface
{
    private array $grid;

    public function __construct(private readonly int $size)
    {
        $this->initializeGrid();
    }

    /**
     * Initializes the grid with dead cells with the given size (square universe).
     * todo: It can accept height and width as parameters to create a rectangular universe.
     * @return void
     */
    private function initializeGrid(): void
    {
        $this->grid = array_fill(0, $this->size, 
            array_fill(0, $this->size, CellState::DEAD)
        );
    }

    /**
     * Getter for the cell at the given position.
     * 
     * @param CellPosition $position
     * 
     * @return CellState
     */
    public function getCell(CellPosition $position): CellState
    {
        if ($this->isValidPosition($position)) {
            return $this->grid[$position->y][$position->x];
        }
        
        // Default cell state is DEAD for out of bounds positions.
        return CellState::DEAD;
    }

    /**
     * Setter for the cell at the given position.
     * 
     * @param CellPosition $position
     * @param CellState $state
     * 
     * @return void
     */
    public function setCell(CellPosition $position, CellState $state): void
    {
        // Check if the position is valid before setting the cell state
        if ($this->isValidPosition($position)) {
            // Set the cell state at the specified position and given state
            $this->grid[$position->y][$position->x] = $state;
        }
    }

    /**
     * Getter for the size of the universe.
     * 
     * @return int
     */
    public function getSize(): int
    {
        return $this->size;
    }

    /**
     * Getter for all cells in the universe.
     * 
     * @return array
     */
    public function getAllCells(): array
    {
        return $this->grid;
    }

    /**
     * Checks if the given position is valid within the universe bounds.
     * 
     * @param CellPosition $position
     * 
     * @return bool
     */
    private function isValidPosition(CellPosition $position): bool
    {
        return $position->x >= 0 && $position->x < $this->size && 
            $position->y >= 0 && $position->y < $this->size;
    }
}