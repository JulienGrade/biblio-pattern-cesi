<?php

namespace App\Entity;

use DateTime;

class Borrow
{
    private int $id;
    private int $bookId;
    private int $memberId;
    private string $bookTitle; // ✅ Titre du livre avant DateTime
    private string $memberName; // ✅ Nom du membre avant DateTime
    private DateTime $borrowDate;
    private DateTime $dueDate;
    private ?DateTime $returnDate;

    public function __construct(
        int $id,
        int $bookId,
        int $memberId,
        string $bookTitle,
        string $memberName,
        DateTime $borrowDate,
        DateTime $dueDate,
        ?DateTime $returnDate = null
    ) {
        $this->id = $id;
        $this->bookId = $bookId;
        $this->memberId = $memberId;
        $this->bookTitle = $bookTitle;
        $this->memberName = $memberName;
        $this->borrowDate = $borrowDate;
        $this->dueDate = $dueDate;
        $this->returnDate = $returnDate;
    }

    public function getId(): int { return $this->id; }
    public function getBookId(): int { return $this->bookId; }
    public function getMemberId(): int { return $this->memberId; }
    public function getBookTitle(): string { return $this->bookTitle; }
    public function getMemberName(): string { return $this->memberName; }
    public function getBorrowDate(): DateTime { return $this->borrowDate; }
    public function getDueDate(): DateTime { return $this->dueDate; }
    public function getReturnDate(): ?DateTime { return $this->returnDate; }
}
