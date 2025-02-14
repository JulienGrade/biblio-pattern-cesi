<?php

namespace App\Decorator;

use App\Decorator\MemberDecorator;

class TeacherMember extends MemberDecorator {
    public function getBorrowLimit(): int {
        return 10; // Limite d'emprunt pour les enseignants
    }
}
