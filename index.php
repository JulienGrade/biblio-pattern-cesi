<?php

require_once __DIR__ . '/vendor/autoload.php';

use App\Controller\BorrowController;
use App\Controller\MemberController;
use App\Decorator\MemberDecoratorFactory;
use App\Repository\BookRepository;
use App\Repository\BorrowRepository;
use App\Repository\MemberRepository;
use App\Factory\BookFactory;
use App\Factory\MemberFactory;

use App\Views\Borrows\BorrowFormView;
use App\Views\Borrows\BorrowsView;
use App\Views\Members\MembersView;
use App\Views\Members\MembersFormView;
use App\Controller\BookController;

$page = $_GET['page'] ?? 'books';
// Instancier les repository
$bookRepository = new BookRepository();
$memberRepository = new MemberRepository();
$borrowRepository = new BorrowRepository();
// Instancier les contrôleurs
$bookController = new BookController();
$memberController = new MemberController();
$borrowController = new BorrowController();

switch ($page) {
    // Gestion des livres
    case 'books':
        $bookController->listBooks();
        break;

    case 'book-form':
        $bookController->showBookForm();
        break;

    case 'save-book':
        $bookController->saveBook();
        break;

    case 'delete-book':
        $bookController->deleteBook();
        break;

    // Gestion des membres
    case 'members':
        $memberController->listMembers();
        break;

    case 'member-form':
        $memberController->showMemberForm();
        break;

    case 'save-member':
        $memberController->saveMember();
        break;

    case 'delete-member':
        $memberController->deleteMember();
        break;

    // Gestion des emprunts
    case 'borrows':
        $borrowController->listBorrows();
        break;

    case 'borrow-form':
        $borrowController->showBorrowForm();
        break;

    case 'save-borrow':
        try {
            $borrowController->saveBorrow();
        } catch (Exception $e) {
            echo $e->getMessage();
        }
        break;

    case 'return-borrow':
        $borrowController->returnBorrow();
        break;

    default:
        echo "<h1>404 Page Not Found</h1>";
        break;
}
