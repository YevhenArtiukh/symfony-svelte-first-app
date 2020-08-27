<?php


namespace App\Entity\Users\UseCase;


use App\Core\Transaction;
use App\Entity\Users\UseCase\DeleteUser\Command;
use App\Entity\Users\Users;
use Symfony\Component\HttpFoundation\JsonResponse;
use Throwable;

class DeleteUser
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

        $this->users->delete($user);

        try {
            $this->transaction->commit();
        } catch (Throwable $e) {
            $this->transaction->rollback();
            throw $e;
        }

        return new JsonResponse('success');
    }
}