<?php

declare(strict_types=1);

namespace MichaelGameOfLife\Tests;

use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Attributes\Test;
use MichaelGameOfLife\CellPosition;
use MichaelGameOfLife\CellState;
use MichaelGameOfLife\Universe;

final class MichaelGameOfLifeTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
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
}