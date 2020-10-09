<?php


namespace App\Controller\API\Books;


use App\Entity\Books\UseCase\DeleteBook;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Throwable;

class DeleteController extends AbstractController
{
    /**
     * @Route("/api/book/{id}/delete", methods={"DELETE"})
     * @param int $id
     * @param DeleteBook $deleteBook
     * @return JsonResponse
     * @throws Throwable
     */
    public function index(int $id, DeleteBook $deleteBook): JsonResponse
    {
        $command = new DeleteBook\Command(
            $id
        );

        return $deleteBook->execute($command);
    }
}