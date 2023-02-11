<?php

declare(strict_types=1);

namespace Cesc\Ranking\Tests\Commit\Domain;

use Cesc\Ranking\Domain\CalculateNewRelativeScore;
use PHPUnit\Framework\TestCase;

final class CalculateNewRelativeScoreTest extends TestCase
{
    public function testCalculate(): void
    {
        $strategy = new CalculateNewRelativeScore(50, "+50");
        self::assertEquals(100, $strategy->newScore());
    }

}