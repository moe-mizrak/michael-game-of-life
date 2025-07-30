<?php

declare(strict_types=1);

namespace MichaelGameOfLife;

/**
 * Console printer for the universe.
 * 
 * @class ConsoleUniversePrinter
 */
final class ConsoleUniversePrinter
{
    /**
     * Prints the universe to the console.
     * 
     * @param UniverseInterface $universe
     * 
     * @return void
     */
    public function print(UniverseInterface $universe): void
    {
        $grid = $universe->getAllCells();

        // Loop through the grid and print each cell
        foreach ($grid as $row) {
            foreach ($row as $cell) {
                echo $cell === CellState::ALIVE ? '█' : '·';
            }

            echo PHP_EOL;
        }

        echo PHP_EOL;
    }
}