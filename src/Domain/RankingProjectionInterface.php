<?php

declare(strict_types=1);

namespace Cesc\Ranking\Domain;

interface RankingProjectionInterface
{
    public function project(GamerScoreChangedDomainEvent $domainEvent);

    public function queryTop(int $top): array;

    public function queryRelative(int $position, int $around): array;
}