<?php


namespace App\Controller\API\Books;


use App\Entity\Books\Book;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class ListController extends AbstractController
{
    /**
     * @param SerializerInterface $serializer
     * @return JsonResponse
     * @Route("/api/books/list", methods={"GET"})
     */
    public function index(SerializerInterface $serializer)
    {
        return new JsonResponse($serializer->serialize($this->getDoctrine()->getRepository(Book::class)->findAll(), 'json', [
            'circular_reference_handler' => function ($object) {
                return $object;
            }
        ]));
    }
}