<?php

declare(strict_types=1);

namespace Cesc\Ranking\Tests\Commit\Domain;

use Cesc\Ranking\Domain\InvalidPartialScoreOperandException;
use Cesc\Ranking\Domain\PartialScoreOperand;
use PHPUnit\Framework\TestCase;

final class PartialScoreOperandTest extends TestCase
{
    public function testValid(): void
    {
        $operand = PartialScoreOperand::fromString(PartialScoreOperand::INCREMENT);
        self::assertEquals(PartialScoreOperand::INCREMENT, $operand->value);
    }

    public function testInvalid(): void
    {
        self::expectException(InvalidPartialScoreOperandException::class);
        PartialScoreOperand::fromString("*");
    }

}