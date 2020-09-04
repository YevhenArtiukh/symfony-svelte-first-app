<?php


namespace App\Entity\Books;


interface Books
{
    public function add(Book $book);
    public function delete(Book $book);

    /**
     * @param int $id
     * @return Book|null
     */
    public function findOneById(int $id): ?Book;
}