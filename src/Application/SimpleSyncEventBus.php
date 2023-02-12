<?php

declare(strict_types=1);

namespace Cesc\Ranking\Application;

use Cesc\Ranking\Domain\DomainEventSubscriberInterface;
use Cesc\Ranking\Domain\EventBusInterface;

class SimpleSyncEventBus implements EventBusInterface
{
    private array $subscribers = [];

    public function subscribe(
        DomainEventSubscriberInterface $domainEventSubscriber
    ): void {
        $this->subscribers[] = $domainEventSubscriber;
    }

    public function publish(array $domainEvents): void
    {
        foreach ($domainEvents as $event) {
            foreach ($this->subscribers as $aSubscriber) {
                if ($aSubscriber->isSubscribedTo($event)) {
                    $aSubscriber->handle($event);
                }
            }
        }
    }
}