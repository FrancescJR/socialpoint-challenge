<?php

declare(strict_types=1);

namespace Cesc\Ranking\Tests\Commit\Domain;

use Cesc\Ranking\Domain\Gamer;
use Cesc\Ranking\Domain\PartialScore;
use PHPUnit\Framework\TestCase;

final class GamerTest extends TestCase
{
    public function testSubmitScore():void
    {
        $gamer = new Gamer(
            "id",
            0
        );

        $gamer->submitScore(400);

        self::assertEquals(400, $gamer->score());
    }

    public function testSubmitPartialScore(): void
    {
        $gamer = new Gamer("id", 100);

        $gamer->submitPartialScore(PartialScore::fromString("+30"));
        self::assertEquals(130, $gamer->score());

        $gamer->submitPartialScore(PartialScore::fromString("-30"));
        self::assertEquals(100, $gamer->score());
    }
}