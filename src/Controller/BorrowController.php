<?php
namespace App\Controller;

use App\Entity\Borrow;
use App\Repository\BorrowRepository;
use App\Repository\BookRepository;
use App\Repository\MemberRepository;
use App\Views\Borrows\BorrowsView;
use App\Views\Borrows\BorrowFormView;
use App\Decorator\MemberDecoratorFactory;
use App\Factory\MemberFactory;
use App\Services\NotificationManager;
use App\Observer\EmailNotificationObserver;
use App\Observer\SMSNotificationObserver;

class BorrowController {
    private BorrowRepository $borrowRepository;
    private BookRepository $bookRepository;
    private MemberRepository $memberRepository;
    private NotificationManager $notificationManager;

    public function __construct() {
        $this->borrowRepository = new BorrowRepository();
        $this->bookRepository = new BookRepository();
        $this->memberRepository = new MemberRepository();

        // Initialisation du gestionnaire de notifications avec les observateurs
        $this->notificationManager = new NotificationManager();
        $this->notificationManager->addObserver(new EmailNotificationObserver());
        $this->notificationManager->addObserver(new SMSNotificationObserver());
    }

    public function listBorrows(): void {
        $view = new BorrowsView();
        $borrows = $this->borrowRepository->getAllBorrows();
        echo $view->renderList($borrows);
    }

    public function showBorrowForm(?string $errorMessage = null): void {
        $id = $_GET['id'] ?? null;
        $borrow = null;

        if ($id) {
            $borrow = $this->borrowRepository->getBorrowById((int)$id);
        }

        $view = new BorrowFormView();
        echo $view->renderForm($borrow, $errorMessage);
    }

    public function saveBorrow(): void {
        if (!empty($_POST['book_id']) && !empty($_POST['member_id']) && !empty($_POST['borrow_date']) && !empty($_POST['due_date'])) {
            $memberData = $this->memberRepository->getMemberById((int)$_POST['member_id']);
            if (!$memberData) {
                $this->showBorrowForm("Error: Member not found.");
                return;
            }

            // Vérification des limites d'emprunt
            $member = MemberFactory::createMember($memberData->getId(), $memberData->getName(), $memberData->getAddress(), $memberData->getType());
            $decoratedMember = MemberDecoratorFactory::create($member);
            $borrowLimit = $decoratedMember->getBorrowLimit();
            $currentBorrows = $this->borrowRepository->countActiveBorrowsForMember($member->getId());

            if ($currentBorrows >= $borrowLimit) {
                $this->showBorrowForm("Borrow limit exceeded. Max allowed: $borrowLimit.");
                return;
            }

            // Ajout de l'emprunt
            $this->borrowRepository->addBorrow($_POST['book_id'], $_POST['member_id'], $_POST['borrow_date'], $_POST['due_date']);

            // Envoi des notifications et stockage du message
            $message = "New borrow added: Book ID {$_POST['book_id']} borrowed by Member ID {$_POST['member_id']}.";
            $this->notificationManager->notifyAll($message);

            // 🔹 Passer le message à la vue via un paramètre GET
            header("Location: ?page=borrows&notification=" . urlencode($message));
            exit;
        }
    }


    public function returnBorrow(): void {
        $id = $_GET['id'] ?? null;
        if ($id) {
            $this->borrowRepository->markAsReturned((int)$id);

            // 🔹 Envoi de notification après retour d'un emprunt
            $message = "Borrow ID {$id} has been returned.";
            $this->notificationManager->notifyAll($message);

            // 🔹 Passer le message à la vue via un paramètre GET
            header("Location: ?page=borrows&notification=" . urlencode($message));
            exit;
        }
        header('Location: ?page=borrows');
        exit;
    }


}
