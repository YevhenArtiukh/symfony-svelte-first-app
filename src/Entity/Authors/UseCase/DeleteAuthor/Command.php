<?php


namespace App\Entity\Authors\UseCase\DeleteAuthor;


class Command
{
    private $id;

    public function __construct(
        int $id
    )
    {
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