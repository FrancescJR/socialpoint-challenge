<?php

declare(strict_types=1);

namespace Cesc\Ranking\Infrastructure\Persistence;

use Cesc\Ranking\Domain\GamerScoreChangedDomainEvent;
use Cesc\Ranking\Domain\RankingProjectionInterface;

final class InMemoryRankingProjection implements RankingProjectionInterface
{
    public function project(GamerScoreChangedDomainEvent $domainEvent)
    {
        // TODO: Implement project() method.
    }

    public function queryTop(int $top): array
    {
        // TODO: Implement queryTop() method.
    }

    public function queryRelative(int $position, int $around): array
    {
        // TODO: Implement queryRelative() method.
    }
}