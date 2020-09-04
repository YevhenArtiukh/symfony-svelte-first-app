<?php

namespace App\Controller\API\Books;


use App\Entity\Books\UseCase\CreateBook;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Throwable;

class AddController extends AbstractController
{
    /**
     * @Route("/api/book/add", methods={"POST"})
     * @param Request $request
     * @param CreateBook $createBook
     * @return JsonResponse
     * @throws Throwable
     */
    public function index(Request $request, CreateBook $createBook): JsonResponse
    {
        $request->request->replace(json_decode($request->getContent(), true));

        $command = new CreateBook\Command(
            $request->request->get('name'),
            $request->request->get('count'),
            $request->request->get('authors')
        );

        return $createBook->execute($command);
    }
}