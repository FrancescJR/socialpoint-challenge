<?php

declare(strict_types=1);

namespace Cesc\Ranking\Tests\Commit\Domain;

use Cesc\Ranking\Domain\CalculateNewAbsoluteScore;
use PHPUnit\Framework\TestCase;

final class CalculateNewAbsoluteScoreTest extends TestCase
{
    public function testCalculate(): void
    {
        $strategy = new CalculateNewAbsoluteScore(50);
        self::assertEquals(50, $strategy->newScore());
    }
}