<?php


namespace App\Adapter\Books;

use App\Entity\Books\Book;
use App\Entity\Books\Books as BooksInterface;
use Doctrine\ORM\EntityManager;

class Books implements BooksInterface
{
    private $entityManager;

    public function __construct(
        EntityManager $entityManager
    )
    {
        $this->entityManager = $entityManager;
    }


    public function add(Book $book)
    {
        $this->entityManager->persist($book);
    }

    public function delete(Book $book)
    {
        $this->entityManager->remove($book);
    }

    public function findOneById(int $id): ?Book
    {
        return $this->entityManager->getRepository(Book::class)->findOneBy([
            'id' => $id
        ]);
    }
}