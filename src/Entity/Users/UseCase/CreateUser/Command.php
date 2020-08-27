<?php


namespace App\Entity\Users\UseCase\CreateUser;


class Command
{
    private $name;
    private $surname;
    private $email;
    private $password;

    public function __construct(
        string $name,
        string $surname,
        string $email,
        string $password
    ) {
        $this->name = $name;
        $this->surname = $surname;
        $this->email = $email;
        $this->password = $password;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getSurname(): string
    {
        return $this->surname;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }
}