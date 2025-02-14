<?php
namespace App\Decorator;

use App\Entity\Member;

class MemberDecoratorFactory {
    /**
     * @throws \Exception
     */
    public static function create(Member $member)
    {
        switch ($member->getType()) {
            case 'student':
                return new StudentMember($member);
            case 'teacher':
                return new TeacherMember($member);
            case 'staff':
                return new StaffMember($member);
            default:
                throw new \Exception("Type de membre inconnu");
        }
    }
}
