<?php

declare(strict_types=1);

namespace Cesc\Ranking\Domain;

final class PartialScoreOperand
{
    public const INCREMENT = "+";
    public const DECREMENT = "-";
    public const ALLOWED_VALUES = [
        self::INCREMENT,
        self::DECREMENT
    ];

    private function __construct(public readonly string $value)
    {
    }

    public static function fromString(string $value): self
    {
        if (!in_array($value, self::ALLOWED_VALUES)) {
            throw new InvalidPartialScoreOperandException("Operand must be either + or -");
        }
        return new self($value);
    }
}