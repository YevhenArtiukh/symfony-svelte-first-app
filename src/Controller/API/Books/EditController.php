<?php


namespace App\Controller\API\Books;


use App\Entity\Books\Book;
use App\Entity\Books\UseCase\EditBook;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Throwable;

class EditController extends AbstractController
{
    /**
     * @Route("/api/book/{id}/edit", methods={"POST"})
     * @param int $id
     * @param Request $request
     * @param EditBook $editBook
     * @param SerializerInterface $serializer
     * @return JsonResponse
     * @throws Throwable
     */
    public function index(int $id, Request $request, EditBook $editBook, SerializerInterface $serializer)
    {
        print_r($request->getContent());
        die();
        $command = new EditBook\Command(
            $id,
            $serializer->deserialize($request->getContent(), Book::class, 'json')
        );

        return $editBook->execute($command);
    }
}