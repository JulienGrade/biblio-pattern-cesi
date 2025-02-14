<?php

namespace App\Strategy;

use App\Strategy\BookSortingStrategy;
class SortBooksByAuthor implements BookSortingStrategy
{
    public function sortBooks(array $books): array {
        usort($books, static fn($a, $b) => strcmp($a['author'], $b['author']));
        return $books;
    }
}


