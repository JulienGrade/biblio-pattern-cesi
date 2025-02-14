<?php
namespace App\Strategy;

use App\Strategy\BookSortingStrategy;


class SortBooksByTitle implements BookSortingStrategy {
    public function sortBooks(array $books): array {
        usort($books, static fn($a, $b) => strcmp($a['title'], $b['title']));
        return $books;
    }
}