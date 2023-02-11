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

    public static function generateGamer(string $id): self
    {
        return new self($id, 0, []);
    }

    public function score():int
    {
        return $this->score;
    }

    public function domainEvents(): array
    {
        return $this->domainEvents;
    }

    public function submitScore(string $newScore): void
    {
        $strategy = $this->chooseStrategy($newScore);
        $newScore = $strategy->newScore();
        $this->score = $newScore;
        $this->domainEvents[] = new GamerScoreChangedDomainEvent(
            $this->id,
            $this->score
        );
    }

    private function chooseStrategy(string $newScore):CalculateNewScoreStrategyInterface
    {
        if (!ctype_digit($newScore)) {
            return new CalculateNewRelativeScore(
                $this->score(),
                $newScore
            );
        }
        return new CalculateNewAbsoluteScore((int) $newScore);
    }
}