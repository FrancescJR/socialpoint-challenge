<?php

declare(strict_types=1);

namespace Cesc\Ranking\Tests\Commit\Domain;

use Cesc\Ranking\Domain\CalculateNewScoreStrategyInterface;
use Cesc\Ranking\Domain\GamerScoreChangedDomainEvent;
use Cesc\Ranking\Domain\InvalidPartialScoreException;
use PHPUnit\Framework\TestCase;

final class GamerTest extends TestCase
{
    public function testSubmitScore():void
    {
        $gamer = GamerStub::random();
        $gamer->submitScore("500");
        self::assertEquals(500, $gamer->score());
        self::assertCount(1, $gamer->domainEvents());
        self::assertEquals(
            GamerScoreChangedDomainEvent::class,
            get_class($gamer->domainEvents()[0])
        );

        $gamer->submitScore("+500");
        self::assertEquals(1000, $gamer->score());
    }

    public function testInvalidScoreUpdate(): void
    {
        $gamer = GamerStub::random();
        $gamer->submitScore("500");
        $gamer->submitScore("-400");
        self::assertEquals(100, $gamer->score());
        self::expectException(InvalidPartialScoreException::class);
        $gamer->submitScore("-400*&");
    }
}