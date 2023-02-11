<?php

declare(strict_types=1);

namespace Cesc\Ranking\Domain;

use Cesc\Ranking\Application\RelativeRankingViewQuery;
use Cesc\Ranking\Application\TopRankingViewQuery;

interface RankingProjectionInterface
{
    public function project(GamerScoreChangedDomainEvent $domainEvent);

    public function queryTop(int $top): array;

    public function queryRelative(int $position, int $around): array;
}