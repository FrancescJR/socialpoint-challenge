<?php

declare(strict_types=1);

namespace Cesc\Ranking\Domain;

final class CalculateNewRelativeScore implements CalculateNewScoreStrategyInterface
{
    public function __construct(
        private readonly int $initialScore,
        private readonly string $partialScore)
    {

    }
    public function newScore(): int
    {
        $partialScore = PartialScore::fromString($this->partialScore);
        return $partialScore->applyTo($this->initialScore);
    }
}