<?php


namespace App\Controller\API\Authors;


use App\Entity\Authors\Author;
use App\Entity\Authors\UseCase\EditAuthor;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Throwable;

class EditController extends AbstractController
{
    /**
     * @param int $id
     * @param Request $request
     * @param SerializerInterface $serializer
     * @param EditAuthor $editAuthor
     * @return JsonResponse
     * @throws Throwable
     * @Route("/api/author/{id}/edit", methods={"POST"})
     */
    public function index(int $id, Request $request, SerializerInterface $serializer, EditAuthor $editAuthor): JsonResponse
    {
        $command = new EditAuthor\Command(
            $id,
            $serializer->deserialize($request->getContent(), Author::class, 'json')
        );

        return $editAuthor->execute($command);
    }
}