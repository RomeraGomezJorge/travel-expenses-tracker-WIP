<?php

namespace App\Tests\Entity;

use App\Entity\Employee;
use App\Tests\Entity\Mother\IntegerMother;
use App\Tests\Entity\Mother\WordMother;

class EmployeeMother
{
    public static function create(string $name, string $surname, int $identityCard): Employee
    {
        $employee = new Employee();

        $employee->setName($name);

        $employee->setSurname($surname);

        $employee->setIdentityCard($identityCard);

        return $employee;
    }

    public static function random(): Employee
    {
        return self::create(
            WordMother::random() . ' ' . WordMother::random(),
            WordMother::random() . ' ' . WordMother::random(),
            IntegerMother::lessThan(99999999));
    }

}
