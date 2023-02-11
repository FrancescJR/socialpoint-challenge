<?php

declare(strict_types=1);

namespace Cesc\Ranking\Domain;

use Exception;

final class PartialScore
{
    private function __construct(
        public readonly PartialScoreOperand $operand,
        public readonly int $value
    ) {
    }

    public static function fromString(string $string): self
    {
        if (strlen($string) < 2) {
            throw new InvalidPartialScoreException("partial score must have an operand and a number");
        }
        $operand = PartialScoreOperand::fromString(substr($string, 0, 1));
        $tentativeValue = (substr($string, 1));
        if (!is_numeric($tentativeValue)) {
            throw new InvalidPartialScoreException("Value after the operand must be a number");
        }
        try {
            $value = (int)$tentativeValue;
        } catch (Exception) {
            throw new InvalidPartialScoreException("Value after the operand can\'t be understood");
        }
        return new self($operand, $value);
    }

    public function modifyScore(int $initialScore): int
    {
        return $initialScore;
    }
}