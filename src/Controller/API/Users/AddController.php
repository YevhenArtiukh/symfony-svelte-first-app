<?php


namespace App\Controller\API\Users;

use App\Entity\Users\UseCase\CreateUser;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Throwable;

class AddController extends AbstractController
{
    /**
     * @Route("/api/users/add", methods={"POST"})
     * @param Request $request
     * @param CreateUser $createUser
     * @return JsonResponse
     * @throws Throwable
     */
    public function index(Request $request, CreateUser $createUser): JsonResponse
    {
        $request->request->replace(json_decode($request->getContent(), true));

        $command = new CreateUser\Command(
            $request->request->get('name'),
            $request->request->get('surname'),
            $request->request->get('email'),
            $request->request->get('password')
        );

        return $createUser->execute($command);
    }
}