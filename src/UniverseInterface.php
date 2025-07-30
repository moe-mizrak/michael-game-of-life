<?php

declare(strict_types=1);

namespace MichaelGameOfLife;

/**
 * Interface for the 2D universe
 * 
 * @interface UniverseInterface
 */
interface UniverseInterface
{
    public function getCell(CellPosition $position): CellState;
    public function setCell(CellPosition $position, CellState $state): void;
    public function getSize(): int;
    public function getAllCells(): array;
}