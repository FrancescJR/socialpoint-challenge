<?php

declare(strict_types=1);

namespace Cesc\Ranking\Application;

use Exception;

final class RankingViewQueryFactory
{
    public static function fromString(string $queryString): RankingViewQuery
    {
        if (str_starts_with($queryString, "top")) {
            return self::getTopRankingQueryFromString($queryString);
        }

        if (str_starts_with($queryString, "at")) {
            return self::relativeRankingQueryFromString($queryString);
        }
        throw new Exception("Could not get any query for string" . $queryString);
    }

    /**
     * @param string $queryString
     * @return TopRankingViewQuery
     * @throws Exception
     */
    public static function getTopRankingQueryFromString(string $queryString): TopRankingViewQuery
    {
        if (!str_starts_with($queryString, "top")) {
            throw new Exception("query must start with top");
        }
        $top = substr($queryString, 3);
        if (!ctype_digit($top)) {
            throw new Exception("Query string after Top must contain a number only");
        }
        return new TopRankingViewQuery((int)$top);
    }

    /**
     * @param string $queryString
     * @return RelativeRankingViewQuery
     * @throws Exception
     */
    public static function relativeRankingQueryFromString(string $queryString): RelativeRankingViewQuery
    {
        if (!str_starts_with($queryString, "at")) {
            throw new Exception("query must start with at");
        }
        $at = substr($queryString, 2);
        $values = explode( "/", $at);
        if (count($values) !== 2 ) {
            throw new Exception("Query string after at must be with the format xx/x");
        }
        if (!ctype_digit($values[0]) || !ctype_digit($values[1])) {
            throw new Exception("query string with At should have a number, a slash and another number.");
        }
        if( (int) $values[1] > (int) $values[0]) {
            throw new Exception("you cannot ask for a range bigger than where the pivot in ranking is");
        }
        return new RelativeRankingViewQuery(
            (int) $values[0],
            (int) $values[1]
        );
    }
}