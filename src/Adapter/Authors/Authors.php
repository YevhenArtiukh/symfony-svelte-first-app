<?php


namespace App\Adapter\Authors;

use App\Entity\Authors\Author;
use App\Entity\Authors\Authors as AuthorsInterface;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMException;

class Authors implements AuthorsInterface
{
    private $entityManager;

    public function __construct(
        EntityManager $entityManager
    ) {
        $this->entityManager = $entityManager;
    }

    public function add(Author $author)
    {
        $this->entityManager->persist($author);
    }

    public function delete(Author $author)
    {
        $this->entityManager->remove($author);
    }

    public function findOneById(int $id): ?Author
    {
        return $this->entityManager->getRepository(Author::class)->findOneBy([
            'id' => $id
        ]);
    }

    public function findOneByIdReference(int $id)
    {
        try {
            return $this->entityManager->getReference(Author::class, $id);
        } catch (ORMException $e) {
            throw $e;
        }
    }
}