<?php


namespace App\Entity\Users\UseCase\EditUser;


use App\Entity\Users\User;

class Command
{
    private User $user;
    private string $name;
    private string $surname;
    private string $email;

    public function __construct(
        User $user,
        string $name,
        string $surname,
        string $email
    )
    {
        $this->user = $user;
        $this->name = $name;
        $this->surname = $surname;
        $this->email = $email;
    }

    /**
     * @return User
     */
    public function getUser(): User
    {
        return $this->user;
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