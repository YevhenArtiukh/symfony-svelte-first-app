<?php


namespace App\Controller\API\Users;


use App\Entity\Users\UseCase\EditUser;
use App\Entity\Users\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Throwable;

class EditController extends AbstractController
{
    /**
     * @Route("/api/user/{id}/edit", methods={"POST"})
     * @param int $id
     * @param Request $request
     * @param SerializerInterface $serializer
     * @param EditUser $editUser
     * @return JsonResponse
     * @throws Throwable
     */
    public function index(int $id, Request $request, SerializerInterface $serializer, EditUser $editUser): JsonResponse
    {
        $command = new EditUser\Command(
            $id,
            $serializer->deserialize($request->getContent(), User::class, 'json')
        );

        return $editUser->execute($command);
    }
}