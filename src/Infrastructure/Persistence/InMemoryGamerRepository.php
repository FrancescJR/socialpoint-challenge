<?php

declare(strict_types=1);

namespace Cesc\Ranking\Infrastructure\Persistence;

use Cesc\Ranking\Domain\Gamer;
use Cesc\Ranking\Domain\GamerRepositoryInterface;

final class InMemoryGamerRepository implements GamerRepositoryInterface
{
    private array $inMemoryUsers = [];

    public function findById(string $id): ?Gamer
    {
        if (array_key_exists($id, $this->inMemoryUsers)) {
            return $this->inMemoryUsers[$id];
        }
        return null;
    }

    public function add(Gamer $gamer): void
    {
        $this->inMemoryUsers[$gamer->id] = $gamer;
    }
}