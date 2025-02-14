<?php
namespace App\Factory;

use App\Entity\Borrow;
use DateTime;

class BorrowFactory {
    /**
     * @throws \DateMalformedStringException
     */
    public static function createBorrow(int $id, int $bookId, int $memberId, string $borrowDate, string $dueDate, ?string $returnDate = null): Borrow {
        return new Borrow(
            $id,
            $bookId,
            $memberId,
            new DateTime($borrowDate),
            new DateTime($dueDate),
            $returnDate ? new DateTime($returnDate) : null
        );
    }
}
