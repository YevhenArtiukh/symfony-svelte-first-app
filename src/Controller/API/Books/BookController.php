<?php


namespace App\Controller\API\Books;


use App\Entity\Books\Book;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class BookController extends AbstractController
{
    /**
     * @Route("/api/book/{id}", methods={"GET"})
     * @param int $id
     * @param SerializerInterface $serializer
     * @return JsonResponse
     */
    public function index(int $id, SerializerInterface $serializer)
    {
        return new JsonResponse($serializer->serialize($this->getDoctrine()->getRepository(Book::class)->findOneBy(['id' => $id]), 'json', ['circular_reference_handler' => fn($object) => $object->getId()]));
    }
}