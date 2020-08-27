<?php


namespace App\Core;


interface Transaction
{
    public function begin();
    public function commit();
    public function rollback();
}