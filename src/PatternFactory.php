<?php

declare(strict_types=1);

namespace MichaelGameOfLife;

/**
 * Factory class for creating patterns.
 * 
 * @class PatternFactory
 */
final class PatternFactory
{
    /**
     * Creates a glider pattern centered at the given coordinates.
     * 
     * @param int $centerX
     * @param int $centerY
     * 
     * @return CellPosition[]
     */
    public static function createGlider(int $centerX, int $centerY): array
    {
        return [
            new CellPosition($centerX + 1, $centerY),
            new CellPosition($centerX + 2, $centerY + 1),
            new CellPosition($centerX, $centerY + 2),
            new CellPosition($centerX + 1, $centerY + 2),
            new CellPosition($centerX + 2, $centerY + 2),
        ];
    }
}