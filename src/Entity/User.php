<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\PasswordHasher\Hasher\PasswordHasherAwareInterface;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity()]
class User implements
    UserInterface,
    PasswordAuthenticatedUserInterface,
    PasswordHasherAwareInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180, unique: true)]
    private ?string $username = null;

    #[ORM\Column(nullable: true)]
    private ?string $password = null;

    #[ORM\Column]
    private array $roles = [];

    #[ORM\Column(length: 32, nullable: true)]
    private ?string $passwordHasherName = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false, onDelete: 'CASCADE')]
    private ?AppProfile $profile = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setUsername(string $username): static
    {
        $this->username = $username;

        return $this;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(?string $password): static
    {
        $this->password = $password;

        return $this;
    }

    public function getRoles(): array
    {
        return array_unique([...$this->roles, 'ROLE_USER']);
    }

    public function setRoles(array $roles): static
    {
        $this->roles = $roles;

        return $this;
    }

    public function getProfile(): ?AppProfile
    {
        return $this->profile;
    }

    public function setProfile(?AppProfile $profile): static
    {
        $this->profile = $profile;

        return $this;
    }

    public function getPasswordHasherName(): ?string
    {
        return $this->passwordHasherName;
    }

    public function setPasswordHasherName(?string $passwordHasherName): static
    {
        $this->passwordHasherName = $passwordHasherName;

        return $this;
    }

    public function getUserIdentifier(): string
    {
        return sprintf('%s@%s', $this->username, (string) $this->profile->getCode());
    }

    public function eraseCredentials(): void
    {
        // Non necessario in quanto non memorizziamo dati sensibili nella classe
    }
}
