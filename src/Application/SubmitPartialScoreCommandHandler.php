<?php

declare(strict_types=1);

namespace Cesc\Ranking\Application;

use Cesc\Ranking\Domain\GamerNotFoundException;
use Cesc\Ranking\Domain\GamerRepositoryInterface;
use Cesc\Ranking\Domain\InvalidPartialScoreException;
use Cesc\Ranking\Domain\PartialScore;

final class SubmitPartialScoreCommandHandler
{
    public function __construct(private GamerRepositoryInterface $repository
    ) {
    }

    /**
     * @param SubmitPartialScoreCommand $command
     * @return void
     * @throws GamerNotFoundException
     * @throws InvalidPartialScoreException
     */
    public function __invoke(SubmitPartialScoreCommand $command): void
    {
        if (!$gamer = $this->repository->findById($command->userId)) {
            throw new GamerNotFoundException("Gamer with Id" . $command->userId . " not found");
        }
        $gamer->submitPartialScore(PartialScore::fromString($command->partialScoreString));
        $this->repository->add($gamer);
    }
}