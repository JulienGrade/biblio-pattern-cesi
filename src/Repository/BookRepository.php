<?php
namespace App\Repository;

use App\Services\Database;
use App\Factory\BookFactory;
use App\Entity\Book;
use PDO;

class BookRepository {
    private PDO $db;

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

    /**
     * Récupérer tous les livres avec un tri spécifique
     */
    public function getAllBooks(string $sort = 'title'): array {
        $validSortOptions = ['title', 'author', 'category', 'isbn'];
        $orderBy = in_array($sort, $validSortOptions) ? $sort : 'title';

        $stmt = $this->db->prepare("SELECT * FROM books ORDER BY $orderBy ASC");
        $stmt->execute();

        $books = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $books[] = BookFactory::createBook($row['id'], $row['title'], $row['author'], $row['isbn'], $row['category']);
        }

        return $books;
    }

    /**
     * Récupérer un livre par son ID
     */
    public function getBookById(int $id): ?Book {
        $stmt = $this->db->prepare("SELECT * FROM books WHERE id = :id");
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row ? BookFactory::createBook($row['id'], $row['title'], $row['author'], $row['isbn'], $row['category']) : null;
    }

    /**
     * Ajouter un livre
     */
    public function addBook(string $title, string $author, string $category, string $isbn): void {
        $stmt = $this->db->prepare("INSERT INTO books (title, author, category, isbn) VALUES (:title, :author, :category, :isbn)");
        $stmt->bindValue(':title', $title);
        $stmt->bindValue(':author', $author);
        $stmt->bindValue(':category', $category);
        $stmt->bindValue(':isbn', $isbn);
        $stmt->execute();
    }

    /**
     * Supprimer un livre par son ID
     */
    public function deleteBook(int $id): void {
        $stmt = $this->db->prepare("DELETE FROM books WHERE id = :id");
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
    }
}
