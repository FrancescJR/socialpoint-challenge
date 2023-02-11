<?php

declare(strict_types=1);

namespace Cesc\Ranking\Application;

final class SubmitPartialScoreCommand
{
    public function __construct(
        public readonly string $userId,
        public readonly string $partialScoreString
    ) {
    }
}