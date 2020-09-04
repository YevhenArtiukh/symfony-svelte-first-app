<?php


namespace App\Entity\Books\UseCase\CreateBook;


class Command
{
    private $name;
    private $count;
    private $authors;

    public function __construct(
        string $name,
        int $count,
        array $authors
    )
    {
        $this->name = $name;
        $this->count = $count;
        $this->authors = $authors;
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