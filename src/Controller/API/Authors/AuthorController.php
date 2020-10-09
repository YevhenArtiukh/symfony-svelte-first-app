<?php


namespace App\Controller\API\Authors;


use App\Entity\Authors\Author;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class AuthorController extends AbstractController
{
    /**
     * @Route("/api/author/{id}", methods={"GET"})
     * @param int $id
     * @param SerializerInterface $serializer
     * @return JsonResponse
     */
    public function index(int $id, SerializerInterface $serializer): JsonResponse
    {
        return new JsonResponse(
            $serializer->serialize(
                $this->getDoctrine()->getRepository(Author::class)->findOneBy(['id' => $id]),
                'json',
                [
                    'groups' => [
                        'admins'
                    ]
                ]
            )
        );
    }
}