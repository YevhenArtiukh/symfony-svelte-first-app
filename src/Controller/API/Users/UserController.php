<?php


namespace App\Controller\API\Users;


use App\Entity\Users\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class UserController extends AbstractController
{
    /**
     * @Route("/api/user/{id}", methods={"GET"})
     * @param int $id
     * @param SerializerInterface $serializer
     * @return JsonResponse
     */
    public function index(int $id, SerializerInterface $serializer): JsonResponse
    {
        return new JsonResponse($serializer->serialize($this->getDoctrine()->getRepository(User::class)->findOneBy(['id' => $id]),'json'));
    }
}