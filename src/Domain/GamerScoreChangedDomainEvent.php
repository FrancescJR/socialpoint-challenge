<?php

declare(strict_types=1);

namespace Cesc\Ranking\Domain;

final class GamerScoreChangedDomainEvent extends DomainEvent
{
    public function __construct(
        public readonly string $userId,
        public readonly int $userNewScore,
    ) {
        parent::__construct();
    }
}