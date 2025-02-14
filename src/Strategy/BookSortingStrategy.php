<?php
namespace App\Strategy;
interface BookSortingStrategy
{
    /**
     * Classes un tableau de livres en se basant sur un critère spécifique
     *
     * @param array $books
     * @return array
     */
    public function sortBooks(array $books): array;
}
