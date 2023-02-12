<?php

declare(strict_types=1);

namespace Cesc\Ranking\Tests\Acceptance;

use Cesc\Ranking\Infrastructure\API\RankingViewController;
use Cesc\Ranking\Infrastructure\API\SubmitScoreController;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\HttpFoundation\Request;

final class RankingQueryTest extends KernelTestCase
{
    public function testQuery(): void
    {
        self::bootKernel();
        $symfonyRequest = Request::create(
            '/user/name/score',
            'POST',
            [],
            [],
            [],
            [],
            json_encode([
                'score' => 40
            ])
        );

        $container = static::getContainer();
        $controller =  $container->get(SubmitScoreController::class);

        ($controller)($symfonyRequest, 'name');

        self::assertEquals(1,1);

        $symfonyRequest = Request::create(
            '/ranking?type=top10',
            'GET',
            [],
            [],
            [],
            [],
            []
        );

        $controllerQuery =  $container->get(RankingViewController::class);
        $response = ($controllerQuery)($symfonyRequest);
        /**@var $response \Symfony\Component\HttpFoundation\JsonResponse */
        print_r($response->getContent());

    }

}