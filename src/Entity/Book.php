<?php
namespace App\Entity;

class Book
{
    private int $id;
    private string $title;
    private string $author;
    private string $isbn;
    private string $category;

    public function __construct(int $id, string $title, string $author, string $isbn, string $category) {
        $this->id = $id;
        $this->title = $title;
        $this->author = $author;
        $this->isbn = $isbn;
        $this->category = $category;
    }

    // Getters
    public function getId(): int {
        return $this->id;
    }

    public function getTitle(): string {
        return $this->title;
    }

    public function getAuthor(): string {
        return $this->author;
    }

    public function getIsbn(): string {
        return $this->isbn;
    }

    public function getCategory(): string {
        return $this->category;
    }

    // Setters
    public function setTitle(string $title): void {
        $this->title = $title;
    }

    public function setAuthor(string $author): void {
        $this->author = $author;
    }

    public function setIsbn(string $isbn): void {
        $this->isbn = $isbn;
    }

    public function setCategory(string $category): void {
        $this->category = $category;
    }
}
