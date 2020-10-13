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
     * @param User $user
     * @param SerializerInterface $serializer
     * @return JsonResponse
     */
    public function index(User $user, SerializerInterface $serializer): JsonResponse
    {
        return new JsonResponse($serializer->serialize($user,'json'));
    }
}