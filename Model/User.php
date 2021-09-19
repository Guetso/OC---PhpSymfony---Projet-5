<?php

namespace Blog\Model;

class User extends Model
{
    private int $id;
    private string $pseudo;
    private string $email;
    private bool $isAdmin;
    private string $createdAt;
    private string $modifiedAt;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): User
    {
        $this->id = $id;
        return $this;
    }

    public function getPseudo(): string
    {
        return $this->pseudo;
    }

    public function setPseudo(string $pseudo): User
    {
        $this->pseudo = $pseudo;
        return $this;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): User
    {
        $this->email = $email;
        return $this;
    }

    public function getIsAdmin(): bool
    {
        return $this->isAdmin;
    }

    public function setIsAdmin(bool $isAdmin): User
    {
        $this->isAdmin = $isAdmin;
        return $this;
    }

    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }

    public function setCreatedAt(string $createdAt): User
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    public function getModifiedAt(): string
    {
        return $this->modifiedAt;
    }

    public function setModifiedAt(string $modifiedAt): User
    {
        $this->modifiedAt = $modifiedAt;
        return $this;
    }
}
