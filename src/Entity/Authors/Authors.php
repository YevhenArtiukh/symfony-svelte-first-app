<?php


namespace App\Entity\Authors;


interface Authors
{
    public function add(Author $author);
    public function delete(Author $author);

    /**
     * @param int $id
     * @return Author|null
     */
    public function findOneById(int $id);
}