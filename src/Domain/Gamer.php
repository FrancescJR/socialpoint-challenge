<?php

declare(strict_types=1);

namespace Cesc\Ranking\Domain;

final class Gamer
{
    public function __construct(
        public readonly string $id,
        private int $score,
        private array $domainEvents
    ) {
    }

    public function score():int
    {
        return $this->score;
    }

    public function domainEvents(): array
    {
        return $this->domainEvents;
    }

    public function submitScore(CalculateNewScoreStrategyInterface $submitScoreStrategy): void
    {
        $newScore = $submitScoreStrategy->newScore();
        $this->score = $newScore;
        $this->domainEvents[] = new GamerScoreChangedDomainEvent(
            $this->id,
            $this->score
        );
    }
}