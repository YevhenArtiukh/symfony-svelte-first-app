<?php


namespace App\Entity\Authors\UseCase;


use App\Core\Transaction;
use App\Entity\Authors\Authors;
use App\Entity\Authors\UseCase\DeleteAuthor\Command;
use Symfony\Component\HttpFoundation\JsonResponse;

class DeleteAuthor
{
    private $authors;
    private $transaction;

    public function __construct(
        Authors $authors,
        Transaction $transaction
    )
    {
        $this->authors = $authors;
        $this->transaction = $transaction;
    }

    public function execute(Command $command): JsonResponse
    {
        $this->transaction->begin();

        $author = $this->authors->findOneById($command->getId());

        if(!$author) {
            return new JsonResponse('error', 404);
        }

        $this->authors->delete($author);

        try {
            $this->transaction->commit();
        } catch (\Throwable $e) {
            $this->transaction->rollback();
            throw $e;
        }

        return new JsonResponse('success');
    }
}