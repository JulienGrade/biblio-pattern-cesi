<?php
namespace App\Repository;

use App\Services\Database;
use App\Factory\MemberFactory;
use App\Entity\Member;
use PDO;

class MemberRepository {
    private PDO $db;

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

    /**
     * Récupérer tous les membres
     */
    public function getAllMembers(): array {
        $stmt = $this->db->query("SELECT * FROM members ORDER BY name ASC");

        $members = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $members[] = MemberFactory::createMember($row['id'], $row['name'], $row['address'], $row['member_type']);
        }

        return $members;
    }

    /**
     * Récupérer un membre par son ID
     */
    public function getMemberById(int $id): ?Member {
        $stmt = $this->db->prepare("SELECT * FROM members WHERE id = :id");
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row ? MemberFactory::createMember($row['id'], $row['name'], $row['address'], $row['member_type']) : null;
    }

    /**
     * Ajouter un membre
     */
    public function addMember(string $name, string $address, string $memberType): void {
        $stmt = $this->db->prepare("INSERT INTO members (name, address, member_type) VALUES (:name, :address, :member_type)");
        $stmt->bindValue(':name', $name);
        $stmt->bindValue(':address', $address);
        $stmt->bindValue(':member_type', $memberType);
        $stmt->execute();
    }

    /**
     * Supprimer un membre par son ID
     */
    public function deleteMember(int $id): void {
        $stmt = $this->db->prepare("DELETE FROM members WHERE id = :id");
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
    }
}
