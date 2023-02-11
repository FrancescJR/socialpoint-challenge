<?php

declare(strict_types=1);

namespace Cesc\Ranking\Tests\Commit\Domain;

use Cesc\Ranking\Domain\CalculateNewScoreStrategyInterface;
use Cesc\Ranking\Domain\GamerScoreChangedDomainEvent;
use PHPUnit\Framework\TestCase;

final class GamerTest extends TestCase
{
    public function testSubmitScore():void
    {
        $gamer = GamerStub::random();
        $calculatedNewScore = 500;
        $calculateStrategy = self::createMock(CalculateNewScoreStrategyInterface::class);
        $calculateStrategy->method('newScore')->willReturn(500);

        $gamer->submitScore($calculateStrategy);
        self::assertEquals($calculatedNewScore, $gamer->score());
        self::assertCount(1, $gamer->domainEvents());
        self::assertEquals(
            GamerScoreChangedDomainEvent::class,
        get_class($gamer->domainEvents()[0])
        );
    }
}