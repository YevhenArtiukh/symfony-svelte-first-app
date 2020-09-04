<?php


namespace App\Entity\Books\UseCase;


use App\Core\Transaction;
use App\Entity\Books\Books;
use App\Entity\Books\UseCase\DeleteBook\Command;
use Symfony\Component\HttpFoundation\JsonResponse;

class DeleteBook
{
    private $books;
    private $transaction;

    public function __construct(
        Books $books,
        Transaction $transaction
    )
    {
        $this->books = $books;
        $this->transaction = $transaction;
    }

    public function execute(Command $command): JsonResponse
    {
        $this->transaction->begin();

        $book = $this->books->findOneById($command->getId());

        if (!$book) {
            return new JsonResponse('error', 404);
        }

        $this->books->delete($book);

        try {
            $this->transaction->commit();
        } catch (\Throwable $e) {
            $this->transaction->rollback();
            throw $e;
        }

        return new JsonResponse('success');
    }
}