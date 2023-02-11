<?php

declare(strict_types=1);

namespace Cesc\Ranking\Domain;

use Exception;

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

    public static function incrementOperand(): self
    {
        return new self(self::INCREMENT);
    }

    public static function decrementOperand (): self
    {
        return new self(self::DECREMENT);
    }

    public function operate(int $initial, int $modification): int
    {
        return match ($this->value) {
            self::INCREMENT => $initial + $modification,
            self::DECREMENT => $initial - $modification,
            default => throw new Exception("Operation not implemented."),
        };
    }
}