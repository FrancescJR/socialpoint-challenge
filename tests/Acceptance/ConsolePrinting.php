<?php

declare(strict_types=1);

namespace Cesc\Ranking\Tests\Acceptance;

final class ConsolePrinting
{
    public const RANKING_ROOM = 6;
    public const NAME_ROOM = 70;
    public const SCORE_ROOM = 10;

    public static function printConsoleRankingTableFromArray(array $array, string $title): void
    {
        echo "\nQuerying Ranking: ".$title."\n";
        self::printTableLine();
        foreach ($array as $item) {
            ConsolePrinting::printRankingLing($item);
        }
        self::printTableLine();
        echo "\n";
    }

    private static function printTableLine(): void
    {
        self::printChar(
            self::RANKING_ROOM
            + self::NAME_ROOM
            + self::SCORE_ROOM,
            '-'
        );
        echo "\n";
    }

    private static function printRankingLing($item): void
    {
        self::printCell((string)$item['ranking'], self::RANKING_ROOM);
        self::printCell($item['userId'], self::NAME_ROOM);
        self::printCell((string)$item['score'], self::SCORE_ROOM);
        echo "|\n";
    }

    private static function printCell(string $string, int $cellLength): void
    {
        echo "|  " . $string;
        self::printChar($cellLength - (strlen($string) + 3), ' ');
    }

    private static function printChar(int $number, string $char): void
    {
        echo str_repeat($char, $number);
    }
}