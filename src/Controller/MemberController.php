<?php
namespace App\Controller;

use App\Repository\MemberRepository;
use App\Factory\MemberFactory;
use App\Views\Members\MembersView;
use App\Views\Members\MembersFormView;

class MemberController {
    private MemberRepository $memberRepository;

    public function __construct() {
        $this->memberRepository = new MemberRepository();
    }

    public function listMembers(): void {
        $view = new MembersView();
        $members = $this->memberRepository->getAllMembers();
        echo $view->renderList($members);
    }

    public function showMemberForm(): void {
        $view = new MembersFormView();
        $id = $_GET['id'] ?? null;
        $memberData = $id ? $this->memberRepository->getMemberById((int)$id) : null;
        $member = $memberData ? MemberFactory::createMember($memberData->getId(), $memberData->getName(), $memberData->getAddress(), $memberData->getType()) : null;
        echo $view->renderForm($member);
    }

    public function saveMember(): void {
        if (!empty($_POST['name']) && !empty($_POST['address']) && !empty($_POST['member_type'])) {
            $this->memberRepository->addMember($_POST['name'], $_POST['address'], $_POST['member_type']);
        }
        header('Location: ?page=members');
        exit;
    }

    public function deleteMember(): void {
        $id = $_GET['id'] ?? null;
        if ($id) {
            $this->memberRepository->deleteMember((int)$id);
        }
        header('Location: ?page=members');
        exit;
    }
}
