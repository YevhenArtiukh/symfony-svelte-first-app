<?php


namespace App\Controller\API\Books;


use App\Entity\Books\Book;
use App\Entity\Books\UseCase\EditBook;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Throwable;

class EditController extends AbstractController
{
    /**
     * @Route("/api/book/{book}/edit", methods={"POST"})
     * @param Book $book
     * @param Request $request
     * @param EditBook $editBook
     * @return JsonResponse
     * @throws Throwable
     */
    public function index(Book $book, Request $request, EditBook $editBook)
    {
        $data = json_decode($request->getContent(), true);
        $command = new EditBook\Command(
            $book,
            (string) $data['name'],
            (int) $data['count'],
            (array) $data['authors']
        );

        return $editBook->execute($command);
    }
}