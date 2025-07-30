<?php

declare(strict_types=1);

namespace MichaelGameOfLife;

/**
 * Represents the Game of Life.
 * 
 * @class Game
 */
final class Game
{
    public function __construct(
        private UniverseInterface $universe,
        private readonly GameTransitionRules $rules
    ) {}

    /**
     * Initializes the universe with a given pattern of alive cells.
     * (The "seed" of the system)
     * 
     * @param CellPosition[] $aliveCells
     * 
     * @return void
     */
    public function initializeWithPattern(array $aliveCells): void
    {
        foreach ($aliveCells as $position) {
            $this->universe->setCell($position, CellState::ALIVE);
        }
    }

    /**
     * Advances the game to the next generation based on the rules (a "tick").
     * 
     * @return void
     */
    public function nextGeneration(): void
    {
        $size = $this->universe->getSize();
        $newUniverse = new Universe($size);

        // Loop through each cell in the universe and apply the rules
        for ($y = 0; $y < $size; $y++) {
            for ($x = 0; $x < $size; $x++) {
                $position = new CellPosition($x, $y);
                $nextState = $this->rules->getNextState($position, $this->universe);
                $newUniverse->setCell($position, $nextState);
            }
        }

        // Update the universe to the new state (the "tick")
        $this->universe = $newUniverse;
    }

    /**
     * Gets the current universe.
     * 
     * @return UniverseInterface
     */
    public function getUniverse(): UniverseInterface
    {
        return $this->universe;
    }
}