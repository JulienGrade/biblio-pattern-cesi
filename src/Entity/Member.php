<?php
namespace App\Entity;

class Member
{
    private int $id;
    private string $name;
    private string $address;
    private string $memberType;

    public function __construct(int $id, string $name, string $address, string $memberType) {
        $this->id = $id;
        $this->name = $name;
        $this->address = $address;
        $this->memberType = $memberType;
    }

    // Getters
    public function getId(): int {
        return $this->id;
    }

    public function getName(): string {
        return $this->name;
    }

    public function getAddress(): string {
        return $this->address;
    }

    public function getType(): string {
        return $this->memberType;
    }

    // Setters
    public function setName(string $name): void {
        $this->name = $name;
    }

    public function setAddress(string $address): void {
        $this->address = $address;
    }

    public function setType(string $memberType): void {
        $this->memberType = $memberType;
    }
}
