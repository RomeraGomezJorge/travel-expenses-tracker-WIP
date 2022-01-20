<?php

namespace App\Tests\Entity;

use App\Entity\LocationCosts;
use App\Tests\Entity\Mother\IntegerMother;
use App\Tests\Entity\Mother\WordMother;

class LocationCostsMother
{
    public static function create(string $location, int $cost ): LocationCosts
    {
    	$locationCosts = new LocationCosts();
	
	    $locationCosts->setLocation($location);
	    
	    $locationCosts->setCost((string) $cost);
    	
        return  $locationCosts;
    }

    public static function random(): LocationCosts
    {
        return self::create( WordMother::random().' '.WordMother::random(),
            IntegerMother::lessThan(100000));
    }
    
}
