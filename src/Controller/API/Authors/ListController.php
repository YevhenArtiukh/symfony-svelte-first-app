<?php


namespace App\Controller\API\Authors;


use App\Entity\Authors\Author;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class ListController extends AbstractController
{
    /**
     * @param SerializerInterface $serializer
     * @return JsonResponse
     * @Route("/api/authors/list", methods={"GET"})
     */
    public function index(SerializerInterface $serializer): JsonResponse
    {
        return new JsonResponse($serializer->serialize($this->getDoctrine()->getRepository(Author::class)->findAll(),'json',['circular_reference_handler' => fn($object) => $object->getId()]));
    }
}