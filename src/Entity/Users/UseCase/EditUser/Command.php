<?php


namespace App\Entity\Users\UseCase\EditUser;


class Command
{
    private $id;
    private $name;
    private $surname;
    private $email;

    public function __construct(
        int $id,
        string $name,
        string $surname,
        string $email
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->surname = $surname;
        $this->email = $email;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
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
}