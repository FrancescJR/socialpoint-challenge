<?php

declare(strict_types=1);

namespace Cesc\Ranking\Infrastructure\API;

use Cesc\Ranking\Application\RankingViewQuery;
use Cesc\Ranking\Application\RankingViewQueryFactory;
use Cesc\Ranking\Application\RelativeRankingViewQuery;
use Cesc\Ranking\Application\RelativeRankingViewQueryHandler;
use Cesc\Ranking\Application\TopRankingViewQuery;
use Cesc\Ranking\Application\TopRankingViewQueryHandler;
use Exception;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class RankingViewController
{
    public function __construct(
        private readonly RelativeRankingViewQueryHandler $relativeQueryHandler,
        private readonly TopRankingViewQueryHandler $topRankingQueryHandler
    ) {
    }

    #[Route('/ranking', name: 'ranking', methods: ['GET'])]
    public function __invoke(Request $request): JsonResponse
    {
        try {
            $query = $this->getQueryFromRequest($request);
            // straight away strategy pattern
            if (get_class($query) == TopRankingViewQuery::class) {
                $response = ($this->topRankingQueryHandler)($query);
            } elseif (get_class($query) == RelativeRankingViewQuery::class) {
                $response = ($this->relativeQueryHandler)($query);
            } else {
                throw new Exception("Query to view the ranking not understood");
            }
        } catch (Exception $exception) {
            return new JsonResponse([
                'exception' => get_class($exception),
                'error' => $exception->getMessage()
            ], Response::HTTP_BAD_REQUEST);
        }
        return new JsonResponse($response);
    }

    /**
     * @param Request $request
     * @return RankingViewQuery
     * @throws Exception
     */
    public function getQueryFromRequest(Request $request): RankingViewQuery
    {
        $type = $request->query->get('type');
        if (!$type) {
            throw new Exception("Query string must have 'type=xxx'");
        }
        return RankingViewQueryFactory::fromString($type);
    }
}