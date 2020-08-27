<?php


namespace App\Controller\API\Users;


use App\Entity\Users\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class UserController extends AbstractController
{
    /**
     * @Route("/api/user/{id}", methods={"GET"})
     * @param int $id
     * @param Request $request
     * @param SerializerInterface $serializer
     * @return JsonResponse
     */
    public function index(int $id, Request $request, SerializerInterface $serializer): JsonResponse
    {
        return new JsonResponse($serializer->serialize($this->getDoctrine()->getRepository(User::class)->findOneBy(['id' => $id]),'json'));
    }
}