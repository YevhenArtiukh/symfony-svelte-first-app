<?php


namespace App\Controller\API\Authors;


use App\Entity\Authors\UseCase\CreateAuthor;
use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Throwable;

class AddController extends AbstractController
{
    /**
     * @Route("/api/author/add", methods={"POST"})
     * @param Request $request
     * @param CreateAuthor $createAuthor
     * @return JsonResponse
     * @throws Throwable
     */
    public function index(Request $request, CreateAuthor $createAuthor): JsonResponse
    {
        $request->request->replace(json_decode($request->getContent(), true));

        $command = new CreateAuthor\Command(
            $request->request->get('name'),
            $request->request->get('surname'),
            new DateTime($request->request->get('dateOfBirth'))
        );

        return $createAuthor->execute($command);
    }
}