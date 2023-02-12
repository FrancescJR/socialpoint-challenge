<?php

declare(strict_types=1);

namespace Cesc\Ranking\Infrastructure\Persistence;

use Cesc\Ranking\Domain\GamerScoreChangedDomainEvent;
use Cesc\Ranking\Domain\RankingProjectionInterface;
use DateTimeImmutable;

final class InMemoryRankingProjection implements RankingProjectionInterface
{
    private array $ranking = [];
    private ?DateTimeImmutable $lastUpdatedAt = null;

    public function project(GamerScoreChangedDomainEvent $domainEvent)
    {
        $this->ranking[] = ["userId" => $domainEvent->userId, "score" => $domainEvent->userNewScore];

        usort($this->ranking, function($userA, $userB) {
            if($userA['score'] === $userB ['score']) return 0;
            return $userA['score'] >= $userB ['score']? -1:1;
        });
        $this->updateRanking();
        $this->lastUpdatedAt = $domainEvent->occurredAt;
    }

    private function updateRanking() {
        $ranking = 1;
        foreach($this->ranking as $position => $gameRankingView) {
            $this->ranking[$position]['ranking'] = $ranking;
            $ranking++;
        }
    }

    public function queryTop(int $top): array
    {
        return array_slice($this->ranking, 0, min(count($this->ranking), $top));
    }

    public function queryRelative(int $position, int $around): array
    {
        return array_slice($this->ranking, $position - ($around +1), $around * 2 + 1, true);
    }
}