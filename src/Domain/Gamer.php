<?php

declare(strict_types=1);

namespace Cesc\Ranking\Domain;

final class Gamer
{
    public function __construct(
        public readonly string $id,
        private int $score
    ) {
    }

    public function score():int
    {
        return $this->score;
    }

    public function submitScore(int $newScore): void
    {
        $this->score = $newScore;
    }

    public function submitPartialScore(PartialScore $partialScore): void
    {
        $this->score = $partialScore->modifyScore($this->score);
    }
}