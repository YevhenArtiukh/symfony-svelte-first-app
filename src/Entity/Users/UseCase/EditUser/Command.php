<?php


namespace App\Entity\Users\UseCase\EditUser;


use App\Entity\Users\User;

class Command
{
    private $id;
    private $user;

    public function __construct(
        int $id,
        User $user
    )
    {
        $this->id = $id;
        $this->user = $user;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return User
     */
    public function getUser(): User
    {
        return $this->user;
    }
}