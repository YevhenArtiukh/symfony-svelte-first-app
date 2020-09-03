<?php


namespace App\Entity\Authors\UseCase\CreateAuthor;


use DateTime;

class Command
{
    private $name;
    private $surname;
    private $dateOfBirth;

    public function __construct(
        string $name,
        string $surname,
        DateTime $dateOfBirth
    )
    {
        $this->name = $name;
        $this->surname = $surname;
        $this->dateOfBirth = $dateOfBirth;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getSurname(): string
    {
        return $this->surname;
    }

    /**
     * @return DateTime
     */
    public function getDateOfBirth(): DateTime
    {
        return $this->dateOfBirth;
    }
}