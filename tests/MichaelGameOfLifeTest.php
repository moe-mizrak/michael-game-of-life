<?php

declare(strict_types=1);

namespace MichaelGameOfLife\Tests;

use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Attributes\Test;
use MichaelGameOfLife\CellPosition;
use MichaelGameOfLife\CellState;
use MichaelGameOfLife\Universe;
use MichaelGameOfLife\GameTransitionRules;

final class MichaelGameOfLifeTest extends TestCase
{
    private GameTransitionRules $rules;
    private Universe $universe;

    public function setUp(): void
    {
        parent::setUp();

        $this->rules = new GameTransitionRules();
        $this->universe = new Universe(25);
    }

    /**
     * Tests for the Universe
     */
    #[Test]
    public function it_creates_a_universe_with_given_size(): void
    {
        /* SETUP */
        $universe = new Universe(10);

        /* ASSERT */
        $this->assertEquals(10, $universe->getSize());
    }

    #[Test]
    public function it_initializes_universe_with_all_dead_cells(): void
    {
        /* SETUP */
        $universe = new Universe(3);
        $position = new CellPosition(1, 1);

        /* EXECUTE */
        $cellState = $universe->getCell($position);

        /* ASSERT */
        $this->assertEquals(CellState::DEAD, $cellState);
    }

    #[Test]
    public function it_can_set_and_get_cell_state(): void
    {
        /* SETUP */
        $universe = new Universe(5);
        $position = new CellPosition(2, 3);

        /* EXECUTE */
        $universe->setCell($position, CellState::ALIVE);
        $cellState = $universe->getCell($position);

        /* ASSERT */
        $this->assertEquals(CellState::ALIVE, $cellState);
    }

    /**
     * Tests for Game Transition Rules
     */
    #[Test]
    public function it_kills_live_cell_with_fewer_than_two_neighbors(): void
    {
        /* SETUP */
        $center = new CellPosition(2, 2);
        $neighbor = new CellPosition(2, 1);
    
        $this->universe->setCell($center, CellState::ALIVE);
        $this->universe->setCell($neighbor, CellState::ALIVE);

        /* EXECUTE */
        $nextState = $this->rules->getNextState($center, $this->universe);

        /* ASSERT */
        $this->assertEquals(CellState::DEAD, $nextState);
    }

    #[Test]
    public function it_keeps_live_cell_with_two_neighbors_alive(): void
    {
        /* SETUP */
        $center = new CellPosition(2, 2);
        
        $this->universe->setCell($center, CellState::ALIVE);
        $this->universe->setCell(new CellPosition(1, 2), CellState::ALIVE);
        $this->universe->setCell(new CellPosition(3, 2), CellState::ALIVE);

        /* EXECUTE */
        $nextState = $this->rules->getNextState($center, $this->universe);

        /* ASSERT */
        $this->assertEquals(CellState::ALIVE, $nextState);
    }

    #[Test]
    public function it_brings_dead_cell_to_life_with_three_neighbors(): void
    {
        /* SETUP */
        $center = new CellPosition(2, 2);
        
        $this->universe->setCell(new CellPosition(1, 2), CellState::ALIVE);
        $this->universe->setCell(new CellPosition(3, 2), CellState::ALIVE);
        $this->universe->setCell(new CellPosition(2, 1), CellState::ALIVE);

        /* EXECUTE */
        $nextState = $this->rules->getNextState($center, $this->universe);

        /* ASSERT */
        $this->assertEquals(CellState::ALIVE, $nextState);
    }
}