<?php

declare(strict_types=1);

namespace Cesc\Ranking\Application;

use Cesc\Ranking\Domain\CalculateNewAbsoluteScore;
use Cesc\Ranking\Domain\CalculateNewRelativeScore;
use Cesc\Ranking\Domain\CalculateNewScoreStrategyInterface;
use Cesc\Ranking\Domain\Gamer;
use Cesc\Ranking\Domain\GamerNotFoundException;
use Cesc\Ranking\Domain\GamerRepositoryInterface;

final class SubmitScoreCommandHandler
{
    public function __construct(private GamerRepositoryInterface $repository)
    {
    }

    /**
     * @param SubmitScoreCommand $command
     * @return void
     * @throws GamerNotFoundException
     */
    public function __invoke(SubmitScoreCommand $command): void
    {
        if (!$gamer = $this->repository->findById($command->userId)) {
            throw new GamerNotFoundException("Gamer with Id" . $command->userId . " not found");
        }
        $strategy = $this->chooseStrategy($command, $gamer);
        $gamer->submitScore($strategy);
        $this->repository->add($gamer);
    }

    private function chooseStrategy(SubmitScoreCommand $command, Gamer $gamer): CalculateNewScoreStrategyInterface
    {
        if (!is_numeric($command->newScore)) {
            return new CalculateNewRelativeScore(
                $gamer->score(),
                $command->newScore
            );
        }
        return new CalculateNewAbsoluteScore($command->newScore);
    }
}