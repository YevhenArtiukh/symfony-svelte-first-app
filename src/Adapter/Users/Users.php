<?php


namespace App\Adapter\Users;

use App\Entity\Users\User;
use App\Entity\Users\Users as UsersInterface;
use Doctrine\ORM\EntityManager;

class Users implements UsersInterface
{
    private $entityManager;

    public function __construct(
        EntityManager $entityManager
    )
    {
        $this->entityManager = $entityManager;
    }


    public function add(User $user)
    {
        $this->entityManager->persist($user);
    }

    public function delete(User $user)
    {
        $this->entityManager->remove($user);
    }

    public function findOneById(int $id)
    {
        return $this->entityManager->getRepository(User::class)->findOneBy([
            'id' => $id
        ]);
    }
}