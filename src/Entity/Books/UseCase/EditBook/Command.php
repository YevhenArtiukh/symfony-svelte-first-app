<?php


namespace App\Entity\Books\UseCase\EditBook;


use App\Entity\Books\Book;

class Command
{
    private int $id;
    private Book $book;

    public function __construct(
        int $id,
        Book $book
    )
    {
        $this->id = $id;
        $this->book = $book;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return Book
     */
    public function getBook(): Book
    {
        return $this->book;
    }
}