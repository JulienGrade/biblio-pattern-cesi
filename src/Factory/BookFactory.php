<?php
namespace App\Factory;

use App\Entity\Book;
use JetBrains\PhpStorm\Pure;

class BookFactory
{
    public static function createBook(int $id, string $title, string $author, string $isbn, string $category): Book
    {
        return new Book($id, $title, $author, $isbn, $category);
    }
}
