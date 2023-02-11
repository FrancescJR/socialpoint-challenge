<?php

declare(strict_types=1);

namespace Cesc\Ranking\Application;

final class SubmitScoreCommand
{
    public function __construct(
        public readonly string $userId,
        public readonly int $newScore
    ) {
    }
}