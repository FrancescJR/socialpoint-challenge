<?php

declare(strict_types=1);

namespace Cesc\Ranking\Domain;

interface GamerRepositoryInterface
{
    public function findById(string $id) :?Gamer;

    public function add(Gamer $gamer): void;
}