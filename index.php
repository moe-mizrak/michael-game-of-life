<?php

declare(strict_types=1);

require_once 'vendor/autoload.php';

use MichaelGameOfLife\Universe;
use MichaelGameOfLife\Game;
use MichaelGameOfLife\GameTransitionRules;
use MichaelGameOfLife\ConsoleUniversePrinter;
use MichaelGameOfLife\PatternFactory;

function runDemo(): void
{
    $universe = new Universe(25);
    $rules = new GameTransitionRules();
    $game = new Game($universe, $rules);
    $consolePrinter = new ConsoleUniversePrinter();

    // Initialize with glider pattern in the center
    $gliderCells = PatternFactory::createGlider(12, 12);
    $game->initializeWithPattern($gliderCells);

    // Run for 20 generations
    for ($generation = 0; $generation < 20; $generation++) {
        echo "Generation $generation:\n";
        $consolePrinter->print($game->getUniverse());
        $game->nextGeneration();
        usleep(500000);
    }
}

// Run the demo
runDemo();