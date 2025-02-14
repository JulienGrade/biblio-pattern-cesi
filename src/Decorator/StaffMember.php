<?php
namespace App\Decorator;

class StaffMember extends MemberDecorator {
    public function getBorrowLimit(): int {
        return 7; // Limite d'emprunt pour le personnel
    }
}
