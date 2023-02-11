<?php

declare(strict_types=1);

namespace Cesc\Ranking\Infrastructure\CommandFactory;

use Cesc\Ranking\Application\SubmitScoreCommand;
use Exception;
use Symfony\Component\HttpFoundation\Request;

final class SubmitScoreCommandFactory
{
    /**
     * @param Request $request
     * @param string $userId
     * @return SubmitScoreCommand
     * @throws Exception
     */
    public static function fromHttpRequest(Request $request, string $userId): SubmitScoreCommand
    {
        $content = json_decode($request->getContent(), true);
        if (!array_key_exists("score", $content)) {
            throw new Exception("This endpoint requires a score in the json body of the request");
        }
        return new SubmitScoreCommand(
            $userId,
            $content['score']
        );
    }
}