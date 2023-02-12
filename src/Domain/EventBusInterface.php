<?php

declare(strict_types=1);

namespace Cesc\Ranking\Domain;

interface EventBusInterface
{
    /**
     * @param DomainEvent[] $domainEvents
     * @return void
     */
    public function publish(array $domainEvents): void;
}