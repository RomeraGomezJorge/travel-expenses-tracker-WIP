<?php


namespace App\Tests\Shared\Entity;


class WordMother
{
    public static function random(): string
    {
        return MotherCreator::random()->word;
    }
}