<?php


namespace App\Entity\Users\UseCase;

use App\Core\Transaction;
use App\Entity\Users\UseCase\CreateUser\Command;
use App\Entity\Users\User;
use App\Entity\Users\Users;
use Symfony\Component\HttpFoundation\JsonResponse;
use Throwable;

class CreateUser
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

        $user = new User(
            $command->getName(),
            $command->getSurname(),
            $command->getEmail(),
            $command->getPassword()
        );

        $this->users->add($user);


        try {
            $this->transaction->commit();
        } catch (Throwable $e) {
            $this->transaction->rollback();
            throw $e;
        }

        return new JsonResponse('success');
    }
}