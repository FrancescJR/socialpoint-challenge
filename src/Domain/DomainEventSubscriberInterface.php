<?php

declare(strict_types=1);

namespace Cesc\Ranking\Domain;

interface DomainEventSubscriberInterface
{
    public function handle(DomainEvent $domainEvent): void;

    public function isSubscribedTo(DomainEvent $domainEvent): bool;
}