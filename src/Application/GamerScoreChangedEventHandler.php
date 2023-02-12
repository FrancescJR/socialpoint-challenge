<?php

declare(strict_types=1);

namespace Cesc\Ranking\Application;

use Cesc\Ranking\Domain\DomainEvent;
use Cesc\Ranking\Domain\DomainEventSubscriberInterface;
use Cesc\Ranking\Domain\GamerScoreChangedDomainEvent;
use Cesc\Ranking\Domain\RankingProjectionInterface;

final class GamerScoreChangedEventHandler implements DomainEventSubscriberInterface
{
    public function __construct(private RankingProjectionInterface $projection)
    {
        SimpleSyncEventBus::instance()->subscribe($this);
    }

    public function handle(DomainEvent $domainEvent): void
    {
        $this->projection->project($domainEvent);
    }

    public function isSubscribedTo(DomainEvent $domainEvent): bool
    {
        return GamerScoreChangedDomainEvent::class === get_class($domainEvent);
    }
}