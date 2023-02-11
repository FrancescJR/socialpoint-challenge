<?php

declare(strict_types=1);

namespace Cesc\Ranking\Infrastructure\API;

use Cesc\Ranking\Application\SubmitScoreCommandHandler;
use Cesc\Ranking\Infrastructure\CommandFactory\SubmitScoreCommandFactory;
use Exception;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class SubmitScoreController
{
    public function __construct(
        private readonly SubmitScoreCommandHandler $commandHandler
    ) {
    }

    #[Route('/user/{userId}/score', name: 'submitScore', methods: ['POST'])]
    public function __invoke(Request $request, string $userId): JsonResponse
    {
        try {
            $command = SubmitScoreCommandFactory::fromHttpRequest($request, $userId);
            ($this->commandHandler)($command);
        } catch (Exception $exception) {
            return new JsonResponse([
                'exception' => get_class($exception),
                'error' => $exception->getMessage()
            ], Response::HTTP_BAD_REQUEST);
        }
        return new JsonResponse();
    }
}