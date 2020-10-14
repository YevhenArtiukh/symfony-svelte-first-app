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
     * @Route("/api/user/{user}/edit", methods={"PUT"})
     * @param int $id
     * @param Request $request
     * @param SerializerInterface $serializer
     * @param EditUser $editUser
     * @return JsonResponse
     * @throws Throwable
     */
    public function index(User $user, Request $request, SerializerInterface $serializer, EditUser $editUser): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        $command = new EditUser\Command(
            $user,
            (string) $data['name'],
            (string) $data['surname'],
            (string) $data['email']
        );

        return $editUser->execute($command);
    }
}