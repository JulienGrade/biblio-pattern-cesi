<?php

namespace App\Factory;

use App\Entity\Member;

class MemberFactory
{
    public static function createMember(int $id, string $name, string $address, string $memberType): Member
    {
        return new Member($id, $name, $address, $memberType);
    }
}