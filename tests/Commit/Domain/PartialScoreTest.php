<?php

declare(strict_types=1);

namespace Cesc\Ranking\Tests\Commit\Domain;

use Cesc\Ranking\Domain\InvalidPartialScoreException;
use Cesc\Ranking\Domain\PartialScore;
use PHPUnit\Framework\TestCase;

final class PartialScoreTest extends TestCase
{
    public function testValid(): void
    {
        $partialScore = PartialScore::fromString("+20");
        self::assertEquals("+", $partialScore->operand->value);
        self::assertEquals(20, $partialScore->value);
    }

    public function testInvalidEmptyString(): void
    {
        self::expectException(InvalidPartialScoreException::class);
        PartialScore::fromString("");
    }

    public function testInvalidMissingValue(): void
    {
        self::expectException(InvalidPartialScoreException::class);
        PartialScore::fromString("+");
    }

    public function testInvalidNonNumber(): void
    {
        self::expectException(InvalidPartialScoreException::class);
        PartialScore::fromString("+++");
    }

    public function testInvalidNonNumber2(): void
    {
        self::expectException(InvalidPartialScoreException::class);
        PartialScore::fromString("+300+");
    }

    public function testModifyScore(): void
    {

        $partialScore = PartialScore::fromString("+60");
        self::assertEquals(80, $partialScore->applyTo(20));
        self::assertEquals(90, $partialScore->applyTo(30));

        $partialScore = PartialScore::fromString("-60");
        self::assertEquals(-20, $partialScore->applyTo(40));
    }

}