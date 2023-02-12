<?php

declare(strict_types=1);

namespace Cesc\Ranking\Domain;

use DateTimeImmutable;

abstract class DomainEvent
{
    public readonly DateTimeImmutable $occurredAt;

    public function __construct()
    {
        $this->occurredAt = new DateTimeImmutable();
    }
}