<?php


namespace App\Controller\API\Authors;


use App\Entity\Authors\UseCase\DeleteAuthor;
use App\Entity\Users\UseCase\DeleteUser;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Throwable;

class DeleteController extends AbstractController
{
    /**
     * @Route("/api/author/{id}/delete", methods={"DELETE"})
     * @param int $id
     * @param DeleteAuthor $deleteAuthor
     * @return JsonResponse
     * @throws Throwable
     */
    public function index(int $id, DeleteAuthor $deleteAuthor): JsonResponse
    {
        $command = new DeleteAuthor\Command(
            $id
        );

        return $deleteAuthor->execute($command);
    }
}