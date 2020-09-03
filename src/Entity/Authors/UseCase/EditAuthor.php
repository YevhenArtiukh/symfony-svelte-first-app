<?php


namespace App\Entity\Authors\UseCase;


use App\Core\Transaction;
use App\Entity\Authors\Authors;
use App\Entity\Authors\UseCase\EditAuthor\Command;
use Symfony\Component\HttpFoundation\JsonResponse;

class EditAuthor
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

    public function execute(Command $command)
    {
        $this->transaction->begin();

        $author = $this->authors->findOneById($command->getId());

        if(!$author) {
            return new JsonResponse('error', 404);
        }

        $author->edit(
            $command->getAuthor()->getName(),
            $command->getAuthor()->getSurname(),
            $command->getAuthor()->getDateOfBirth()
        );

        try {
            $this->transaction->commit();
        } catch (\Throwable $e) {
            $this->transaction->rollback();
            throw $e;
        }

        return new JsonResponse('success');
    }
}