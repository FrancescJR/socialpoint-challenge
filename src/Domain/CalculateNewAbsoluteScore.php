<?php

declare(strict_types=1);

namespace Cesc\Ranking\Domain;

final class CalculateNewAbsoluteScore implements CalculateNewScoreStrategyInterface
{
    public function __construct(private readonly int $newScore)
    {
    }

    public function newScore(): int
    {
        return $this->newScore;
    }
}