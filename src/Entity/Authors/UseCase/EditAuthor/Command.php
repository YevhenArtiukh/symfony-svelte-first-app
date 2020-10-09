<?php


namespace App\Entity\Authors\UseCase\EditAuthor;


use App\Entity\Authors\Author;

class Command
{
    private int $id;
    private Author $author;

    public function __construct(
        int $id,
        Author $author
    )
    {
        $this->id = $id;
        $this->author = $author;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return Author
     */
    public function getAuthor(): Author
    {
        return $this->author;
    }
}