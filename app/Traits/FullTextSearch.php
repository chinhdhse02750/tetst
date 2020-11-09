<?php

namespace App\Traits;

use App\Helpers\Constants;

trait FullTextSearch
{
    /**
     * Replaces spaces with full text search wildcards
     *
     * @param string $term
     * @return string
     */
    protected function fullTextWildcards($term)
    {
        $reservedSymbols = ['-', '+', '<', '>', '@', '(', ')', '~'];
        $term = str_replace($reservedSymbols, '', $term);
        $words = explode(' ', $term);
        foreach ($words as $key => $word) {
            if (strlen($word) >= Constants::TEXT_SEARCH_LIMIT) {
                $words[$key] = $word . '*';
            }
        }

        return implode(' ', $words);
    }
}
