<?php

declare(strict_types=1);

namespace Cesc\Ranking\Tests\Commit\Domain;

use Cesc\Ranking\Domain\GamerScoreChangedDomainEvent;
use Cesc\Ranking\Domain\PartialScore;
use PHPUnit\Framework\TestCase;

final class GamerTest extends TestCase
{
    public function testSubmitScore():void
    {
        $gamer = GamerStub::random();

        $gamer->submitScore(400);

        self::assertEquals(400, $gamer->score());
        self::assertCount(1, $gamer->domainEvents());
        self::assertEquals(
            GamerScoreChangedDomainEvent::class,
        get_class($gamer->domainEvents()[0])
        );
    }

    public function testSubmitPartialScore(): void
    {
        $gamer = GamerStub::withScore(100);

        $gamer->submitPartialScore(PartialScore::fromString("+30"));
        self::assertEquals(130, $gamer->score());

        self::assertCount(1, $gamer->domainEvents());
        self::assertEquals(
            GamerScoreChangedDomainEvent::class,
            get_class($gamer->domainEvents()[0])
        );

        $gamer->submitPartialScore(PartialScore::fromString("-30"));
        self::assertEquals(100, $gamer->score());
    }
}