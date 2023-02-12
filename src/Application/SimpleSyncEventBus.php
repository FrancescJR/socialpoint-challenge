<?php

declare(strict_types=1);

namespace Cesc\Ranking\Application;

use Cesc\Ranking\Domain\DomainEventSubscriberInterface;
use Cesc\Ranking\Domain\EventBusInterface;
use Exception;

class SimpleSyncEventBus implements EventBusInterface
{
    private array $subscribers = [];
    private static ?SimpleSyncEventBus $instance = null;

    // singleton pattern
    public static function instance(): self
    {
        if (null === static::$instance) {
            static::$instance = new static();
        }
        return static::$instance;
    }

    // singleton pattern
    public function __clone()
    {
        throw new Exception(
            'Clone is not supported'
        );
    }

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