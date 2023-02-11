<?php

declare(strict_types=1);

namespace Cesc\Ranking\Application;

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
//     * @throws GamerNotFoundException
     */
    public function __invoke(SubmitScoreCommand $command): void
    {
        if (!$gamer = $this->repository->findById($command->userId)) {
//            throw new GamerNotFoundException("Gamer with Id" . $command->userId . " not found");
            $gamer = Gamer::generateGamer($command->userId);
        }

        $gamer->submitScore($command->newScore);
        $this->repository->add($gamer);
    }
}