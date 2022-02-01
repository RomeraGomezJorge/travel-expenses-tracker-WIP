<?php
	
	namespace App\Tests\Entity\Mother;
	
	final class WordMother
	{
		public static function random(): string
		{
			return MotherCreator::random()->word();
		}
	}
