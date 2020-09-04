<?php


namespace App\Entity\Books\UseCase;


use App\Core\Transaction;
use App\Entity\Authors\Authors;
use App\Entity\Books\Book;
use App\Entity\Books\Books;
use App\Entity\Books\UseCase\CreateBook\Command;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\HttpFoundation\JsonResponse;

class CreateBook
{
    private $books;
    private $authors;
    private $transaction;

    public function __construct(
        Books $books,
        Authors $authors,
        Transaction $transaction
    )
    {
        $this->books = $books;
        $this->authors = $authors;
        $this->transaction = $transaction;
    }

    public function execute(Command $command): JsonResponse
    {
        $this->transaction->begin();

        $book = new Book(
            $command->getName(),
            $command->getCount(),
            new ArrayCollection($command->getAuthors())
        );

        /** @var int $id */
        foreach ($command->getAuthors() as $id) {
            $book->addAuthor($this->authors->findOneByIdReference($id));
        }

        $this->books->add($book);

        try {
            $this->transaction->commit();
        } catch (\Throwable $e) {
            $this->transaction->rollback();
            throw $e;
        }

        return new JsonResponse('success');
    }
}