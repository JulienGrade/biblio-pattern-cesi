<?php

namespace App\Services;

use App\Strategy\BookSortingStrategy;

class SortingManager
{
    private BookSortingStrategy $strategy;

    public function setStrategy(BookSortingStrategy $strategy): void {
        $this->strategy = $strategy;
    }

    public function sortBooks(array $books): array {
        return $this->strategy->sortBooks($books);
    }
}