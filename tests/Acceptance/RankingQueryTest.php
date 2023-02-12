<?php

declare(strict_types=1);

namespace Cesc\Ranking\Tests\Acceptance;

use Cesc\Ranking\Domain\Gamer;
use Cesc\Ranking\Infrastructure\API\RankingViewController;
use Cesc\Ranking\Infrastructure\API\SubmitScoreController;
use Cesc\Ranking\Tests\Commit\Domain\GamerStub;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

final class RankingQueryTest extends KernelTestCase
{
    private SubmitScoreController $submitScoreController;
    private RankingViewController $rankingViewController;

    public function setUp(): void
    {
        self::bootKernel();
        $container = static::getContainer();
        $this->submitScoreController = $container->get(SubmitScoreController::class);
        $this->rankingViewController = $container->get(RankingViewController::class);
    }

    public function testQuery(): void
    {
        $numGamers = 10;
        $this->generateRandomRankingBoard($numGamers);
        $queryResponse = $this->queryRanking("top30");
        self::assertCount($numGamers, $queryResponse);
        ConsolePrinting::printConsoleRankingTableFromArray($queryResponse, "top30");

        $queryResponse = $this->queryRanking("at5/2");
        ConsolePrinting::printConsoleRankingTableFromArray($queryResponse, "at5/2");



        $gamer = GamerStub::withScore(500);

        echo "\n Adding ".$gamer->id." with 500 score";
        $request = $this->generateSubmitScoreRequestFromGamer($gamer);
        ($this->submitScoreController)($request, $gamer->id);

        $queryResponse = $this->queryRanking("top20");
        ConsolePrinting::printConsoleRankingTableFromArray($queryResponse, "top20");
    }

    private function generateRandomRankingBoard(int $gamers): void
    {
        for ($i = 0; $i < $gamers; $i++) {
            $gamer = GamerStub::random();
            $request = $this->generateSubmitScoreRequestFromGamer($gamer);
            ($this->submitScoreController)($request, $gamer->id);
        }
    }

    private function generateSubmitScoreRequestFromGamer(Gamer $gamer): Request
    {
        return Request::create(
            "/user/{$gamer->id}/score",
            'POST',
            [],
            [],
            [],
            [],
            json_encode([
                'score' => $gamer->score()
            ])
        );
    }

    private function queryRanking($queryString): array
    {
        $symfonyRequest = Request::create(
            '/ranking?type='. $queryString,
            'GET',
            [],
            [],
            [],
            [],
            []
        );

        $response = ($this->rankingViewController)($symfonyRequest);
        /**@var $response JsonResponse */

        return json_decode($response->getContent(), true);
    }


}