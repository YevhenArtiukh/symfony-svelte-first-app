<?php


namespace App\Controller\API\Users;


use App\Entity\Users\UseCase\EditUser;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Throwable;

class EditController extends AbstractController
{
    /**
     * @Route("/api/user/{id}/edit", methods={"POST"})
     * @param int $id
     * @param Request $request
     * @param EditUser $editUser
     * @return JsonResponse
     * @throws Throwable
     */
    public function index(int $id, Request $request, EditUser $editUser): JsonResponse
    {
        $request->request->replace(json_decode($request->getContent(), true));

        $command = new EditUser\Command(
            $id,
            $request->request->get('name'),
            $request->request->get('surname'),
            $request->request->get('email')
        );

        return $editUser->execute($command);
    }
}