<?php

namespace App\Decorator;


class StudentMember extends MemberDecorator {
    public function getBorrowLimit(): int {
        return 5; // Limite d'emprunt pour les étudiants
    }
}
