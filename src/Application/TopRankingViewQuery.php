<?php

declare(strict_types=1);

namespace Cesc\Ranking\Application;

final class TopRankingViewQuery implements RankingViewQuery
{
    public function __construct(
        public readonly int $top
    ) {
    }
}