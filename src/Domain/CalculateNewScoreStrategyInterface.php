<?php

declare(strict_types=1);

namespace Cesc\Ranking\Domain;

interface CalculateNewScoreStrategyInterface
{
    public function newScore(): int;

}