<?php
namespace App\Repository;

use App\Services\Database;
use App\Entity\Borrow;
use PDO;
use DateTime;

class BorrowRepository {
    private PDO $db;

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

    /**
     * Récupérer tous les emprunts avec une alerte de retard si nécessaire
     * @throws \DateMalformedStringException
     */
    public function getAllBorrows(): array {
        $stmt = $this->db->query("
        SELECT borrows.*, books.title AS book_title, members.name AS member_name, 
        CASE 
            WHEN borrows.return_date IS NULL AND borrows.due_date < CURDATE() THEN 'overdue'
            WHEN borrows.return_date IS NULL THEN 'not returned'
            ELSE 'returned'
        END AS borrow_status
        FROM borrows
        JOIN books ON borrows.book_id = books.id
        JOIN members ON borrows.member_id = members.id
        ORDER BY borrow_date DESC
        ");

        $borrows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $borrowObjects = [];
        foreach ($borrows as $borrow) {
            $borrowObjects[] = new Borrow(
                $borrow['id'],
                $borrow['book_id'],
                $borrow['member_id'],
                $borrow['book_title'], // ✅ On passe bien le titre du livre
                $borrow['member_name'], // ✅ On passe bien le nom du membre
                new DateTime($borrow['borrow_date']),
                new DateTime($borrow['due_date']),
                $borrow['return_date'] ? new DateTime($borrow['return_date']) : null
            );
        }
        return $borrowObjects;
    }
    public function countActiveBorrowsForMember(int $memberId): int {
        $stmt = $this->db->prepare("
        SELECT COUNT(*) FROM borrows 
        WHERE member_id = :member_id 
        AND return_date IS NULL
    ");
        $stmt->bindValue(':member_id', $memberId, PDO::PARAM_INT);
        $stmt->execute();
        return (int) $stmt->fetchColumn();
    }

    public function addBorrow(int $bookId, int $memberId, string $borrowDate, string $dueDate): void {
        $stmt = $this->db->prepare("
        INSERT INTO borrows (book_id, member_id, borrow_date, due_date)
        VALUES (:book_id, :member_id, :borrow_date, :due_date)
    ");
        $stmt->bindValue(':book_id', $bookId, PDO::PARAM_INT);
        $stmt->bindValue(':member_id', $memberId, PDO::PARAM_INT);
        $stmt->bindValue(':borrow_date', $borrowDate);
        $stmt->bindValue(':due_date', $dueDate);
        $stmt->execute();
    }

    public function markAsReturned(int $id): void {
        $stmt = $this->db->prepare("UPDATE borrows SET return_date = NOW() WHERE id = :id");
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
    }

    public function getBorrowById(int $id): ?Borrow {
        $stmt = $this->db->prepare("
        SELECT borrows.*, books.title AS book_title, members.name AS member_name
        FROM borrows
        JOIN books ON borrows.book_id = books.id
        JOIN members ON borrows.member_id = members.id
        WHERE borrows.id = :id
    ");
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $borrow = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$borrow) {
            return null;
        }

        return new Borrow(
            $borrow['id'],
            $borrow['book_id'],
            $borrow['member_id'],
            $borrow['book_title'], // ✅ Vérifie que le titre du livre est bien passé en `string`
            $borrow['member_name'], // ✅ Vérifie que le nom du membre est bien passé en `string`
            new DateTime($borrow['borrow_date']),
            new DateTime($borrow['due_date']),
            $borrow['return_date'] ? new DateTime($borrow['return_date']) : null
        );
    }



}
