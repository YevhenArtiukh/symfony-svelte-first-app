<?php


namespace App\Controller\API\Users;


use App\Entity\Users\UseCase\DeleteUser;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Throwable;

class DeleteController extends AbstractController
{
    /**
     * @Route("/api/user/{id}/delete", methods={"DELETE"})
     * @param int $id
     * @param DeleteUser $deleteUser
     * @return JsonResponse
     * @throws Throwable
     */
    public function index(int $id, DeleteUser $deleteUser): JsonResponse
    {
        $command = new DeleteUser\Command(
            $id
        );

        return $deleteUser->execute($command);
    }
}