<?php

declare(strict_types=1);

namespace Cesc\Ranking\Tests\Commit\Domain;

use Cesc\Ranking\Domain\Gamer;
use Faker\Factory;

final class GamerStub
{
    public static function random (): Gamer
    {
        return new Gamer(
            (Factory::create())->name(),
            (Factory::create())->randomNumber(3),
            []
        );
    }

    public static function withScore (int $score): Gamer
    {
        return new Gamer(
            (Factory::create())->name(),
            $score,
            []
        );
    }

}