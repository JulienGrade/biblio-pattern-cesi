<?php
namespace App\Decorator;

use App\Entity\Member;

abstract class MemberDecorator {
protected Member $member;

public function __construct(Member $member) {
$this->member = $member;
}

abstract public function getBorrowLimit(): int;
}
