<?php


namespace App\Entity\Users\UseCase;


use App\Core\Transaction;
use App\Entity\Users\UseCase\EditUser\Command;
use App\Entity\Users\Users;
use Symfony\Component\HttpFoundation\JsonResponse;
use Throwable;

class EditUser
{
    private $users;
    private $transaction;

    public function __construct(
        Users $users,
        Transaction $transaction
    ) {
        $this->users = $users;
        $this->transaction = $transaction;
    }

    public function execute(Command $command): JsonResponse
    {
        $this->transaction->begin();

        $user = $this->users->findOneById($command->getId());

        if(!$user) {
            return new JsonResponse('error', 400);
        }

        $user->edit(
            $command->getUser()->getName(),
            $command->getUser()->getSurname(),
            $command->getUser()->getEmail()
        );

        try {
            $this->transaction->commit();
        } catch (Throwable $e) {
            $this->transaction->rollback();
            throw $e;
        }

        return new JsonResponse('success', 200);
    }
}