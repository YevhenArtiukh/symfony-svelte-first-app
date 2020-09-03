<?php


namespace App\Entity\Authors\UseCase;


use App\Core\Transaction;
use App\Entity\Authors\Author;
use App\Entity\Authors\Authors;
use App\Entity\Authors\UseCase\CreateAuthor\Command;
use Symfony\Component\HttpFoundation\JsonResponse;

class CreateAuthor
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

        $author = new Author(
            $command->getName(),
            $command->getSurname(),
            $command->getDateOfBirth()
        );

        $this->authors->add($author);

        try {
            $this->transaction->commit();
        } catch (\Throwable $e) {
            $this->transaction->rollback();
            throw $e;
        }

        return new JsonResponse('success');
    }
}