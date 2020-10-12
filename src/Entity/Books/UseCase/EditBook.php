<?php


namespace App\Entity\Books\UseCase;


use App\Core\Transaction;
use App\Entity\Authors\Authors;
use App\Entity\Books\Books;
use App\Entity\Books\UseCase\EditBook\Command;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\HttpFoundation\JsonResponse;

class EditBook
{
    private Books $books;
    private Authors $authors;
    private Transaction $transaction;

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

    public function execute(Command $command)
    {
        $this->transaction->begin();

        if (!$command->getBook()) {
            return new JsonResponse('error', 404);
        }

        $collection = new ArrayCollection();
        foreach ($command->getAuthors() as $id) {
            $collection->add($this->authors->findOneByIdReference($id));
        }

        $command->getBook()->edit(
            $command->getName(),
            $command->getCount(),
            $collection
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