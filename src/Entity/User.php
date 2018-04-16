<?php

namespace Blog\Entity;

/**
 * @author Amélie-Dzovinar Haladjian
 */
class User extends Entity
{
    /**
     * @var string
     */
    private $email;

    /**
     * @var string
     */
    private $firstName;

    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $lastName;

    /**
     * @var string
     */
    private $password;

    /**
     * @var string
     */
    private $role;

    /**
     * @var string
     */
    private $username;

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function getFirst_name(): string
    {
        return $this->firstName;
    }

    public function setFirst_name(string $firstName): void
    {
        $this->firstName = $firstName;
    }

    public function getUser_id(): int
    {
        return $this->id;
    }

    public function setUser_id(int $id): void
    {
        $this->id = $id;
    }

    public function getLast_name(): string
    {
        return $this->lastName;
    }

    public function setLast_name(string $lastName): void
    {
        $this->lastName = $lastName;
    }

    public function getPassword(): string
    {
        return sha1($this->password);
    }

    public function setPassword(string $password): void
    {
        $this->password = sha1($password);
    }

    public function getRole(): string
    {
        return $this->role;
    }

    public function setRole(string $role): void
    {
        $this->role = $role;
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function setUsername(string $username): void
    {
        $this->username = $username;
    }
}

