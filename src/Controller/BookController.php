<?php
namespace App\Controller;

use App\Repository\BookRepository;
use App\Factory\BookFactory;
use App\Views\Books\BooksView;
use App\Views\Books\BooksFormView;

class BookController {
    private BookRepository $bookRepository;

    public function __construct() {
        $this->bookRepository = new BookRepository();
    }

    public function listBooks(): void {
        $view = new BooksView();
        $sortMethod = $_GET['sort'] ?? 'title';
        $books = $this->bookRepository->getAllBooks($sortMethod);
        echo $view->renderList($books);
    }

    public function showBookForm(): void {
        $view = new BooksFormView();
        $id = $_GET['id'] ?? null;
        $bookData = $id ? $this->bookRepository->getBookById((int)$id) : null;
        $book = $bookData ? BookFactory::createBook($bookData->getId(), $bookData->getTitle(), $bookData->getAuthor(), $bookData->getIsbn(), $bookData->getCategory()) : null;
        echo $view->renderForm($book);
    }

    public function saveBook(): void {
        if (!empty($_POST['title']) && !empty($_POST['author']) && !empty($_POST['category']) && !empty($_POST['isbn'])) {
            $this->bookRepository->addBook($_POST['title'], $_POST['author'], $_POST['category'], $_POST['isbn']);
        }
        header('Location: ?page=books');
        exit;
    }

    public function deleteBook(): void {
        $id = $_GET['id'] ?? null;
        if ($id) {
            $this->bookRepository->deleteBook((int)$id);
        }
        header('Location: ?page=books');
        exit;
    }
}
