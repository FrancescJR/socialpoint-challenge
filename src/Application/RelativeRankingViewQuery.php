<?php

declare(strict_types=1);

namespace Cesc\Ranking\Application;

final class RelativeRankingViewQuery implements  RankingViewQuery
{
    public function __construct(
        public readonly int $position,
        public readonly int $around
    ) {
    }
}