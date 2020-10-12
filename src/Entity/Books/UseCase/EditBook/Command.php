<?php


namespace App\Entity\Books\UseCase\EditBook;


use App\Entity\Books\Book;

class Command
{
    private ?Book $book;
    private string $name;
    private int $count;
    private array $authors;

    public function __construct(
        ?Book $book,
        string $name,
        int $count,
        array $authors
    )
    {
        $this->book = $book;
        $this->name = $name;
        $this->count = $count;
        $this->authors = $authors;
    }

    /**
     * @return Book|null
     */
    public function getBook(): ?Book
    {
        return $this->book;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return int
     */
    public function getCount(): int
    {
        return $this->count;
    }

    /**
     * @return array
     */
    public function getAuthors(): array
    {
        return $this->authors;
    }
}