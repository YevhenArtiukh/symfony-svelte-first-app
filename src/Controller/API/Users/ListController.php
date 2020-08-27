<?php


namespace App\Controller\API\Users;


use App\Entity\Users\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class ListController extends AbstractController
{
    /**
     * @Route("/api/users/list", methods={"GET"})
     * @param SerializerInterface $serializer
     * @return string
     */
    public function index(SerializerInterface $serializer)
    {
        return new JsonResponse($serializer->serialize($this->getDoctrine()->getRepository(User::class)->findAll(), 'json'));
    }
}