<?php

declare(strict_types=1);

namespace Cesc\Ranking\Application;

use Cesc\Ranking\Domain\RankingProjectionInterface;

final class TopRankingViewQueryHandler
{
    public function __construct(
        private RankingProjectionInterface $projection
    ) {
    }

    public function __invoke(TopRankingViewQuery $query): array
    {
        return $this->projection->queryTop($query->top);
    }
}