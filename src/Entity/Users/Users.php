<?php


namespace App\Entity\Users;


interface Users
{
    public function add(User $user);
    public function delete(User $user);

    /**
     * @param int $id
     * @return User|null
     */
    public function findOneById(int $id);
}