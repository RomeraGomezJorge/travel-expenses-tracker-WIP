<?php

namespace App\Tests\Entity;

use App\Entity\LocationCosts;
use App\Entity\TripDestination;
use App\Tests\Entity\Mother\IntegerMother;
use App\Tests\Entity\Mother\WordMother;

class TripDestinationMother
{
    public static function create(string $name, LocationCosts $locationCosts): TripDestination
    {
        $tripDestination = new TripDestination();

        $tripDestination->setName($name);

        $tripDestination->setLocationCosts($locationCosts);

        return $tripDestination;
    }

    public static function random(): TripDestination
    {
        return self::create(
            WordMother::random() . ' ' . WordMother::random(),
            LocationCostsMother::random());
    }

    public static function withLocationCost(LocationCosts $locationCosts): TripDestination
    {
        return self::create(
            WordMother::random() . ' ' . WordMother::random(),
            $locationCosts);
    }

}
