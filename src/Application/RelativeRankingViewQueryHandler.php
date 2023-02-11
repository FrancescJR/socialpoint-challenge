<?php

namespace Cesc\Ranking\Application;

use Cesc\Ranking\Domain\RankingProjectionInterface;

final class RelativeRankingViewQueryHandler
{
    public function __construct(
        private RankingProjectionInterface $projection
    ) {
    }

    public function __invoke(RelativeRankingViewQuery $query): array
    {
        return $this->projection->queryRelative($query->position, $query->around);
    }
}