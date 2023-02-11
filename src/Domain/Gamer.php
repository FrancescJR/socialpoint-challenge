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

    private function setScore(int $newScore): void
    {
        $this->score = $newScore;
        $this->domainEvents[] = new GamerScoreChangedDomainEvent(
            $this->id,
            $this->score
        );
    }

    public function submitScore(int $newScore): void
    {
       $this->setScore($newScore);
    }

    public function submitPartialScore(PartialScore $partialScore): void
    {
        $newScore =  $partialScore->applyTo($this->score);
        $this->setScore($newScore);
    }
}