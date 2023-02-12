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
        $this->ranking[$domainEvent->userId] = ["userId" => $domainEvent->userId, "score" => $domainEvent->userNewScore];

        usort($this->ranking, function($userA, $userB) {
           if ($userA['score'] >= $userB ['score']) {
               return $userA;
           }
           return $userB;
        });

        $this->updatePositions();

        $this->lastUpdatedAt = $domainEvent->occurredAt;
    }

    private function updatePositions() {
        $position = 1;
        foreach($this->ranking as $gameRankingView) {
            $gameRankingView['ranking'] = $position;
            $position++;
        }
    }

    public function queryTop(int $top): array
    {
        return array_slice($this->ranking, 0, min(count($this->ranking), $top));
    }

    public function queryRelative(int $position, int $around): array
    {
        // TODO: Implement queryRelative() method.
    }
}