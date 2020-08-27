<?php


namespace App\Entity\Users\UseCase\DeleteUser;


class Command
{
    private $id;

    public function __construct(
        int $id
    ) {
        $this->id = $id;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }
}