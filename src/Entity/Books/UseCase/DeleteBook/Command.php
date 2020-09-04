<?php


namespace App\Entity\Books\UseCase\DeleteBook;


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