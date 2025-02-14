<?php

namespace App\Strategy;

use App\Strategy\BookSortingStrategy;

class SortBooksByCategory implements BookSortingStrategy
{
    public function sortBooks(array $books): array {
        usort($books, static fn($a, $b) => strcmp($a['category'], $b['category']));
        return $books;
    }
}